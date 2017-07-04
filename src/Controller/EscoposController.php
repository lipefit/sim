<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Escopos Controller
 *
 * @property \App\Model\Table\ClienteTable $Escopos
 *
 * @method \App\Model\Entity\Escopos[] paginate($object = null, array $settings = [])
 */
class EscoposController extends AppController {

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
        $escopos = $this->Escopos->find('all', [
            'conditions' => [
                'Escopos.cliente_id' => $id
            ]
        ]);

        $this->set(compact('escopos'));
        $this->set('_serialize', ['escopos']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $escopo = $this->Escopos->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['Escopos']['cliente_id'] = $this->Cookie->read('cliente_id');
            $escopo = $this->Escopos->patchEntity($escopo, $this->request->getData());
            if ($this->Escopos->save($escopo)) {
                $this->Flash->success(__('O serviço foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O serviço não pode ser salvo. Por favor, tente novamente'));
        }
        $frequencias = $this->getFrequencias();
        $this->set(compact('escopo'));
        $this->set(compact('frequencias'));
        $this->set('_serialize', ['escopo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $escopo = $this->Escopos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $escopo = $this->Escopos->patchEntity($escopo, $this->request->getData());
            if ($this->Escopos->save($escopo)) {
                $this->Flash->success(__('O serviço foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O serviço não foi salvo. Por favor, tente novamente.'));
        }
        $frequencias = $this->getFrequencias();
        $this->set(compact('escopo'));
        $this->set(compact('frequencias'));
        $this->set('_serialize', ['escopo']);
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
        $escopo = $this->Escopos->get($id);
        if ($this->Escopos->delete($escopo)) {
            $this->Flash->success(__('O serviço foi deletado.'));
        } else {
            $this->Flash->error(__('O serviço não foi deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function getFrequencias() {
        return array(
            'Diária' => 'Diária',
            'Semanal' => 'Semanal',
            'Quinzenal' => 'Quinzenal',
            'Mensal' => 'Mensal',
        );
    }

}
