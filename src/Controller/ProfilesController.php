<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Profile Controller
 *
 * @property \App\Model\Table\ProfileTable $Clientes
 *
 * @method \App\Model\Entity\Profile[] paginate($object = null, array $settings = [])
 */
class ProfilesController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $user = $this->Auth->User();
        $profiles = $this->Profiles->find('all', [
            'conditions' => [
                'Profiles.user_id' => $user['id']
            ]
        ]);
        $profile = $profiles->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $profile = $this->Profiles->patchEntity($profile, $this->request->getData());
            if ($this->Profiles->save($profile)) {
                $this->Flash->success(__('O perfil foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O perfil não foi salvo. Por favor, tente novamente.'));
        }
        $this->set(compact('profile'));
        $this->set('_serialize', ['profile']);
    }

}
