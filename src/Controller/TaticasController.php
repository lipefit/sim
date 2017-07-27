<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Taticas Controller
 *
 * @property \App\Model\Table\TaticasTable $Concorrentes
 *
 * @method \App\Model\Entity\Tatica[] paginate($object = null, array $settings = [])
 */
class TaticasController extends AppController {

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
        $taticas = $this->Taticas->find('all', [
            'conditions' => [
                'Taticas.cliente_id' => $id
            ]
        ]);

        $this->set(compact('taticas'));
        $this->set('_serialize', ['taticas']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $tatica = $this->Taticas->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['Taticas']['cliente_id'] = $this->Cookie->read('cliente_id');
            $tatica = $this->Taticas->patchEntity($tatica, $this->request->getData());
            if ($this->Taticas->save($concorrente)) {
                $this->Flash->success(__('A tática de conteúdo foi salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A tática de conteúdo não pode ser salva. Por favor, tente novamente'));
        }
        $this->set(compact('tatica'));
        $this->set('_serialize', ['tatica']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $tatica = $this->Taticas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tatica = $this->Taticas->patchEntity($tatica, $this->request->getData());
            if ($this->Taticas->save($concorrente)) {
                $this->Flash->success(__('A tática de conteúdo foi salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A tática de conteúdo não foi salva. Por favor, tente novamente.'));
        }
        $this->set(compact('tatica'));
        $this->set('_serialize', ['tatica']);
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
        $tatica = $this->Taticas->get($id);
        if ($this->Taticas->delete($tatica)) {
            $this->Flash->success(__('A tática de conteúdo foi deletada.'));
        } else {
            $this->Flash->error(__('A tática de conteúdo não foi deletada. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
        
}