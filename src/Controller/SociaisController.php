<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Sociais Controller
 *
 * @property \App\Model\Table\SociaisTable $Sociais
 *
 * @method \App\Model\Entity\Social[] paginate($object = null, array $settings = [])
 */
class SociaisController extends AppController {

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
        $sociais = $this->Sociais->find('all', [
            'conditions' => [
                'Sociais.cliente_id' => $id
            ]
        ]);

        $this->set(compact('sociais'));
        $this->set('_serialize', ['sociais']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->loadModel('Personas');
        $this->loadModel('Desafios');
        $this->loadModel('Profiles');
        $this->loadModel('Revisaosociais');
        $this->loadModel('Pautas');
        $social = $this->Sociais->newEntity();

        $cliente_id = $this->Cookie->read('cliente_id');
        
        $personas = $this->Personas->find('list', [
            'conditions' => [
                'Personas.cliente_id' => $this->Cookie->read('cliente_id')
            ]
        ]);
        
        $titulos = $this->Pautas->find('list', [
            'conditions' => [
                'Pautas.cliente_id' => $this->Cookie->read('cliente_id')
            ]
        ]);

        $jornadas = $this->Pautas->getJornadas();
        $temas = $this->Sociais->getTemas();

        $this->set(compact('palavraschave'));
        $this->set(compact('personas'));
        $this->set(compact('titulos'));
        $this->set(compact('jornadas'));
        $this->set(compact('temas'));
        $this->set(compact('pauta'));
        $this->set(compact('social'));
        $this->set('_serialize', ['social']);

        if ($this->request->is('post')) {
            $profiles = $this->Profiles->find('all', [
                'conditions' => [
                    'Profiles.user_id' => $this->Auth->user('id')
                ]
            ]);
            $profile = $profiles->first();
            $this->request->data['Sociais']['cliente_id'] = $this->Cookie->read('cliente_id');
            $this->request->data['Sociais']['status'] = 'Rascunho';

            $social = $this->Sociais->patchEntity($social, $this->request->getData());
            if ($query = $this->Sociais->save($social)) {
                $idSocial = $query->id;

                $revisao = $this->Revisaosociais->newEntity();
                $this->request->data['Revisaosociais']['autor'] = $profile['id'];
                $this->request->data['Revisaosociais']['revisao'] = 0;
                $this->request->data['Revisaosociais']['social_id'] = $idSocial;
                $revisao = $this->Revisaosociais->patchEntity($revisao, $this->request->getData());
                $this->Revisaosociais->save($revisao);

                $this->Flash->success(__('A mídia social foi salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A mídia social não pode ser salva. Por favor, tente novamente'));
        }
    }

    public function detalhes($id = null, $cliente_id = null) {
        $this->loadModel('Pautas');
        $this->loadModel('Personas');
        $this->loadModel('Desafios');
        $this->loadModel('Palavras');
        $this->loadModel('Profiles');
        $this->loadModel('Revisaosociais');
        $this->loadModel('Mensagemsociais');

        $social = $this->Sociais->get($id, [
            'contain' => []
        ]);

        $mensagens = $this->Mensagemsociais->find('all', [
            'conditions' => [
                'Mensagemsociais.social_id' => $id
            ],
            'contain' => ['Profiles']
        ]);

        $revisaos = $this->Revisaosociais->find('all', [
            'conditions' => [
                'Revisaosociais.social_id' => $id
            ],
            'contain' => ['aliasAutor', 'aliasRevisor', 'aliasAprovador']
        ]);
        $revisao = $revisaos->last();

        if ($cliente_id == null) {
            $cliente_id = $this->Cookie->read('cliente_id');
        } else {
            $this->Cookie->write('cliente_id', $cliente_id);
        }

        $this->set(compact('social'));
        $this->set(compact('mensagens'));
        $this->set(compact('revisao'));
        $this->set('_serialize', ['social']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->loadModel('Pautas');
        $this->loadModel('Wordpress');
        $this->loadModel('Personas');
        $this->loadModel('Desafios');
        $this->loadModel('Palavras');
        $this->loadModel('Profiles');
        $this->loadModel('Diagnosticos');
        $this->loadModel('Revisaos');
        $this->loadModel('Mensagems');

        $conteudo = $this->Conteudos->get($id, [
            'contain' => ['Pautas']
        ]);

        $mensagens = $this->Mensagems->find('all', [
            'conditions' => [
                'Mensagems.conteudo_id' => $id
            ],
            'contain' => ['Profiles']
        ]);

        $pautas = $this->Pautas->find('all', [
            'conditions' => [
                'Pautas.id' => $conteudo['pauta_id']
            ],
            'contain' => ['Desafios', 'Personas']
        ]);
        $pauta = $pautas->first();

        $revisaos = $this->Revisaos->find('all', [
            'conditions' => [
                'Revisaos.conteudo_id' => $id
            ],
            'contain' => ['aliasAutor', 'aliasRevisor', 'aliasAprovador']
        ]);
        $revisao = $revisaos->last();
        
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

        $desafios = $this->Desafios->find('list', array(
            'conditions' => array(
                'Desafios.persona_id' => $pauta['persona_id']
            )
        ));

        $diagnosticos = $this->Diagnosticos->find('all', [
            'conditions' => [
                'Diagnosticos.cliente_id' => $this->Cookie->read('cliente_id')
            ]
        ]);
        $diagnostico = $diagnosticos->first();

        $jornadas = $this->Pautas->getJornadas();
        $tipos = $this->Pautas->getTipos();

        $this->set(compact('conteudo'));
        $this->set(compact('mensagens'));
        $this->set(compact('tipos'));
        $this->set(compact('diagnostico'));
        $this->set(compact('desafios'));
        $this->set(compact('palavraschave'));
        $this->set(compact('personas'));
        $this->set(compact('jornadas'));
        $this->set(compact('revisao'));
        $this->set(compact('pauta'));
        $this->set('_serialize', ['conteudo']);

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
                
                $idConteudo = $query->id;

                $pauta = $this->Pautas->patchEntity($pauta, $this->request->getData());
                $this->Pautas->save($pauta);

                $rs = $this->Revisaos->newEntity();
                $this->request->data['Revisaos']['autor'] = $profile['id'];
                $this->request->data['Revisaos']['revisao'] = $revisao['revisao'] + 1;
                $this->request->data['Revisaos']['conteudo_id'] = $idConteudo;
                $rs = $this->Revisaos->patchEntity($rs, $this->request->getData());
                $this->Revisaos->save($rs);
                
                $this->Flash->success(__('O conteúdo foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O conteúdo não foi salvo. Por favor, tente novamente.'));
        }
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
        $conteudo = $this->Conteudos->get($id);
        if ($this->Conteudos->delete($conteudo)) {
            $this->Flash->success(__('O conteúdo foi deletado.'));
        } else {
            $this->Flash->error(__('O conteúdo não foi deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function revisao($id = null) {
        $this->loadModel("Revisaos");
        
        $revisaos = $this->Revisaos->find("all", [
            'conditions' => [
                'Revisaos.conteudo_id' => $id
            ]
        ]);
        
        $revisao = $revisaos->last();
        
        $conteudo = $this->Conteudos->get($id, [
            'contain' => []
        ]);
        
        $this->request->data['Revisaos']['recebido'] = date("Y-m-d H:i:s");
        $revisao = $this->Revisaos->patchEntity($revisao, $this->request->getData());
        if ($this->Revisaos->save($revisao)) {
            $this->request->data['Conteudos']['status'] = 'Revisão';
            $conteudo = $this->Conteudos->patchEntity($conteudo, $this->request->getData());
            $this->Conteudos->save($conteudo);
            $this->Flash->success(__('Enviado para revisão com sucesso.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('O conteúdo não foi enviado para revisão. Por favor, tente novamente.'));
    }
    
    public function aprovarRevisao($id = null) {
        $this->loadModel('Profiles');
        $this->loadModel("Revisaos");
        
        $revisaos = $this->Revisaos->find("all", [
            'conditions' => [
                'Revisaos.conteudo_id' => $id
            ]
        ]);
        
        $revisao = $revisaos->last();
        
        $conteudo = $this->Conteudos->get($id, [
            'contain' => []
        ]);
        
        $profiles = $this->Profiles->find('all', [
            'conditions' => [
                'Profiles.user_id' => $this->Auth->user('id')
            ]
        ]);
        $profile = $profiles->first();
        
        $this->request->data['Conteudos']['status'] = 'Aprovação';
        $this->request->data['Revisaos']['revisor'] = $profile['id'];
        $this->request->data['Revisaos']['revisado'] = date("Y-m-d H:i:s");
        $revisao = $this->Revisaos->patchEntity($revisao, $this->request->getData());
        if ($this->Revisaos->save($revisao)) {
            $conteudo = $this->Conteudos->patchEntity($conteudo, $this->request->getData());
            $this->Conteudos->save($conteudo);
            $this->Flash->success(__('Revisão aprovada com sucesso.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('A revisão não pode ser aprovada. Por favor, tente novamente.'));
    }
    
    public function reprovarRevisao($id = null) {
        $this->loadModel('Profiles');
        $this->loadModel("Revisaos");
        
        $revisaos = $this->Revisaos->find("all", [
            'conditions' => [
                'Revisaos.conteudo_id' => $id
            ]
        ]);
        
        $revisao = $revisaos->last();
        
        $conteudo = $this->Conteudos->get($id, [
            'contain' => []
        ]);
        
        $profiles = $this->Profiles->find('all', [
            'conditions' => [
                'Profiles.user_id' => $this->Auth->user('id')
            ]
        ]);
        $profile = $profiles->first();
        
        $this->request->data['Conteudos']['status'] = 'Rascunho';
        $this->request->data['Revisaos']['revisor'] = $profile['id'];
        $this->request->data['Revisaos']['revisado'] = date("Y-m-d H:i:s");
        $revisao = $this->Revisaos->patchEntity($revisao, $this->request->getData());
        if ($this->Revisaos->save($revisao)) {
            $conteudo = $this->Conteudos->patchEntity($conteudo, $this->request->getData());
            $this->Conteudos->save($conteudo);
            $this->Flash->success(__('Revisão reprovada com sucesso.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('A revisão não pode ser reprovada. Por favor, tente novamente.'));
    }
    
    public function aprovar($id = null) {
        $this->loadModel('Profiles');
        $this->loadModel("Revisaos");
        
        $revisaos = $this->Revisaos->find("all", [
            'conditions' => [
                'Revisaos.conteudo_id' => $id
            ]
        ]);
        
        $revisao = $revisaos->last();

        $conteudo = $this->Conteudos->get($id, [
            'contain' => []
        ]);
        
        $profiles = $this->Profiles->find('all', [
            'conditions' => [
                'Profiles.user_id' => $this->Auth->user('id')
            ]
        ]);
        $profile = $profiles->first();
            
        $this->request->data['Conteudos']['status'] = 'Publicação agendada';
        $this->request->data['Revisaos']['aprovador'] = $profile['id'];
        $this->request->data['Revisaos']['aprovado'] = date("Y-m-d H:i:s");
        $revisao = $this->Revisaos->patchEntity($revisao, $this->request->getData());
        if ($this->Revisaos->save($revisao)) {
            $conteudo = $this->Conteudos->patchEntity($conteudo, $this->request->getData());
            $this->Conteudos->save($conteudo);
            $this->Flash->success(__('Conteúdo aprovado com sucesso.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('O conteúdo não pode ser aprovado. Por favor, tente novamente.'));
    }
    
    public function reprovar($id = null) {
        $this->loadModel('Profiles');
        $this->loadModel("Revisaos");
        
        $revisaos = $this->Revisaos->find("all", [
            'conditions' => [
                'Revisaos.conteudo_id' => $id
            ]
        ]);
        
        $revisao = $revisaos->last();
        
        $conteudo = $this->Conteudos->get($id, [
            'contain' => []
        ]);

        $profiles = $this->Profiles->find('all', [
            'conditions' => [
                'Profiles.user_id' => $this->Auth->user('id')
            ]
        ]);
        $profile = $profiles->first();
            
        $this->request->data['Conteudos']['status'] = 'Rascunho';
        $this->request->data['Revisaos']['aprovador'] = $profile['id'];
        $this->request->data['Revisaos']['aprovado'] = date("Y-m-d H:i:s");
        $revisao = $this->Revisaos->patchEntity($revisao, $this->request->getData());
        if ($this->Revisaos->save($revisao)) {
            $conteudo = $this->Conteudos->patchEntity($conteudo, $this->request->getData());
            $this->Conteudos->save($conteudo);
            $this->Flash->success(__('Conteúdo reprovado com sucesso.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('O conteúdo não pode ser reprovado. Por favor, tente novamente.'));
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

    public function saveMessage() {
        $this->loadModel('Mensagems');
        $this->autoRender = false;
        $mensagem = $this->Mensagems->newEntity();
        if ($this->request->is('ajax')) {
            $mensagem = $this->Mensagems->patchEntity($mensagem, $this->request->getQuery());

            $this->Mensagems->save($mensagem);
        }

        return null;
    }
    
}
