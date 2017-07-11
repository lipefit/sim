<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Canvas Controller
 *
 * @property \App\Model\Table\CanvasTable $Canvas
 *
 * @method \App\Model\Entity\Cliente[] paginate($object = null, array $settings = [])
 */
class CanvasController extends AppController {

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
        $canvas = $this->Canvas->find('all', [
            'conditions' => [
                'Canvas.cliente_id' => $id
            ]
        ]);

        $this->set(compact('canvas'));
        $this->set('_serialize', ['canvas']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cliente_id = $this->Cookie->read('cliente_id');
        $canvas = $this->Canvas->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['Canvas']['data'] = date("Y-m-d");
            $this->request->data['Canvas']['cliente_id'] = $cliente_id;
            $canvas = $this->Canvas->patchEntity($canvas, $this->request->getData());
            if ($this->Canvas->save($canvas)) {
                $this->Flash->success(__('O canvas foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O canvas não pode ser salvo. Por favor, tente novamente'));
        }
        $this->set(compact('canvas'));
        $this->set('_serialize', ['canvas']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $canvas = $this->Canvas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $canvas = $this->Canvas->patchEntity($canvas, $this->request->getData());
            if ($this->Canvas->save($canvas)) {
                $this->Flash->success(__('O canvas foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O canvas não foi salvo. Por favor, tente novamente.'));
        }
        $this->set(compact('canvas'));
        $this->set('_serialize', ['canvas']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $canvas = $this->Canvas->get($id);
        if ($this->Canvas->delete($canvas)) {
            $this->Flash->success(__('O canvas foi deletado.'));
        } else {
            $this->Flash->error(__('O canvas não foi deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function ver($id) {
        $this->loadModel('Postits');
        $canvas = $this->Canvas->get($id, [
            'contain' => []
        ]);

        $parceirosChave = $this->Postits->find('all', array(
            'conditions' => array(
                'Postits.canvas_id' => $id,
                'Postits.tipo' => 'parceiros-chave'
            )
        ));

        $atividadesChave = $this->Postits->find('all', array(
            'conditions' => array(
                'Postits.canvas_id' => $id,
                'Postits.tipo' => 'atividades-chave'
            )
        ));
        $recursosChave = $this->Postits->find('all', array(
            'conditions' => array(
                'Postits.canvas_id' => $id,
                'Postits.tipo' => 'recursos-chave'
            )
        ));
        $propostaDeValor = $this->Postits->find('all', array(
            'conditions' => array(
                'Postits.canvas_id' => $id,
                'Postits.tipo' => 'proposta-de-valor'
            )
        ));
        $relacaoComCliente = $this->Postits->find('all', array(
            'conditions' => array(
                'Postits.canvas_id' => $id,
                'Postits.tipo' => 'relacao-com-o-cliente'
            )
        ));
        $canais = $this->Postits->find('all', array(
            'conditions' => array(
                'Postits.canvas_id' => $id,
                'Postits.tipo' => 'canais'
            )
        ));
        $segmentosDeMercado = $this->Postits->find('all', array(
            'conditions' => array(
                'Postits.canvas_id' => $id,
                'Postits.tipo' => 'segmentos-de-mercado'
            )
        ));
        $estruturaDeCustos = $this->Postits->find('all', array(
            'conditions' => array(
                'Postits.canvas_id' => $id,
                'Postits.tipo' => 'estrutura-de-custos'
            )
        ));
        $fontesDeRenda = $this->Postits->find('all', array(
            'conditions' => array(
                'Postits.canvas_id' => $id,
                'Postits.tipo' => 'fontes-de-renda'
            )
        ));

        $this->set(compact("canvas"));
        $this->set(compact("parceirosChave"));
        $this->set(compact("atividadesChave"));
        $this->set(compact("recursosChave"));
        $this->set(compact("propostaDeValor"));
        $this->set(compact("relacaoComCliente"));
        $this->set(compact("canais"));
        $this->set(compact("segmentosDeMercado"));
        $this->set(compact("estruturaDeCustos"));
        $this->set(compact("fontesDeRenda"));
    }

    public function savePost() {
        $this->loadModel('Postits');
        $this->autoRender = false;
        $postits = $this->Postits->newEntity();

        if ($this->request->is('post')) {
            $this->request->data['Postits']['texto'] = $this->request->data['body'];
            $this->request->data['Postits']['cor'] = $this->request->data['color'];
            $this->request->data['Postits']['canvas_id'] = $this->request->data['canvas'];
            $this->request->data['Postits']['tipo'] = $this->request->data['tipo'];
            $postits = $this->Postits->patchEntity($postits, $this->request->getData());

            if ($this->Postits->save($postits)) {
                echo "1";
            } else {
                echo "0";
            }
        }
    }

    public function editPost() {
        $this->loadModel('Postits');
        $this->autoRender = false;
        $postits = $this->Postits->get($this->request->data['id'], [
            'contain' => []
        ]);

        if ($this->request->is('post')) {
            $this->request->data['Postits']['texto'] = $this->request->data['body'];
            $this->request->data['Postits']['cor'] = $this->request->data['color'];
            $this->request->data['Postits']['canvas_id'] = $this->request->data['canvas'];
            $this->request->data['Postits']['tipo'] = $this->request->data['tipo'];
            $this->request->data['Postits']['id'] = $this->request->data['id'];
            $postits = $this->Postits->patchEntity($postits, $this->request->getData());

            if ($this->Postits->save($postits)) {
                echo "1";
            } else {
                echo "0";
            }
        }
    }

    public function excluirPost($id) {
        $this->loadModel('Postits');
        $this->autoRender = false;
        $this->request->allowMethod(['post', 'delete']);
        $postits = $this->Postits->get($id);

        if ($this->Postits->delete($postits)) {
            $this->redirect($this->referer());
        } else {
            $this->Flash->success(__('O postit nao foi deletado. Por favor, tente novamente.'));
            $this->redirect($this->referer());
        }
    }

}
