<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class DashboardController extends AppController {

    public function index() {
        $this->loadModel("Conteudos");
        $idCliente = $this->Cookie->read('cliente_id');

        $porPersonas = $this->Conteudos->find('list', [
            'select' => [
                'Pautas.persona_id',
                'Personapublicos.nome',
                'count' => $this->Conteudos->find()->func()->count('Pautas.persona_id')
            ],
            'conditions' => [
                'Conteudos.cliente_id' => $idCliente
            ],
            'group' => [
                'Pautas.persona_id'
            ],
            'contain' => ['Pautas' => ['Personapublicos']]
        ]);
        $this->set(compact("porPersonas"));
    }

}
