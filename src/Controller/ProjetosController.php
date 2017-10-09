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
        $cliente_id = $this->Cookie->read('cliente_id');
        $projetos = $this->Projetos->find('all', array(
            'conditions' => array(
                'Projetos.cliente_id' => $cliente_id
            )
        ));

        $this->set(compact('projetos'));
        $this->set('_serialize', ['projetos']);
    }

    public function add() {
        $cliente_id = $this->Cookie->read('cliente_id');
        $projeto = $this->Projetos->newEntity();

        if ($this->request->is('post')) {
            $this->request->data['Projetos']['cliente_id'] = $cliente_id;
            $projeto = $this->Projetos->patchEntity($projeto, $this->request->getData());
            if ($this->Projetos->save($projeto)) {
                $this->Flash->success('Projeto cadastrado com sucesso!');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error('Projeto não pode ser cadastrado!');
                $this->redirect(array('action' => 'index'));
            }
        }

        $this->set(compact('projeto'));
    }

    public function edit($id) {
        $projeto = $this->Projetos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projeto = $this->Projetos->patchEntity($projeto, $this->request->getData());
            if ($this->Projetos->save($projeto)) {
                $this->Flash->success(__('O projeto foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O projeto não foi salvo. Por favor, tente novamente.'));
        }

        $this->set(compact("projeto"));
    }

    public function programacao($id) {
        $this->loadModel("Cliente");
        $this->loadModel("Profiles");
        $this->loadModel("Users");
        $projeto = $this->Projetos->get($id, [
            'contain' => []
        ]);

        $cliente_id = $this->Cookie->read('cliente_id');
        $clientes = $this->Cliente->find('list', array(
            'conditions' => array(
                'Cliente.id' => $cliente_id,
            )
        ));
        $cliente = $clientes->first();

        $user = $this->Auth->User();

        $users = $this->Users->find('list', array(
            'conditions' => array(
                'OR' => array(
                    'Users.cliente_id' => $cliente_id,
                    'Users.cliente_id' => $user['cliente_id'],
                )
            ),
            'contain' => ['Profiles']
        ));

        $this->set(compact("projeto"));
        $this->set(compact('users'));
    }

//    public function addProjeto() {
//        if ($this->request->is('post')) {
//            if ($this->CampanhaProjeto->save($this->request->data['CampanhaProjeto'])) {
//                $this->redirect(array('action' => 'programacao', $this->request->data['CampanhaProjeto']['campanha_id']));
//            } else {
//                $this->Session->setFlash('Projeto não pode ser cadastrado!', 'error_flash');
//                $this->redirect(array('action' => 'programacao', $this->request->data['CampanhaProjeto']['campanha_id']));
//            }
//        }
//    }

    public function addAtividade() {
        $this->loadModel("Projetoatividades");
        $atividade = $this->Projetoatividades->newEntity();
        if ($this->request->is('post')) {
            $atividade = $this->Projetoatividades->patchEntity($atividade, $this->request->getData());
            if ($this->Projetoatividades->save($atividade)) {
                $this->redirect(array('action' => 'programacao', $this->request->data['projeto_id']));
            } else {
                $this->Flash->error('Atividade não pode ser cadastrada!');
                $this->redirect(array('action' => 'programacao', $this->request->data['projeto_id']));
            }
        }
    }

    public function addTarefa() {
        $this->loadModel("Projetotarefas");
        $tarefa = $this->Projetotarefas->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['Projetotarefas']['status'] = "Avaliando";
            $this->request->data['Projetotarefas']['tempo'] = "00:00:00";
            $tarefa = $this->Projetotarefas->patchEntity($tarefa, $this->request->getData());
//            if ($this->request->data['inicio'] != null) {
//                $this->request->data['inicio'] = implode("-", array_reverse(explode("/", $this->request->data['CampanhaTarefa']['inicio'])));
//            }
//            if ($this->request->data['CampanhaTarefa']['entrega'] != null) {
//                $this->request->data['CampanhaTarefa']['entrega'] = implode("-", array_reverse(explode("/", $this->request->data['CampanhaTarefa']['entrega'])));
//            }

            if ($this->Projetotarefas->save($tarefa)) {
                $this->redirect(array('action' => 'programacao', $this->request->data['projeto_id']));
            } else {
                $this->Flash->error('Tarefa não pode ser cadastrada!');
                $this->redirect(array('action' => 'programacao', $this->request->data['projeto_id']));
            }
        }
    }

    public function entregarTarefa($id) {
        $this->loadModel("Projetotarefas");
        if ($id) {
            $tarefa = $this->Projetotarefas->get($id, [
                'contain' => []
            ]);

            $this->request->data['Projetotarefas']['status'] = "Finalizada";
            $this->request->data['Projetotarefas']['entregaReal'] = date("Y-m-d");
            $tarefa = $this->Projetotarefas->patchEntity($tarefa, $this->request->getData());
            $this->Projetotarefas->save($tarefa);
            $this->redirect($this->referer());
        }
    }

    public function reabrirTarefa($id) {
        $this->loadModel("Projetotarefas");
        if ($id) {
            $tarefa = $this->Projetotarefas->get($id, [
                'contain' => []
            ]);

            $this->request->data['Projetotarefas']['status'] = "Pausada";
            $tarefa = $this->Projetotarefas->patchEntity($tarefa, $this->request->getData());
            $this->Projetotarefas->save($tarefa);
            $this->redirect($this->referer());
        }
    }

    public function apagarTarefa($id) {
        $this->loadModel("Projetotarefas");
        $this->request->allowMethod(['post', 'delete']);
        $tarefa = $this->Projetotarefas->get($id);
        if ($this->Projetotarefas->delete($tarefa)) {
            $this->redirect($this->referer());
        }
    }

    public function apagarAtividade($id) {
        $this->loadModel("Projetoatividades");
        $this->request->allowMethod(['post', 'delete']);
        $atividade = $this->Projetoatividades->get($id);
        if ($this->Projetoatividades->delete($atividade)) {
            $this->redirect($this->referer());
        }
    }

