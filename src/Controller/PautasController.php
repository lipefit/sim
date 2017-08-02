<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Pautas Controller
 *
 * @property \App\Model\Table\PautasTable $Pautas
 *
 * @method \App\Model\Entity\Pauta[] paginate($object = null, array $settings = [])
 */
class PautasController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $id = $this->Cookie->read('cliente_id');
        $pautas = $this->Pautas->find('all', [
            'conditions' => [
                'Pautas.cliente_id' => $id
            ]
        ]);

        $this->set(compact('pautas'));
        $this->set('_serialize', ['pautas']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->loadModel('Personas');
        $this->loadModel('Palavras');
        $pauta = $this->Pautas->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['Pautas']['cliente_id'] = $this->Cookie->read('cliente_id');
            $this->request->data['Pautas']['autor'] = $this->Auth->user('id');
            $this->request->data['Pautas']['status'] = 'Revisão';
            $this->request->data['Pautas']['ativo'] = 1;
            $pauta = $this->Pautas->patchEntity($pauta, $this->request->getData());
            $palavras = $this->request->data['palavras'];
            if ($this->Pautas->save($pauta)) {
                $this->atualizarPalavras($palavras);
                $this->Flash->success(__('A pauta de conteúdo foi salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A pauta de conteúdo não pode ser salva. Por favor, tente novamente'));
        }

        $personas = $this->Personas->find('list', [
            'conditions' => [
                'Personas.cliente_id' => $this->Cookie->read('cliente_id')
            ]
        ]);

        $palavraschave = $this->Palavras->find('all', [
            'conditions' => [
                'Palavras.cliente_id' => $this->Cookie->read('cliente_id')
            ]
        ]);

        $jornadas = $this->Pautas->getJornadas();
        $tipos = $this->Pautas->getTipos();

        $this->set(compact('palavraschave'));
        $this->set(compact('personas'));
        $this->set(compact('jornadas'));
        $this->set(compact('tipos'));
        $this->set(compact('pauta'));
        $this->set('_serialize', ['pauta']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->loadModel('Personas');
        $pauta = $this->Pautas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pauta = $this->Pautas->patchEntity($pauta, $this->request->getData());
            if ($this->Pautas->save($pauta)) {
                $this->Flash->success(__('A pauta de conteúdo foi salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A pauta de conteúdo não foi salva. Por favor, tente novamente.'));
        }

        $this->set(compact('pauta'));
        $this->set('_serialize', ['pauta']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $pauta = $this->Pautas->get($id);
        if ($this->Pautas->delete($pauta)) {
            $this->Flash->success(__('A pauta de conteúdo foi deletada.'));
        } else {
            $this->Flash->error(__('A pauta de conteúdo não foi deletada. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function atualizarPalavras($palavras = null) {
        $this->loadModel('Palavras');
        if ($palavras != null) {
            $palavra = explode(",", $palavras);
            $count = count($palavra);
            for ($x = 0; $x < $count; $x++) {
                if ($palavra[$x] != "") {
                    $consulta = $this->Palavras->find('all', [
                        'conditions' => [
                            'Palavras.palavra' => trim($palavra[$x])
                        ]
                    ]);
                    $totalConsulta = $consulta->count();
                    if ($totalConsulta == 0) {
                        $novaPalavra = $this->Palavras->newEntity();
                        $this->request->data['Palavras']['palavra'] = trim($palavra[$x]);
                        $this->request->data['Palavras']['cliente_id'] = $this->Cookie->read('cliente_id');
                        $novaPalavra = $this->Palavras->patchEntity($novaPalavra, $this->request->getData());
                        $this->Palavras->save($novaPalavra);
                    }
                }
            }
        }
        return true;
    }

    public function selecionaDesafio() {
        $this->loadModel('Desafios');
//        $this->RequestHandler->respondAs('json');
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $desafios = $this->Desafios->find('all', array(
                'conditions' => array(
                    'Desafios.persona_id' => $this->request->query['id']
                )
            ));
        }
        $i = 0;
        foreach ($desafios as $k => $desafio) {
            $array[$i]['id'] = $k;
            $array[$i]['desafio'] = $desafio['desafio'];
            $i++;
        }

        $return = json_encode($array);
        $this->response->type('json');
        $this->response->body($return);
        return $this->response;
    }

}
