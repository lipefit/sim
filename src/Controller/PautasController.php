<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Pautas Controller
 *
 * @property \App\Model\Table\PautasTable $Concorrentes
 *
 * @method \App\Model\Entity\Pauta[] paginate($object = null, array $settings = [])
 */
class PautasController extends AppController {

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
        $this->loadModel('Personas');
        $pauta = $this->Pautas->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['Pautas']['cliente_id'] = $this->Cookie->read('cliente_id');
            $pauta = $this->Pautas->patchEntity($pauta, $this->request->getData());
            if ($this->Pautas->save($pauta)) {
                $this->Flash->success(__('A pauta de conteúdo foi salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A pauta de conteúdo não pode ser salva. Por favor, tente novamente'));
        }
                
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
        $this->loadModel('Personas');
        $pauta = $this->Pautas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pauta = $this->Pautas->patchEntity($pauta, $this->request->getData());
            if ($this->Pautas->save($pauta)) {
                $this->Flash->success(__('A pauta de conteúdo foi salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A pauta de conteúdo não foi salva. Por favor, tente novamente.'));
        }

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
        
}