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
        $this->loadModel('Revisaosociais');
        $id = $this->Cookie->read('cliente_id');
        $sociais = $this->Revisaosociais->find('all', [
            'conditions' => [
                'Sociais.cliente_id' => $id
            ],
            'contain' => ['Sociais', 'Pautas'],
            'order' => ['Revisaosociais.id DESC'],
            'group' => ['Revisaosociais.social_id']
             
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
        $this->loadModel('Personapublicos');
        $this->loadModel('Desafiospublicos');
        $this->loadModel('Profiles');
        $this->loadModel('Revisaosociais');
        $this->loadModel('Pautas');
        $social = $this->Sociais->newEntity();

        $cliente_id = $this->Cookie->read('cliente_id');

        $personas = $this->Personapublicos->find('list', [
            'conditions' => [
                'Personapublicos.cliente_id' => $this->Cookie->read('cliente_id')
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
                $this->request->data['Revisaosociais']['status_facebook'] = "Aguardando publicação";
                $this->request->data['Revisaosociais']['status_linkedin'] = "Aguardando publicação";
                $this->request->data['Revisaosociais']['status_twitter'] = "Aguardando publicação";
                $this->request->data['Revisaosociais']['status_google'] = "Não agendado";
                $this->request->data['Revisaosociais']['status_instagram'] = "Não agendado";

                if ($this->request->data['imagem_facebook_upload']['name'] != null) {
                    $imagemFacebook = $this->request->data['imagem_facebook_upload'];
                    $arquivo = str_replace(' ', '_', $imagemFacebook['name']);
                    if (move_uploaded_file($imagemFacebook['tmp_name'], WWW_ROOT . 'files/' . $arquivo)) {
                        $this->request->data['Revisaosociais']['imagem_facebook'] = $arquivo;
                    }
                }

                if ($this->request->data['imagem_linkedin_upload']['name'] != null) {
                    $imagemLinkedin = $this->request->data['imagem_linkedin_upload'];
                    $arquivo = str_replace(' ', '_', $imagemLinkedin['name']);
                    if (move_uploaded_file($imagemLinkedin['tmp_name'], WWW_ROOT . 'files/' . $arquivo)) {
                        $this->request->data['Revisaosociais']['imagem_linkedin'] = $arquivo;
                    }
                }

                if ($this->request->data['imagem_twitter_upload']['name'] != null) {
                    $imagemTwitter = $this->request->data['imagem_twitter_upload'];
                    $arquivo = str_replace(' ', '_', $imagemTwitter['name']);
                    if (move_uploaded_file($imagemTwitter['tmp_name'], WWW_ROOT . 'files/' . $arquivo)) {
                        $this->request->data['Revisaosociais']['imagem_twitter'] = $arquivo;
                    }
                }

                if ($this->request->data['imagem_google_upload']['name'] != null) {
                    $imagemGoogle = $this->request->data['imagem_google_upload'];
                    $arquivo = str_replace(' ', '_', $imagemGoogle['name']);
                    if (move_uploaded_file($imagemGoogle['tmp_name'], WWW_ROOT . 'files/' . $arquivo)) {
                        $this->request->data['Revisaosociais']['imagem_google'] = $arquivo;
                    }
                }

                if ($this->request->data['imagem_instagram_upload']['name'] != null) {
                    $imagemInstagram = $this->request->data['imagem_instagram_upload'];
                    $arquivo = str_replace(' ', '_', $imagemInstagram['name']);
                    if (move_uploaded_file($imagemInstagram['tmp_name'], WWW_ROOT . 'files/' . $arquivo)) {
                        $this->request->data['Revisaosociais']['imagem_instagram'] = $arquivo;
                    }
                }

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
        $this->loadModel('Personapublicos');
        $this->loadModel('Desafiospublicos');
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
            'contain' => ['aliasAutor', 'aliasRevisor', 'aliasAprovador', 'Pautas' => ['Personapublicos', 'Desafiospublicos']]
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
        $this->loadModel('Personapublicos');
        $this->loadModel('Desafiospublicos');
        $this->loadModel('Profiles');
        $this->loadModel('Diagnosticos');
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

        $titulos = $this->Pautas->find('list', [
            'conditions' => [
                'Pautas.cliente_id' => $this->Cookie->read('cliente_id')
            ]
        ]);

        $revisaos = $this->Revisaosociais->find('all', [
            'conditions' => [
                'Revisaosociais.social_id' => $id
            ],
            'contain' => ['aliasAutor', 'aliasRevisor', 'aliasAprovador', 'Pautas']
        ]);
        $revisao = $revisaos->last();

        $personas = $this->Personapublicos->find('list', [
            'conditions' => [
                'Personapublicos.cliente_id' => $this->Cookie->read('cliente_id')
            ]
        ]);

        $desafiospublicos = $this->Desafiospublicos->find('list', [
            'conditions' => [
                'Desafiospublicos.personapublico_id' => $revisao['persona_id']
            ]
        ]);

        $jornadas = $this->Pautas->getJornadas();
        $temas = $this->Sociais->getTemas();

        $this->set(compact('social'));
        $this->set(compact('titulos'));
        $this->set(compact('mensagens'));
        $this->set(compact('temas'));
        $this->set(compact('desafiospublicos'));
        $this->set(compact('personas'));
        $this->set(compact('jornadas'));
        $this->set(compact('revisao'));
        $this->set('_serialize', ['social']);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $profiles = $this->Profiles->find('all', [
                'conditions' => [
                    'Profiles.user_id' => $this->Auth->user('id')
                ]
            ]);
            $profile = $profiles->first();
            $this->request->data['Sociais']['status'] = 'Rascunho';

            $social = $this->Sociais->patchEntity($social, $this->request->getData());
            if ($query = $this->Sociais->save($social)) {
                $idSocial = $query->id;
                
                $rs = $this->Revisaosociais->newEntity();
                $this->request->data['Revisaosociais']['autor'] = $profile['id'];
                $this->request->data['Revisaosociais']['revisao'] = $revisao['revisao'] + 1;
                $this->request->data['Revisaosociais']['social_id'] = $idSocial;
                $this->request->data['Revisaosociais']['status_facebook'] = "Aguardando publicação";
                $this->request->data['Revisaosociais']['status_linkedin'] = "Aguardando publicação";
                $this->request->data['Revisaosociais']['status_twitter'] = "Aguardando publicação";
                $this->request->data['Revisaosociais']['status_google'] = "Não agendado";
                $this->request->data['Revisaosociais']['status_instagram'] = "Não agendado";

                if ($this->request->data['imagem_facebook_upload']['name'] != null) {
                    $imagemFacebook = $this->request->data['imagem_facebook_upload'];
                    $arquivo = str_replace(' ', '_', $imagemFacebook['name']);
                    if (move_uploaded_file($imagemFacebook['tmp_name'], WWW_ROOT . 'files/' . $arquivo)) {
                        if($arquivo != ""){
                            $this->request->data['Revisaosociais']['imagem_facebook'] = $arquivo;
                        }else{
                            $this->request->data['Revisaosociais']['imagem_facebook'] = $revisao['imagem_facebook'];
                        }
                    }
                }

                if ($this->request->data['imagem_linkedin_upload']['name'] != null) {
                    $imagemLinkedin = $this->request->data['imagem_linkedin_upload'];
                    $arquivo = str_replace(' ', '_', $imagemLinkedin['name']);
                    if (move_uploaded_file($imagemLinkedin['tmp_name'], WWW_ROOT . 'files/' . $arquivo)) {
                        if($arquivo != ""){
                            $this->request->data['Revisaosociais']['imagem_linkedin'] = $arquivo;
                        }else{
                            $this->request->data['Revisaosociais']['imagem_linkedin'] = $revisao['imagem_linkedin'];
                        }
                    }
                }

                if ($this->request->data['imagem_twitter_upload']['name'] != null) {
                    $imagemTwitter = $this->request->data['imagem_twitter_upload'];
                    $arquivo = str_replace(' ', '_', $imagemTwitter['name']);
                    if (move_uploaded_file($imagemTwitter['tmp_name'], WWW_ROOT . 'files/' . $arquivo)) {
                        if($arquivo != ""){
                            $this->request->data['Revisaosociais']['imagem_twitter'] = $arquivo;
                        }else{
                            $this->request->data['Revisaosociais']['imagem_twitter'] = $revisao['imagem_twitter'];
                        }
                    }
                }

                if ($this->request->data['imagem_google_upload']['name'] != null) {
                    $imagemGoogle = $this->request->data['imagem_google_upload'];
                    $arquivo = str_replace(' ', '_', $imagemGoogle['name']);
                    if (move_uploaded_file($imagemGoogle['tmp_name'], WWW_ROOT . 'files/' . $arquivo)) {
                        if($arquivo != ""){
                            $this->request->data['Revisaosociais']['imagem_google'] = $arquivo;
                        }else{
                            $this->request->data['Revisaosociais']['imagem_google'] = $revisao['imagem_google'];
                        }
                    }
                }

                if ($this->request->data['imagem_instagram_upload']['name'] != null) {
                    $imagemInstagram = $this->request->data['imagem_instagram_upload'];
                    $arquivo = str_replace(' ', '_', $imagemInstagram['name']);
                    if (move_uploaded_file($imagemInstagram['tmp_name'], WWW_ROOT . 'files/' . $arquivo)) {
                        if($arquivo != ""){
                            $this->request->data['Revisaosociais']['imagem_instagram'] = $arquivo;
                        }else{
                            $this->request->data['Revisaosociais']['imagem_instagram'] = $revisao['imagem_instagram'];
                        }
                    }
                }

                $rs = $this->Revisaosociais->patchEntity($rs, $this->request->getData());
                $this->Revisaosociais->save($rs);

                $this->Flash->success(__('A mídia social foi alterada com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A mídia social não pode ser alterada. Por favor, tente novamente'));
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
        $conteudo = $this->Sociais->get($id);
        if ($this->Sociais->delete($conteudo)) {
            $this->Flash->success(__('A mídia social foi deletada.'));
        } else {
            $this->Flash->error(__(' não foi deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function revisao($id = null) {
        $this->loadModel("Revisaosociais");

        $revisaos = $this->Revisaosociais->find("all", [
            'conditions' => [
                'Revisaosociais.social_id' => $id
            ]
        ]);

        $revisao = $revisaos->last();

        $social = $this->Sociais->get($id, [
            'contain' => []
        ]);

        $this->request->data['Revisaosociais']['recebido'] = date("d/m/Y");
        $revisao = $this->Revisaosociais->patchEntity($revisao, $this->request->getData());
        if ($this->Revisaosociais->save($revisao)) {
            $this->request->data['Sociais']['status'] = 'Revisão';
            $social = $this->Sociais->patchEntity($social, $this->request->getData());
            $this->Sociais->save($social);
            $this->Flash->success(__('Enviado para revisão com sucesso.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('A mídia não foi enviado para revisão. Por favor, tente novamente.'));
    }

    public function aprovarRevisao($id = null) {
        $this->loadModel('Profiles');
        $this->loadModel("Revisaosociais");

        $revisaos = $this->Revisaosociais->find("all", [
            'conditions' => [
                'Revisaosociais.social_id' => $id
            ]
        ]);

        $revisao = $revisaos->last();

        $social = $this->Sociais->get($id, [
            'contain' => []
        ]);

        $profiles = $this->Profiles->find('all', [
            'conditions' => [
                'Profiles.user_id' => $this->Auth->user('id')
            ]
        ]);
        $profile = $profiles->first();

        $this->request->data['Sociais']['status'] = 'Aprovação';
        $this->request->data['Revisaosociais']['revisor'] = $profile['id'];
        $this->request->data['Revisaosociais']['revisado'] = date("d/m/Y");
        $revisao = $this->Revisaosociais->patchEntity($revisao, $this->request->getData());
        if ($this->Revisaosociais->save($revisao)) {
            $social = $this->Sociais->patchEntity($social, $this->request->getData());
            $this->Sociais->save($social);
            $this->Flash->success(__('Revisão aprovada com sucesso.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('A revisão não pode ser aprovada. Por favor, tente novamente.'));
    }

    public function reprovarRevisao($id = null) {
        $this->loadModel('Profiles');
        $this->loadModel("Revisaosociais");

        $revisaos = $this->Revisaosociais->find("all", [
            'conditions' => [
                'Revisaosociais.social_id' => $id
            ]
        ]);

        $revisao = $revisaos->last();

        $social = $this->Sociais->get($id, [
            'contain' => []
        ]);

        $profiles = $this->Profiles->find('all', [
            'conditions' => [
                'Profiles.user_id' => $this->Auth->user('id')
            ]
        ]);
        $profile = $profiles->first();

        $this->request->data['Sociais']['status'] = 'Rascunho';
        $this->request->data['Revisaosociais']['revisor'] = $profile['id'];
        $revisao = $this->Revisaosociais->patchEntity($revisao, $this->request->getData());
        if ($this->Revisaosociais->save($revisao)) {
            $social = $this->Sociais->patchEntity($social, $this->request->getData());
            $this->Sociais->save($social);
            $this->Flash->success(__('Revisão reprovada com sucesso.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('A revisão não pode ser reprovada. Por favor, tente novamente.'));
    }

    public function aprovar($id = null) {
        $this->loadModel('Profiles');
        $this->loadModel("Revisaosociais");

        $revisaos = $this->Revisaosociais->find("all", [
            'conditions' => [
                'Revisaosociais.social_id' => $id
            ]
        ]);

        $revisao = $revisaos->last();

        $social = $this->Sociais->get($id, [
            'contain' => []
        ]);

        $profiles = $this->Profiles->find('all', [
            'conditions' => [
                'Profiles.user_id' => $this->Auth->user('id')
            ]
        ]);
        $profile = $profiles->first();

        $this->request->data['Sociais']['status'] = 'Publicação agendada';
        $this->request->data['Revisaosociais']['aprovador'] = $profile['id'];
        $this->request->data['Revisaosociais']['aprovado'] = date("d/m/Y");
        $revisao = $this->Revisaosociais->patchEntity($revisao, $this->request->getData());
        if ($this->Revisaosociais->save($revisao)) {
            $social = $this->Sociais->patchEntity($social, $this->request->getData());
            $this->Sociais->save($social);
            $this->Flash->success(__('Mídia aprovada com sucesso.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('A mídia não pode ser aprovada. Por favor, tente novamente.'));
    }

    public function reprovar($id = null) {
        $this->loadModel('Profiles');
        $this->loadModel("Revisaosociais");

        $revisaos = $this->Revisaosociais->find("all", [
            'conditions' => [
                'Revisaosociais.social_id' => $id
            ]
        ]);

        $revisao = $revisaos->last();

        $social = $this->Sociais->get($id, [
            'contain' => []
        ]);

        $profiles = $this->Profiles->find('all', [
            'conditions' => [
                'Profiles.user_id' => $this->Auth->user('id')
            ]
        ]);
        $profile = $profiles->first();

        $this->request->data['Sociais']['status'] = 'Rascunho';
        $this->request->data['Revisaosociais']['aprovador'] = $profile['id'];
        $social = $this->Revisaosociais->patchEntity($revisao, $this->request->getData());
        if ($this->Revisaosociais->save($revisao)) {
            $social = $this->Sociais->patchEntity($social, $this->request->getData());
            $this->Sociais->save($social);
            $this->Flash->success(__('Conteúdo reprovado com sucesso.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('O conteúdo não pode ser reprovado. Por favor, tente novamente.'));
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
        $this->loadModel('Mensagemsociais');
        $this->autoRender = false;
        $mensagem = $this->Mensagemsociais->newEntity();
        if ($this->request->is('ajax')) {
            $mensagem = $this->Mensagemsociais->patchEntity($mensagem, $this->request->getQuery());

            $this->Mensagemsociais->save($mensagem);
        }

        return null;
    }

}
