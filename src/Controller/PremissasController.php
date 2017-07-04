<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Premissas Controller
 *
 * @property \App\Model\Table\PremissasTable $Premissas
 *
 * @method \App\Model\Entity\Escopos[] paginate($object = null, array $settings = [])
 */
class PremissasController extends AppController {

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

        $premissasAgencia = $this->Premissas->find('all', [
            'conditions' => [
                'Premissas.cliente_id' => $id,
                'Premissas.type' => 'Agência'
            ],
            'order' => ['Premissas.id desc'],
            'contain' => ['Users' => ['Profiles']]
        ]);
        
        $premissasCliente = $this->Premissas->find('all', [
            'conditions' => [
                'Premissas.cliente_id' => $id,
                'Premissas.type' => 'Cliente'
            ],
            'order' => ['Premissas.id desc'],
            'contain' => ['Users' => ['Profiles']]
        ]);
        
        $premissasParceiro = $this->Premissas->find('all', [
            'conditions' => [
                'Premissas.cliente_id' => $id,
                'Premissas.type' => 'Parceiro'
            ],
            'order' => ['Premissas.id desc'],
            'contain' => ['Users' => ['Profiles']]
        ]);

        $this->set(compact('premissasAgencia'));
        $this->set(compact('premissasCliente'));
        $this->set(compact('premissasParceiro'));
        $this->set('_serialize', ['premissasAgencia']);
        $this->set('_serialize', ['premissasCliente']);
        $this->set('_serialize', ['premissasParceiro']);
    }

    public function add($type = null) {
        
        $this->set(compact('type'));
        
        $premissa = $this->Premissas->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Auth->User();
            $this->request->data['Premissas']['cliente_id'] = $this->Cookie->read('cliente_id');
            $this->request->data['Premissas']['date'] = date("Y-m-d");
            $this->request->data['Premissas']['user_id'] = $user['id'];
            $premissa = $this->Premissas->patchEntity($premissa, $this->request->getData());
            if ($this->Premissas->save($premissa)) {
                $this->Flash->success(__('Premissas atualizadas com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('As premissas não foram atualizadas. Por favor, tente novamente'));
        }
        
        $this->set(compact('premissa'));
        $this->set('_serialize', ['premissa']);
    }

}
