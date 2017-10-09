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
class IdentidadesController extends AppController {

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

        $identidades = $this->Identidades->find('all', [
            'conditions' => [
                'Identidades.cliente_id' => $idCliente
            ]
        ]);
        $identidade = $identidades->first();

        if ($identidade == null) {
            $identidade = $this->Identidades->newEntity();
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['Identidades']['cliente_id'] = $this->Cookie->read('cliente_id');

            $file = $this->request->data['file'];
            $arquivo = str_replace(' ', '_', $file['name']);
            if (move_uploaded_file($file['tmp_name'], WWW_ROOT . 'files/' . $arquivo)) {
                $this->request->data['Identidades']['arquivo'] = $arquivo;
            }

            $identidade = $this->Identidades->patchEntity($identidade, $this->request->getData());
            if ($this->Identidades->save($identidade)) {
                $this->Flash->success(__('Identidade visual atualizada com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }else{
                $this->Flash->error(__('A identidade visual não foi atualizada. Por favor, tente novamente'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('identidade'));
        $this->set('_serialize', ['identidade']);
    }
}
