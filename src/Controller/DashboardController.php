<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class DashboardController extends AppController {

    public function index() {
        $this->loadModel("Conteudos");
        $this->loadModel("Revisaosociais");
        $this->loadModel("Sociais");
        $idCliente = $this->Cookie->read('cliente_id');

        $porPersonas = $this->Conteudos->find('all', [
            'contain' => ['Pautas' => ['Personapublicos']]
        ]);

        $porPersonas->select([
                    'Pautas.persona_id',
                    'Personapublicos.nome',
                    'count' => $porPersonas->func()->count('*')
                ])
                ->where(['Conteudos.cliente_id' => $idCliente])
                ->group('Pautas.persona_id');

        $this->set(compact("porPersonas"));
        
        $porDesafios = $this->Conteudos->find('all', [
            'contain' => ['Pautas' => ['Desafiospublicos']]
        ]);

        $porDesafios->select([
                    'Pautas.desafio_id',
                    'Desafiospublicos.desafio',
                    'count' => $porDesafios->func()->count('*')
                ])
                ->where(['Conteudos.cliente_id' => $idCliente])
                ->group('Pautas.desafio_id');

        $this->set(compact("porDesafios"));
        
        $porStatus = $this->Conteudos->find('all');

        $porStatus->select([
                    'Conteudos.status',
                    'count' => $porStatus->func()->count('*')
                ])
                ->where(['Conteudos.cliente_id' => $idCliente])
                ->group('Conteudos.status');

        $this->set(compact("porStatus"));
        
        $midiaPorPersonas = $this->Revisaosociais->find('all', [
            'contain' => ['Sociais', 'Personapublicos']
        ]);

        $midiaPorPersonas->select([
                    'Revisaosociais.persona_id',
                    'Personapublicos.nome',
                    'count' => $midiaPorPersonas->func()->count('*')
                ])
                ->where(['Sociais.cliente_id' => $idCliente])
                ->group('Revisaosociais.persona_id');

        $this->set(compact("midiaPorPersonas"));    
        
        $facebook = $this->Revisaosociais->find('all', [
            'conditions' => [
                'Sociais.cliente_id' => $idCliente,
                'Revisaosociais.revisao_facebook !=' => ''
            ],
            'contain' => ['Sociais'],
            'group' => ['Revisaosociais.social_id']
             
        ]);
                
        $midiaPorFacebook = $facebook->count();
        
        $this->set(compact("midiaPorFacebook"));
        
        $instagram = $this->Revisaosociais->find('all', [
            'conditions' => [
                'Sociais.cliente_id' => $idCliente,
                'Revisaosociais.revisao_instagram !=' => ''
            ],
            'contain' => ['Sociais'],
            'group' => ['Revisaosociais.social_id']
             
        ]);
                
        $midiaPorInstagram = $instagram->count();
        
        $this->set(compact("midiaPorInstagram"));
        
        $twitter = $this->Revisaosociais->find('all', [
            'conditions' => [
                'Sociais.cliente_id' => $idCliente,
                'Revisaosociais.revisao_twitter !=' => ''
            ],
            'contain' => ['Sociais'],
            'group' => ['Revisaosociais.social_id']
             
        ]);
                
        $midiaPorTwitter = $twitter->count();
        
        $this->set(compact("midiaPorTwitter"));
        
        $linkedin = $this->Revisaosociais->find('all', [
            'conditions' => [
                'Sociais.cliente_id' => $idCliente,
                'Revisaosociais.revisao_linkedin !=' => ''
            ],
            'contain' => ['Sociais'],
            'group' => ['Revisaosociais.social_id']
             
        ]);
                
        $midiaPorLinkedin = $linkedin->count();
        
        $this->set(compact("midiaPorLinkedin"));
        
        $google = $this->Revisaosociais->find('all', [
            'conditions' => [
                'Sociais.cliente_id' => $idCliente,
                'Revisaosociais.revisao_google !=' => ''
            ],
            'contain' => ['Sociais'],
            'group' => ['Revisaosociais.social_id']
             
        ]);
                
        $midiaPorGoogle = $google->count();
        
        $this->set(compact("midiaPorGoogle"));
        
        $midiaPorStatus = $this->Sociais->find('all');

        $midiaPorStatus->select([
                    'Sociais.status',
                    'count' => $midiaPorStatus->func()->count('*')
                ])
                ->where(['Sociais.cliente_id' => $idCliente])
                ->group('Sociais.status');

        $this->set(compact("midiaPorStatus"));
        
    }

}
