<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\MailerAwareTrait;

/**
 * Acessos Controller
 *
 * @property \App\Model\Table\AcessosTable $Acessos
 *
 * @method \App\Model\Entity\Escopos[] paginate($object = null, array $settings = [])
 */
class AcessosController extends AppController {

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
        $acessos = $this->Acessos->find('all', [
            'conditions' => [
                'Acessos.cliente_id' => $id
            ]
        ]);

        $this->set(compact('acessos'));
        $this->set('_serialize', ['acessos']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $acesso = $this->Acessos->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['Acessos']['cliente_id'] = $this->Cookie->read('cliente_id');
            $acesso = $this->Acessos->patchEntity($acesso, $this->request->getData());
            if ($this->Acessos->save($acesso)) {
                $this->Flash->success(__('O acesso foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O acesso não pode ser salvo. Por favor, tente novamente'));
        }
        $this->set(compact('acesso'));
        $this->set('_serialize', ['acesso']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $acesso = $this->Acessos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $acesso = $this->Acessos->patchEntity($acesso, $this->request->getData());
            if ($this->Acessos->save($acesso)) {
                $this->Flash->success(__('O acesso foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O acesso não foi salvo. Por favor, tente novamente.'));
        }
        $this->set(compact('acesso'));
        $this->set('_serialize', ['acesso']);
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
        $acesso = $this->Acessos->get($id);
        if ($this->Acessos->delete($acesso)) {
            $this->Flash->success(__('O acesso foi deletado.'));
        } else {
            $this->Flash->error(__('O acesso não foi deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    Use MailerAwareTrait;

    public function enviarSenha($id = null) {
        $this->loadModel('Profiles');
        $acesso = $this->Acessos->get($id, [
            'contain' => []
        ]);
        $user = $this->Auth->User();
        $profiles = $this->Profiles->find('all', [
            'conditions' => [
                'Profiles.user_id' => $user['id']
            ]
        ]);
        $profile = $profiles->first();
        $dados['acesso'] = $acesso['nome'];
        $dados['senha'] = $acesso['senha'];
        $dados['email'] = $user['username'];
        $dados['nome'] = $profile['name'];
        $this->getMailer("Acesso")->send("enviarSenha", [$dados]);
        return $this->redirect(['action' => 'index']);
    }

}
