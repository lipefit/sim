<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Google Controller
 *
 * @property \App\Model\Table\GoogleTable $Google
 *
 * @method \App\Model\Entity\Google[] paginate($object = null, array $settings = [])
 */
class GoogleController extends AppController {

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
        $google = $this->Google->newEntity();

        $googles = $this->Google->find('list', array(
            'conditions' => array(
                'Google.cliente_id' => $idCliente
            )
        ));

        $google = $googles->first();

        $this->set(compact("google"));
    }

    public function oauth2callback() {
        
    }

    public function add() {
        $cliente_id = $this->Cookie->read('cliente_id');

        $googles = $this->Google->find('list', array(
            'conditions' => array(
                'Google.cliente_id' => $cliente_id
            )
        ));
        
        $google = $googles->first();

        if (@$google['id'] != null) {
            $this->request->data['Google']['id'] = $google['id'];
        } else {
            $google = $this->Google->newEntity();
        }

        $this->request->data['Google']['cliente_id'] = $cliente_id;
        $this->request->data['Google']['site'] = $this->request->data['site'];
        $this->request->data['Google']['token'] = $this->request->data['token'];
        $google = $this->Google->patchEntity($google, $this->request->getData());
        if ($this->Google->save($google)) {
            $this->Flash->success(__('Site escolhido com sucesso'));
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error('Erro ao escolher site');
            return $this->redirect(['action' => 'index']);
        }
    }

    public function deslogar($id) {
        $google = $this->Google->get($id);
        if ($this->Google->delete($twitter)) {
            $this->Flash->success(__('Desconectado com sucesso'));
        } else {
            $this->Flash->error(__('Google não pode ser desconectado'));
        }

        return $this->redirect(['action' => 'index']);
       
    }

}
