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
class ProjetosController extends AppController {

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
    }
}
