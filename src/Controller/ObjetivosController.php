<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Identidades Controller
 *
 * @property \App\Model\Table\IdentidadesTable $Identidades
 *
 * @method \App\Model\Entity\Identidades[] paginate($object = null, array $settings = [])
 */
class ObjetivosController extends AppController {

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
        
        $objetivos = $this->Objetivos->find('all', [
            'conditions' => [
                'Objetivos.cliente_id' => $idCliente
            ]
        ]);
        $objetivo = $objetivos->first();

        if($objetivo == null){
            $objetivo = $this->Objetivos->newEntity();
        }
        if ($this->request->is('post')) {
            $this->request->data['Objetivos']['cliente_id'] = $this->Cookie->read('cliente_id');
            
            $objetivo = $this->Objetivos->patchEntity($objetivo, $this->request->getData());
            if ($this->Objetivos->save($objetivo)) {
                $this->Flash->success(__('Objetivo atualizado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O objetivo não foi atualizado. Por favor, tente novamente'));
        }
        
        $this->set(compact('objetivo'));
        $this->set('_serialize', ['objetivo']);
    }
}