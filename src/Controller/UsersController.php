<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\MailerAwareTrait;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {

    public function initialize() {
        parent::initialize();
        
        $this->Auth->allow('salvarSenha','ativar','login');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Groups']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->Users->get($id, [
            'contain' => ['Groups', 'Aros']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

/**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    Use MailerAwareTrait;

    public function add() {
        $this->loadModel('Profiles');
        $this->loadModel('Hierarquias');
        $this->loadModel('Access');

        $hierarquias = $this->Hierarquias->find('list');
        $this->set(compact('hierarquias'));

        $user = $this->Users->newEntity();
        $profile = $this->Profiles->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['Users']['cliente_id'] = $this->Cookie->read('cliente_id');
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['associated' => ['Hierarquias']]);
            if ($query = $this->Users->save($user)) {
                $idUser = $query->id;
                $this->request->data['Profiles']['user_id'] = $idUser;
                $profile = $this->Profiles->patchEntity($profile, $this->request->getData());
                $this->Profiles->save($profile);

                $token = md5($idUser . date("Y-m-d"));
                $access = $this->Access->newEntity();
                $access->token = $token;
                $access->users_id = $idUser;
                $this->Access->save($access);

                $dados['nome'] = $this->request->data['Profiles']['name'];
                $dados['email'] = $this->request->data['username'];
                $dados['token'] = $token;
                $this->getMailer("Usuario")->send("enviarToken", [$dados]);

                $this->Flash->success(__('O usuário foi salvo com sucesso e o convite foi enviado.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O usuário não foi salvo. Por favor, tente novamente.'));
            }

            $this->Flash->error(__('O usuário não pode ser salvo. Por favor, tente novamente.'));
        }
        $groups = $this->Users->Groups->find('list');
        $this->set(compact('user', 'groups'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->loadModel('Profiles');
        $user = $this->Users->get($id, [
            'contain' => ['Profiles', 'Hierarquias']
        ]);
        $this->loadModel('Hierarquias');

        $hierarquias = $this->Hierarquias->find('list');
        $this->set(compact('hierarquias'));
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['associated' => ['Hierarquias']]);
            if ($query = $this->Users->save($user)) {

                $profile = $this->Profiles->get($this->request->data['Profiles']['id'], [
                    'contain' => []
                ]);
                $profile = $this->Profiles->patchEntity($profile, $this->request->getData());
                $this->Profiles->save($profile);

                $this->Flash->success(__('O usuário foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O usuário não pode ser salvo. Por favor, tente novamente.'));
        }
        $groups = $this->Users->Groups->find('list');
        $this->set(compact('user', 'groups'));
        $this->set('_serialize', ['user']);
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
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('O usuário foi excluído com sucesso.'));
        } else {
            $this->Flash->error(__('O usuário não pode ser excluído. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login() {
        $this->viewBuilder()->setLayout('login');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Seu e-mail e/ou senha estão incorretos.'));
        }
    }

    public function ativar($token) {
        $this->loadModel("Access");
        $this->viewBuilder()->setLayout('login');

        $access = $this->Access->find('all', [
            'conditions' => [
                'Access.token' => $token
            ]
        ]);
        $ac = $access->first();

        if ($ac != null) {
            $user = $this->Users->get($ac['users_id'], [
                'contain' => []
            ]);
            $this->set(compact("user"));
            $this->set('_serialize', ['user']);
        } else {
            return $this->redirect(['action' => 'login']);
        }
    }

    public function salvarSenha($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['Users']['active'] = 1;
            $this->request->data['Users']['status'] = 1;
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($query = $this->Users->save($user)) {
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('A senha não pode ser cadastrada. Por favor, tente novamente.'));
            }
        }
    }

    public function logout() {
        $this->Flash->success(__('Até logo!'));
        $this->redirect($this->Auth->logout());
    }

}