//    public function apagarProjeto($id) {
//        if ($id) {
//            $this->CampanhaProjeto->id = $id;
//            if ($this->CampanhaProjeto->exists()) {
//                $this->CampanhaProjeto->delete();
//                $this->redirect($this->referer());
//            }
//        }
//    }

    public function consultaTempo() {
        $this->loadModel("Projetotarefas");
        $this->autoRender = false;
        $id = @$_GET['tarefa'];

        $tarefas = $this->Projetotarefas->find('all', array(
            'conditions' => array(
                'Projetotarefas.id' => $id
            )
        ));

        $tarefa = $tarefas->first();
        $lastPlay = explode(" ", $tarefa['lastPlay']->format('Y-m-d H:i:s'));
        $lastPlayDate = explode("-", $lastPlay[0]);
        $lastPlayTime = explode(":", $lastPlay[1]);

        $timestampLastPlay = mktime($lastPlayTime[0], $lastPlayTime[1], $lastPlayTime[2], $lastPlayDate[1], $lastPlayDate[2], $lastPlayDate[0]);
        $timestampAtual = mktime(date("H"), date("i"), date("s"), date("d"), date("m"), date("Y"));

        $timestamp = $timestampAtual - $timestampLastPlay;
        
        $tempoAtual = explode(":", $tarefa['tempo']);
        $segundos = $tempoAtual[2];
        $minutos = $tempoAtual[1];
        $horas = $tempoAtual[0];

        $timeCurrent = mktime($horas, $minutos, $segundos, 0, 0, 0);

        $time = $timestamp + $timeCurrent;

        $tempo = date("H:i:s", $time);

        echo $tempo;
    }

    public function mudaStatus() {
        $this->loadModel("Projetotarefas");
        $this->autoRender = false;
        $id = @$_GET['tarefa'];
        $status = @$_GET['status'];
        if ($status != "Trabalhando") {
            if ($status == "Pausada") {
                $tarefas = $this->Projetotarefas->find('all', array(
                    'conditions' => array(
                        'Projetotarefas.id' => $id
                    )
                ));
                $tf = $tarefas->first();

                $lastPlay = explode(" ", $tarefa['lastPlay']);
                $lastPlayDate = explode("-", $lastPlay[0]);
                $lastPlayTime = explode(":", $lastPlay[1]);

                $data = date("Y-m-d H:i:s");

                $timestampLastPlay = mktime($lastPlayTime[0], $lastPlayTime[1], $lastPlayTime[2], $lastPlayDate[1], $lastPlayDate[2], $lastPlayDate[0]);
                $timestampAtual = mktime(date("H"), date("i"), date("s"), date("d"), date("m"), date("Y"));

                $timestamp = $timestampAtual - $timestampLastPlay;

                $tempoAtual = explode(":", $tarefa['tempo']);
                $segundos = $tempoAtual[2];
                $minutos = $tempoAtual[1];
                $horas = $tempoAtual[0];

                $timeCurrent = mktime($horas, $minutos, $segundos, 0, 0, 0);

                $time = $timestamp + $timeCurrent;

                $tempo = date("H:i:s", $time);

                $this->request->data['Projetotarefas']['tempo'] = $tempo;
                $this->request->data['Projetotarefas']['status'] = $status;
                $tf = $this->Projetotarefas->patchEntity($tf, $this->request->getData());
                $this->Projetotarefas->save($tf);
            } else {
                $this->request->data['Projetotarefas']['status'] = $status;
                $tf = $this->Projetotarefas->patchEntity($tf, $this->request->getData());
                $this->Projetotarefas->save($tf);
            }
        } else {
            $tarefas = $this->Projetotarefas->find('all', array(
                'conditions' => array(
                    'Projetotarefas.id' => $id
                )
            ));
            $tf = $tarefas->first();
            $data = date("d/m/Y H:i:s");
            $this->request->data['Projetotarefas']['lastPlay'] = $data;
            $this->request->data['Projetotarefas']['status'] = $status;
            $tf = $this->Projetotarefas->patchEntity($tf, $this->request->getData());
            $this->Projetotarefas->save($tf);
        }
        echo $data;
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Campanha->id = $id;
        if (!$this->Campanha->exists()) {
            throw new NotFoundException("Campanha não existe");
        }
        if ($this->Campanha->delete()) {
            $this->Session->setFlash('Campanha excluida', 'success_flash');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Campanha nao pode ser excluida', 'error_flash');
        $this->redirect(array('action' => 'index'));
    }

    public function relatorio() {
        $cliente_id = $this->Cookie->read('cliente_id');
        $campanhas = $this->Campanha->find('list', array(
            'conditions' => array(
                'Campanha.cliente_id' => $cliente_id
            ),
            'recursive' => 2
        ));

        $this->set(compact('campanhas'));

        if ($this->request->is('post')) {

            $cp = $this->request->data['Campanhas']['campanha'];

            $this->Campanha->id = $cp;

            if (!$this->Campanha->exists()) {
                $this->Campanha->id = null;
                $this->Session->setFlash('Campanha inexistente!', 'error_flash');
                $this->redirect(array('action' => 'relatorio'));
            }

            $campanha = $this->Campanha->find('first', array(
                'conditions' => array(
                    'Campanha.id' => $cp
                ),
                'recursive' => 3
            ));

            $this->set(compact("campanha"));
        }
    }

}
