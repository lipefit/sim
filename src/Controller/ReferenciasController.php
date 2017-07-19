<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Referencias Controller
 *
 * @property \App\Model\Table\ReferenciasTable $Referencias
 *
 * @method \App\Model\Entity\Referencias[] paginate($object = null, array $settings = [])
 */
class ReferenciasController extends AppController {

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
        $referencias = $this->Referencias->find('all', [
            'conditions' => [
                'Referencias.cliente_id' => $id
            ]
        ]);

        $this->set(compact('referencias'));
        $this->set('_serialize', ['referencias']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $referencia = $this->Referencias->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['Referencias']['cliente_id'] = $this->Cookie->read('cliente_id');
            $referencia = $this->Referencias->patchEntity($referencia, $this->request->getData());
            if ($this->Referencias->save($referencia)) {
                $this->Flash->success(__('A referência foi salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A referência não pode ser salva. Por favor, tente novamente'));
        }
        $this->set(compact('referencia'));
        $this->set('_serialize', ['referencia']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $referencia = $this->Referencias->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $referencia = $this->Referencias->patchEntity($referencia, $this->request->getData());
            if ($this->Referencias->save($referencia)) {
                $this->Flash->success(__('A referência foi salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A referência não foi salva. Por favor, tente novamente.'));
        }
        $this->set(compact('referencia'));
        $this->set('_serialize', ['referencia']);
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
        $referencia = $this->Referencias->get($id);
        if ($this->Referencias->delete($referencia)) {
            $this->Flash->success(__('A referência foi deletada.'));
        } else {
            $this->Flash->error(__('A referência não foi deletada. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
}
