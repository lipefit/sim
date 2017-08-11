<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Diagnósticos Controller
 *
 * @property \App\Model\Table\DiagnosticosTable $Diagnosticos
 *
 * @method \App\Model\Entity\Diagnosticos[] paginate($object = null, array $settings = [])
 */
class DiagnosticosController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $idCliente = $this->Cookie->read('cliente_id');
        
        $diagnosticos = $this->Diagnosticos->find('all', [
            'conditions' => [
                'Diagnosticos.cliente_id' => $idCliente
            ]
        ]);
        $diagnostico = $diagnosticos->first();

        if($diagnostico == null){
            $diagnostico = $this->Diagnosticos->newEntity();
        }
        if ($this->request->is('post')) {
            $this->request->data['Diagnosticos']['cliente_id'] = $this->Cookie->read('cliente_id');          
            $diagnostico = $this->Diagnosticos->patchEntity($diagnostico, $this->request->getData());
            if ($this->Diagnosticos->save($diagnostico)) {
                $this->Flash->success(__('Dagnóstico atualizado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Diagnóstico não foi atualizado. Por favor, tente novamente'));
        }
        $respostas = $this->Diagnosticos->getRespostas();
        $this->set(compact('diagnostico'));
        $this->set(compact('respostas'));
        $this->set('_serialize', ['diagnostico']);
    }
}