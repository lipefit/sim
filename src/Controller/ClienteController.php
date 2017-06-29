<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Cliente Controller
 *
 * @property \App\Model\Table\ClienteTable $Clientes
 *
 * @method \App\Model\Entity\Cliente[] paginate($object = null, array $settings = [])
 */
class ClienteController extends AppController {

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
        $clientes = $this->Cliente->find('all', [
            'conditions' => [
                'Cliente.cliente_id' => $id
            ]
        ]);

        $this->set(compact('clientes'));
        $this->set('_serialize', ['clientes']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $cliente = $this->Cliente->get($id, [
            'contain' => []
        ]);

        $this->set('cliente', $cliente);
        $this->set('_serialize', ['cliente']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cliente = $this->Cliente->newEntity();
        if ($this->request->is('post')) {
            $cliente = $this->Cliente->patchEntity($cliente, $this->request->getData());
            if ($this->Cliente->save($cliente)) {
                $this->Flash->success(__('O cliente foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O cliente não pode ser salvo. Por favor, tente novamente'));
        }
        $this->set(compact('cliente'));
        $this->set('_serialize', ['cliente']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cliente = $this->Cliente->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cliente = $this->Cliente->patchEntity($cliente, $this->request->getData());
            if ($this->Cliente->save($cliente)) {
                $this->Flash->success(__('O cliente foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O cliente não foi salvo. Por favor, tente novamente.'));
        }
        $this->set(compact('cliente'));
        $this->set('_serialize', ['cliente']);
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
        $cliente = $this->Cliente->get($id);
        if ($this->Cliente->delete($cliente)) {
            $this->Flash->success(__('O cliente foi deletado.'));
        } else {
            $this->Flash->error(__('O cliente não foi deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function alteraSessao($id = null) {
        $cliente = $this->Cliente->get($id, [
            'contain' => []
        ]);
        if ($cliente) {
            $this->Cookie->write('cliente_id', $id);
            $this->redirect('/');
        } else {
            $this->Flash->error(__('Cliente inexistente.'));
            $this->redirect('/');
        }
    }

}
