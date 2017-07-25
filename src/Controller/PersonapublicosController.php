<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Personas Controller
 *
 * @property \App\Model\Table\PersonapublicosTable $Personas
 *
 * @method \App\Model\Entity\Personapublicos[] paginate($object = null, array $settings = [])
 */
class PersonapublicosController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $id = $this->Cookie->read('cliente_id');
        $personas = $this->Personapublicos->find('all', [
            'conditions' => [
                'Personapublicos.cliente_id' => $id
            ]
        ]);

        $this->set(compact('personas'));
        $this->set('_serialize', ['personas']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->loadModel('Desafiospublicos');
        $persona = $this->Personapublicos->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['Personapublicos']['cliente_id'] = $this->Cookie->read('cliente_id');
            $persona = $this->Personapublicos->patchEntity($persona, $this->request->getData());
            $palavras = $this->request->data['palavras'];
            if ($query = $this->Personapublicos->save($persona)) {
                $idPersona = $query->id;
                $this->atualizarPalavras($palavras);

                $cont = count($this->request->data['desafios']);
                for ($x = 0; $x < $cont; $x++) {
                    if ($this->request->data['desafios'][$x] != "") {
                        $df = $this->Desafiospublicos->newEntity();
                        $this->request->data['Desafiospublicos']['desafio'] = $this->request->data['desafios'][$x];
                        $this->request->data['Desafiospublicos']['persona_id'] = $idPersona;
                        $df = $this->Desafiospublicos->patchEntity($df, $this->request->getData());
                        $this->Desafiospublicos->save($df);
                    }
                }

                $this->Flash->success(__('A persona do público alvo foi salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A persona do público alvo não pode ser salva. Por favor, tente novamente'));
        }
        $sexos = $this->Personapublicos->getSexos();
        $graduacoes = $this->Personapublicos->getGraduacoes();
        $arqueotipos = $this->Personapublicos->getArqueotipos();
        $this->set(compact('sexos'));
        $this->set(compact('graduacoes'));
        $this->set(compact('arqueotipos'));
        $this->set(compact('persona'));
        $this->set('_serialize', ['persona']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->loadModel('Desafiospublicos');
        $persona = $this->Personapublicos->get($id, [
            'contain' => []
        ]);
        
        $desafios = $this->Desafiospublicos->find('all', [
            'conditions' => [
                'Desafiospublicos.persona_id' => $id
            ]
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $persona = $this->Personapublicos->patchEntity($persona, $this->request->getData());
            $palavras = $this->request->data['palavras'];
            if ($this->Personapublicos->save($persona)) {
                $this->atualizarPalavras($palavras);

                $desafiosParaDeletar = $this->Desafiospublicos->find('all', [
                    'conditions' => [
                        'Desafiospublicos.persona_id' => $id
                    ]
                ]);
                
                foreach ($desafiosParaDeletar as $dpd){
                    $this->Desafiospublicos->delete($dpd);
                }

                $cont = count($this->request->data['desafios']);
                for ($x = 0; $x < $cont; $x++) {
                    if ($this->request->data['desafios'][$x] != "") {
                        $df = $this->Desafiospublicos->newEntity();
                        $this->request->data['Desafiospublicos']['desafio'] = $this->request->data['desafios'][$x];
                        $this->request->data['Desafiospublicos']['persona_id'] = $id;
                        $df = $this->Desafiospublicos->patchEntity($df, $this->request->getData());
                        $this->Desafiospublicos->save($df);
                    }
                }

                $this->Flash->success(__('A persona do público alvo foi salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A persona do público alvo não foi salva. Por favor, tente novamente.'));
        }
        $sexos = $this->Personapublicos->getSexos();
        $graduacoes = $this->Personapublicos->getGraduacoes();
        $arqueotipos = $this->Personapublicos->getArqueotipos();
        $this->set(compact('sexos'));
        $this->set(compact('graduacoes'));
        $this->set(compact('arqueotipos'));
        $this->set(compact('desafios'));
        $this->set(compact('persona'));
        $this->set('_serialize', ['persona']);
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
        $persona = $this->Personapublicos->get($id);
        if ($this->Personapublicos->delete($persona)) {
            $this->Flash->success(__('A persona do público alvo foi deletada.'));
        } else {
            $this->Flash->error(__('A persona do público alvo não foi deletada. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function atualizarPalavras($palavras = null) {
        $this->loadModel('Palavras');
        if ($palavras != null) {
            $palavra = explode(",", $palavras);
            $count = count($palavra);
            for ($x = 0; $x < $count; $x++) {
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
        return true;
    }

}
