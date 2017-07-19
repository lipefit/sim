<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Concorrentes Controller
 *
 * @property \App\Model\Table\ConcorrentesTable $Concorrentes
 *
 * @method \App\Model\Entity\Concorrentes[] paginate($object = null, array $settings = [])
 */
class ConcorrentesController extends AppController {

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
        $concorrentes = $this->Concorrentes->find('all', [
            'conditions' => [
                'Concorrentes.cliente_id' => $id
            ]
        ]);

        $this->set(compact('concorrentes'));
        $this->set('_serialize', ['concorrentes']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $concorrente = $this->Concorrentes->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['Concorrentes']['cliente_id'] = $this->Cookie->read('cliente_id');
            $concorrente = $this->Concorrentes->patchEntity($concorrente, $this->request->getData());
            if ($this->Concorrentes->save($concorrente)) {
                $this->Flash->success(__('O concorrente foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O concorrente não pode ser salvo. Por favor, tente novamente'));
        }
        $tipos = $this->getTipos();
        $this->set(compact('tipos'));
        $this->set(compact('concorrente'));
        $this->set('_serialize', ['concorrente']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $concorrente = $this->Concorrentes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $concorrente = $this->Concorrentes->patchEntity($concorrente, $this->request->getData());
            if ($this->Concorrentes->save($concorrente)) {
                $this->Flash->success(__('O concorrente foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O concorrente não foi salvo. Por favor, tente novamente.'));
        }
        $tipos = $this->getTipos();
        $this->set(compact('tipos'));
        $this->set(compact('concorrente'));
        $this->set('_serialize', ['concorrente']);
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
        $concorrente = $this->Concorrentes->get($id);
        if ($this->Concorrentes->delete($concorrente)) {
            $this->Flash->success(__('O concorrente foi deletado.'));
        } else {
            $this->Flash->error(__('O concorrente não foi deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function getTipos() {
        return array(
            'Direto' => 'Direto',
            'Indireto' => 'Indireto'
        );
    }
    
}
