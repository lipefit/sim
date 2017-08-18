<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Anexos Controller
 *
 * @property \App\Model\Table\AnexosTable $Anexos
 *
 * @method \App\Model\Entity\Anexos[] paginate($object = null, array $settings = [])
 */
class AnexosController extends AppController {

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
        $anexos = $this->Anexos->find('all', [
            'conditions' => [
                'Anexos.cliente_id' => $id
            ],
            'contain' => ['Profiles']
        ]);

        $this->set(compact('anexos'));
        $this->set('_serialize', ['anexos']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->loadModel("Profiles");
        $anexo = $this->Anexos->newEntity();
        if ($this->request->is('post')) {
            $profiles = $this->Profiles->find('all', [
                'conditions' => [
                    'Profiles.user_id' => $this->Auth->user('id')
                ]
            ]);
            $profile = $profiles->first();
            $this->request->data['Anexos']['cliente_id'] = $this->Cookie->read('cliente_id');
            $this->request->data['Anexos']['profile_id'] = $profile['id'];
            $file = $this->request->data['file'];
            $arquivo =  str_replace(' ', '_', $file['name']);
            if (move_uploaded_file($file['tmp_name'], WWW_ROOT . 'files'. DS . $arquivo)) {
                $this->request->data['Anexos']['anexo'] = $arquivo;
            }
            $anexo = $this->Anexos->patchEntity($anexo, $this->request->getData());
            if ($this->Anexos->save($anexo)) {
                $this->Flash->success(__('O anexo foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O anexo não pode ser salvo. Por favor, tente novamente'));
        }
        $this->set(compact('anexo'));
        $this->set('_serialize', ['anexo']);
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
        $anexo = $this->Anexos->get($id);
        if ($this->Anexos->delete($anexo)) {
            $this->Flash->success(__('O anexo foi deletado.'));
        } else {
            $this->Flash->error(__('O anexo não foi deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}