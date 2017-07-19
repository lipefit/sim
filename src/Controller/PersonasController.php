<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Personas Controller
 *
 * @property \App\Model\Table\PersonasTable $Personas
 *
 * @method \App\Model\Entity\Personas[] paginate($object = null, array $settings = [])
 */
class PersonasController extends AppController {

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
        $personas = $this->Personas->find('all', [
            'conditions' => [
                'Personas.cliente_id' => $id
            ]
        ]);

        $this->set(compact('personas'));
        $this->set('_serialize', ['personas']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $persona = $this->Personas->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['Personas']['cliente_id'] = $this->Cookie->read('cliente_id');
            $persona = $this->Personas->patchEntity($persona, $this->request->getData());
            if ($this->Personas->save($concorrente)) {
                $this->Flash->success(__('A persona da marca foi salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A persona da marca não pode ser salva. Por favor, tente novamente'));
        }
        $sexos = $this->getSexos();
        $this->set(compact('sexos'));
        $this->set(compact('persona'));
        $this->set('_serialize', ['persona']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $persona = $this->Personas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $persona = $this->Personas->patchEntity($persona, $this->request->getData());
            if ($this->Personas->save($persona)) {
                $this->Flash->success(__('A persona da marca foi salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A persona da marca não foi salva. Por favor, tente novamente.'));
        }
        $sexos = $this->getSexos();
        $this->set(compact('sexos'));
        $this->set(compact('persona'));
        $this->set('_serialize', ['persona']);
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
        $persona = $this->Personas->get($id);
        if ($this->Personas->delete($persona)) {
            $this->Flash->success(__('A persona da marca foi deletada.'));
        } else {
            $this->Flash->error(__('A persona da marca não foi deletada. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function getSexos() {
        return array(
            'Masculino' => 'Masculino',
            'Feminino' => 'Feminino'
        );
    }
    
}
