<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Calendario Controller
 *
 * @property \App\Model\Table\CalendarioTable $Calendario
 *
 * @method \App\Model\Entity\Calendario[] paginate($object = null, array $settings = [])
 */
class CalendarioController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->viewBuilder()->setLayout('default2');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $this->loadModel("Conteudos");
        $this->loadModel("Revisaosociais");
        $idCliente = $this->Cookie->read('cliente_id');
        $conteudos = $this->Conteudos->find('all', [
            'conditions' => [
                'Conteudos.cliente_id' => $idCliente
            ],
            'contain' => ['Pautas']
        ]);
        
        $sociais = $this->Revisaosociais->find('all', [
            'conditions' => [
                'Sociais.cliente_id' => $idCliente
            ],
            'group' => ['social_id'],
            'contain' => ['Pautas','Sociais']
        ]);
        $this->set(compact("sociais"));       
        $this->set(compact("conteudos"));       
    }

}
