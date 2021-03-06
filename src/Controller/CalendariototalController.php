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
class CalendariototalController extends AppController {

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
        $this->loadModel("Cliente");
        $user = $this->Auth->User();
        $clientes = $this->Cliente->find('list', [
            'conditions' => [
                'Cliente.status' => 1,
                'Cliente.cliente_id' => $user['cliente_id']
            ]
        ]);


        $arrConditionClientes = array();
        $arrConditionClientes2 = array();
        foreach ($clientes as $k => $cliente) {
            $arrConditionClientes[]['Conteudos.cliente_id'] = $k;
            $arrConditionClientes2[]['Sociais.cliente_id'] = $k;
        }

        $conteudos = $this->Conteudos->find('all', [
            'conditions' => [
                'OR' => $arrConditionClientes
            ],
            'contain' => ['Pautas']
        ]);

        $sociais = $this->Revisaosociais->find('all', [
            'conditions' => [
                'OR' => $arrConditionClientes2
            ],
            'group' => ['social_id'],
            'contain' => ['Pautas','Sociais']
        ]);
        $this->set(compact("sociais"));
        $this->set(compact("conteudos"));
    }

}
