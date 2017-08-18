<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Solicitacoes Controller
 *
 * @property \App\Model\Table\SolicitacoesTable $Solicitacoes
 *
 * @method \App\Model\Entity\Solicitacoes[] paginate($object = null, array $settings = [])
 */
class SolicitacoesController extends AppController {

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
        $solicitacoes = $this->Solicitacoes->find('all', [
            'conditions' => [
                'Solicitacoes.cliente_id' => $id
            ],
            'contain' => ['Profiles']
        ]);

        $this->set(compact('solicitacoes'));
        $this->set('_serialize', ['solicitacoes']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->loadModel("Profiles");
        $solicitacao = $this->Solicitacoes->newEntity();
        if ($this->request->is('post')) {
            $profiles = $this->Profiles->find('all', [
                'conditions' => [
                    'Profiles.user_id' => $this->Auth->user('id')
                ]
            ]);
            $profile = $profiles->first();
            $this->request->data['Solicitacoes']['cliente_id'] = $this->Cookie->read('cliente_id');
            $this->request->data['Solicitacoes']['profile_id'] = $profile['id'];
            $solicitacao = $this->Solicitacoes->patchEntity($solicitacao, $this->request->getData());
            if ($this->Solicitacoes->save($solicitacao)) {
                $this->Flash->success(__('A solicitação foi salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A solicitação não pode ser salva. Por favor, tente novamente'));
        }
        $this->set(compact('solicitacao'));
        $this->set('_serialize', ['solicitacao']);
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
        $solicitacao = $this->Solicitacoes->get($id);
        if ($this->Solicitacoes->delete($solicitacao)) {
            $this->Flash->success(__('A solicitação foi deletada.'));
        } else {
            $this->Flash->error(__('A solicitação não foi deletada. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
