<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Palavras Controller
 *
 * @property \App\Model\Table\PalavrasTable $Palavras
 *
 * @method \App\Model\Entity\Palavras[] paginate($object = null, array $settings = [])
 */
class PalavrasController extends AppController {

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
        $palavras = $this->Palavras->find('all', [
            'conditions' => [
                'Palavras.cliente_id' => $id
            ]
        ]);

        $this->set(compact('palavras'));
        $this->set('_serialize', ['palavras']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->loadModel('Pautas');
        $this->loadModel('Personas');
        $palavra = $this->Palavras->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['Palavras']['cliente_id'] = $this->Cookie->read('cliente_id');
            $palavra = $this->Palavras->patchEntity($palavra, $this->request->getData());
            if ($this->Palavras->save($palavra)) {
                $this->Flash->success(__('A palavra foi salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A palavra não pode ser salva. Por favor, tente novamente'));
        }
        $personas = $this->Personas->find('list', [
            'conditions' => [
                'Personas.cliente_id' => $this->Cookie->read('cliente_id')
            ]
        ]);
        
        $jornadas = $this->Pautas->getJornadas();
        $this->set(compact('personas'));
        $this->set(compact('palavra'));
        $this->set(compact('jornadas'));
        $this->set('_serialize', ['palavra']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->loadModel('Pautas');
        $this->loadModel('Personas');
        $palavra = $this->Palavras->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $palavra = $this->Palavras->patchEntity($palavra, $this->request->getData());
            if ($this->Palavras->save($palavra)) {
                $this->Flash->success(__('A palavra foi salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A palavra não foi salva. Por favor, tente novamente.'));
        }
        
        $personas = $this->Personas->find('list', [
            'conditions' => [
                'Personas.cliente_id' => $this->Cookie->read('cliente_id')
            ]
        ]);
        $jornadas = $this->Pautas->getJornadas();
        $this->set(compact('palavra'));
        $this->set(compact('jornadas'));
        $this->set(compact('personas'));
        $this->set('_serialize', ['palavra']);
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
        $palavra = $this->Palavras->get($id);
        if ($this->Palavras->delete($palavra)) {
            $this->Flash->success(__('A palavra foi deletada.'));
        } else {
            $this->Flash->error(__('A palavra não foi deletada. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
