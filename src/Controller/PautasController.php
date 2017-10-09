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
        $this->loadModel('Personapublicos');
        $this->loadModel('Palavras');
        $this->loadModel('Profiles');
        $pauta = $this->Pautas->newEntity();
        if ($this->request->is('post')) {
            $profiles = $this->Profiles->find('all', [
                'conditions' => [
                    'Profiles.user_id' => $this->Auth->user('id')
                ]
            ]);
            $profile = $profiles->first();
            $this->request->data['Pautas']['cliente_id'] = $this->Cookie->read('cliente_id');
            $this->request->data['Pautas']['autor'] = $profile['id'];
            $this->request->data['Pautas']['status'] = 'Rascunho';
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

        $personas = $this->Personapublicos->find('list', [
            'conditions' => [
                'Personapublicos.cliente_id' => $this->Cookie->read('cliente_id')
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

    public function detalhes($id = null, $cliente_id = null) {
        $this->loadModel('Personapublicos');
        $this->loadModel('Palavras');
        $this->loadModel('Mensagempautas');

        $pauta = $this->Pautas->get($id, [
            'contain' => ['Personapublicos', 'Desafiospublicos', 'aliasAutor', 'aliasRevisor', 'aliasAprovador']
        ]);

        $mensagens = $this->Mensagempautas->find('all', [
            'conditions' => [
                'Mensagempautas.pauta_id' => $id
            ],
            'contain' => ['Profiles']
        ]);

        if ($cliente_id == null) {
            $cliente_id = $this->Cookie->read('cliente_id');
        } else {
            $this->Cookie->write('cliente_id', $cliente_id);
        }

        $this->set(compact('pauta'));
        $this->set(compact('mensagens'));
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
        $this->loadModel('Personapublicos');
        $this->loadModel('Palavras');
        $this->loadModel('Desafiospublicos');
        $this->loadModel('Profiles');
        $pauta = $this->Pautas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $profiles = $this->Profiles->find('all', [
                'conditions' => [
                    'Profiles.user_id' => $this->Auth->user('id')
                ]
            ]);
            $profile = $profiles->first();

            $this->request->data['Pautas']['cliente_id'] = $this->Cookie->read('cliente_id');
            $this->request->data['Pautas']['autor'] = $profile['id'];
            $this->request->data['Pautas']['status'] = 'Rascunho';
            $this->request->data['Pautas']['ativo'] = 1;
            $pauta = $this->Pautas->patchEntity($pauta, $this->request->getData());
            if ($this->Pautas->save($pauta)) {
                $this->Flash->success(__('A pauta de conteúdo foi salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A pauta de conteúdo não foi salva. Por favor, tente novamente.'));
        }

        $personas = $this->Personapublicos->find('list', [
            'conditions' => [
                'Personapublicos.cliente_id' => $this->Cookie->read('cliente_id')
            ]
        ]);

        $palavraschave = $this->Palavras->find('all', [
            'conditions' => [
                'Palavras.cliente_id' => $this->Cookie->read('cliente_id')
            ]
        ]);

        $desafios = $this->Desafiospublicos->find('list', array(
            'conditions' => array(
                'Desafiospublicos.personapublico_id' => $pauta['persona_id']
            )
        ));

        $jornadas = $this->Pautas->getJornadas();
        $tipos = $this->Pautas->getTiposEdit();

        $this->set(compact('palavraschave'));
        $this->set(compact('personas'));
        $this->set(compact('jornadas'));
        $this->set(compact('desafios'));
        $this->set(compact('tipos'));
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

    public function revisao($id = null) {
        $pauta = $this->Pautas->get($id, [
            'contain' => []
        ]);

        $this->request->data['Pautas']['status'] = 'Revisão';
        $this->request->data['Pautas']['recebido'] = date("d/m/Y");
        $pauta = $this->Pautas->patchEntity($pauta, $this->request->getData());
        if ($this->Pautas->save($pauta)) {
            $this->Flash->success(__('Enviado para revisão com sucesso.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('A pauta de conteúdo não foi enviada para revisão. Por favor, tente novamente.'));
    }
    
    public function aprovarRevisao($id = null) {
        $this->loadModel('Profiles');
        $pauta = $this->Pautas->get($id, [
            'contain' => []
        ]);
        
        $profiles = $this->Profiles->find('all', [
            'conditions' => [
                'Profiles.user_id' => $this->Auth->user('id')
            ]
        ]);
        $profile = $profiles->first();
        
        $this->request->data['Pautas']['status'] = 'Aprovação';
        $this->request->data['Pautas']['revisor'] = $profile['id'];
        $this->request->data['Pautas']['revisado'] = date("d/m/Y");
        $pauta = $this->Pautas->patchEntity($pauta, $this->request->getData());
        if ($this->Pautas->save($pauta)) {
            $this->Flash->success(__('Revisão aprovada com sucesso.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('A revisão não pode ser aprovada. Por favor, tente novamente.'));
    }
    
    public function reprovarRevisao($id = null) {
        $this->loadModel('Profiles');
        $pauta = $this->Pautas->get($id, [
            'contain' => []
        ]);
        
        $profiles = $this->Profiles->find('all', [
            'conditions' => [
                'Profiles.user_id' => $this->Auth->user('id')
            ]
        ]);
        $profile = $profiles->first();
        
        $this->request->data['Pautas']['status'] = 'Rascunho';
        $this->request->data['Pautas']['revisor'] = $profile['id'];
        $this->request->data['Pautas']['revisado'] = date("d/m/Y");
        $pauta = $this->Pautas->patchEntity($pauta, $this->request->getData());
        if ($this->Pautas->save($pauta)) {
            $this->Flash->success(__('Revisão reprovada com sucesso.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('A revisão não pode ser reprovada. Por favor, tente novamente.'));
    }
    
    public function aprovar($id = null) {
        $this->loadModel('Profiles');
        $pauta = $this->Pautas->get($id, [
            'contain' => []
        ]);

        $profiles = $this->Profiles->find('all', [
            'conditions' => [
                'Profiles.user_id' => $this->Auth->user('id')
            ]
        ]);
        $profile = $profiles->first();
            
        $this->request->data['Pautas']['status'] = 'Aprovado';
        $this->request->data['Pautas']['aprovador'] = $profile['id'];
        $this->request->data['Pautas']['aprovado'] = date("d/m/Y");
        $pauta = $this->Pautas->patchEntity($pauta, $this->request->getData());
        if ($this->Pautas->save($pauta)) {
            $this->Flash->success(__('Pauta aprovada com sucesso.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('A pauta não pode ser aprovada. Por favor, tente novamente.'));
    }
    
    public function reprovar($id = null) {
        $this->loadModel('Profiles');
        $pauta = $this->Pautas->get($id, [
            'contain' => []
        ]);

        $profiles = $this->Profiles->find('all', [
            'conditions' => [
                'Profiles.user_id' => $this->Auth->user('id')
            ]
        ]);
        $profile = $profiles->first();
            
        $this->request->data['Pautas']['status'] = 'Rascunho';
        $this->request->data['Pautas']['aprovador'] = $profile['id'];
        $this->request->data['Pautas']['aprovado'] = date("d/m/Y");
        $pauta = $this->Pautas->patchEntity($pauta, $this->request->getData());
        if ($this->Pautas->save($pauta)) {
            $this->Flash->success(__('Pauta reprovada com sucesso.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('A pauta não pode ser reprovada. Por favor, tente novamente.'));
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
        $this->loadModel('Desafiospublicos');
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $desafios = $this->Desafiospublicos->find('all', array(
                'conditions' => array(
                    'Desafiospublicos.personapublico_id' => $this->request->query['id']
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

    public function saveMessage() {
        $this->loadModel('Mensagempautas');
        $this->autoRender = false;
        $mensagem = $this->Mensagempautas->newEntity();
        if ($this->request->is('ajax')) {
            $mensagem = $this->Mensagempautas->patchEntity($mensagem, $this->request->getQuery());

            $this->Mensagempautas->save($mensagem);
        }

        return null;
    }

}
