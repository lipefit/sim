<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Checklists Controller
 *
 * @property \App\Model\Table\ChecklistTable $Checklists
 *
 * @method \App\Model\Entity\Checklists[] paginate($object = null, array $settings = [])
 */
class ChecklistsController extends AppController {

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
        $checklists = $this->Checklists->find('all', [
            'conditions' => [
                'Checklists.cliente_id' => $id
            ]
        ]);

        $this->set(compact('checklists'));
        $this->set('_serialize', ['checklists']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->loadModel('Perguntas');
        $this->loadModel('Cliente');
        $checklist = $this->Checklists->newEntity();
        if ($this->request->is('post')) {
            $idCliente = $this->Cookie->read('cliente_id');
            $clientes = $this->Cliente->find('all', [
                'conditions' => [
                    'Cliente.id' => $idCliente
                ]
            ]);
            $cliente = $clientes->first();
            $this->request->data['Checklists']['cliente_id'] = $cliente['cliente_id'];
            $this->request->data['Premissas']['created'] = date("Y-m-d");
            $checklist = $this->Checklists->patchEntity($checklist, $this->request->getData());
            if ($query = $this->Checklists->save($checklist)) {
                $idChecklist = $query->id;
                $cont = count($this->request->data['perguntas']);
                for ($x = 0; $x < $cont; $x++) {
                    if ($this->request->data['perguntas'][$x] != "") {
                        $pg = $this->Perguntas->newEntity();
                        $this->request->data['Perguntas']['pergunta'] = $this->request->data['perguntas'][$x];
                        $this->request->data['Perguntas']['categoria'] = $this->request->data['categorias'][$x];
                        $this->request->data['Perguntas']['checklist_id'] = $idChecklist;
                        $pg = $this->Perguntas->patchEntity($pg, $this->request->getData());
                        $this->Perguntas->save($pg);
                    }
                }

                $this->Flash->success(__('O checklist foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O checklist não pode ser salvo. Por favor, tente novamente'));
        }
        $this->set(compact('checklist'));
        $this->set('_serialize', ['checklist']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->loadModel('Perguntas');
        $checklist = $this->Checklists->get($id, [
            'contain' => []
        ]);

        $perguntas = $this->Perguntas->find('all', [
            'conditions' => [
                'Perguntas.checklist_id' => $id
            ]
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $checklist = $this->Checklists->patchEntity($checklist, $this->request->getData());
            if ($this->Checklists->save($checklist)) {

                $cont = count($this->request->data['perguntas']);
                for ($x = 0; $x < $cont; $x++) {
                    if ($this->request->data['perguntas'][$x] != "") {
                        $pg = $this->Perguntas->newEntity();
                        $this->request->data['Perguntas']['pergunta'] = $this->request->data['perguntas'][$x];
                        $this->request->data['Perguntas']['categoria'] = $this->request->data['categorias'][$x];
                        $this->request->data['Perguntas']['checklist_id'] = $id;
                        $pg = $this->Perguntas->patchEntity($pg, $this->request->getData());
                        $this->Perguntas->save($pg);
                    }
                }

                $this->Flash->success(__('O checklist foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O checklist não foi salvo. Por favor, tente novamente.'));
        }
        $this->set(compact('checklist'));
        $this->set(compact('perguntas'));
        $this->set('_serialize', ['checklist']);
        $this->set('_serialize', ['perguntas']);
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
        $checklist = $this->Checklists->get($id);
        if ($this->Checklists->delete($checklist)) {
            $this->Flash->success(__('O checklist foi deletado.'));
        } else {
            $this->Flash->error(__('O checklist não foi deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function deletePerguntas($id = null) {
        $this->loadModel('Perguntas');
        $this->request->allowMethod(['post', 'delete']);
        $pergunta = $this->Perguntas->get($id);
        if ($this->Perguntas->delete($pergunta)) {
            $this->Flash->success(__('A pergunta foi deletada.'));
        } else {
            $this->Flash->error(__('A pergunta não foi deletada. Por favor, tente novamente.'));
        }

        return $this->redirect($this->referer());
    }

    public function responder($id = null) {
        $this->loadModel('Perguntas');
        $checklist = $this->Checklists->get($id, [
            'contain' => []
        ]);

        $perguntas = $this->Perguntas->find('all', [
            'conditions' => [
                'Perguntas.checklist_id' => $id
            ]
        ]);

        $this->set(compact('perguntas'));
        $this->set('_serialize', ['perguntas']);
    }

}
