<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Aprovações Controller
 *
 * @property \App\Model\Table\AprovacoesTable $Calendario
 *
 * @method \App\Model\Entity\Aprovacao[] paginate($object = null, array $settings = [])
 */
class AprovacoesController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $this->loadModel("Profiles");
        $this->loadModel("Cliente");
        $this->loadModel("Aprovacaousers");
        $idCliente = $this->Cookie->read('cliente_id');

        $aprovacoes = $this->Aprovacoes->find('all', [
            'conditions' => [
                'Aprovacoes.cliente_id' => $idCliente
            ]
        ]);
        $aprovacao = $aprovacoes->first();

        if ($aprovacao == null) {
            $aprovacao = $this->Aprovacoes->newEntity();
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['Aprovacoes']['cliente_id'] = $idCliente;
            $aprovacao = $this->Aprovacoes->patchEntity($aprovacao, $this->request->getData());
            if ($query = $this->Aprovacoes->save($aprovacao)) {
                $aprovacaoId = $query->id;
                $this->delete($idCliente);

                $pautas_cs = $this->request->data['pauta_cs'];
                $pautas_criar = $this->request->data['pauta_criar'];
                $pautas_revisar = $this->request->data['pauta_revisar'];
                $pautas_designer = $this->request->data['pauta_designer'];
                $pautas_cliente = $this->request->data['pauta_cliente'];
                
                $conteudos_criar = $this->request->data['conteudo_criar'];
                $conteudos_revisar = $this->request->data['conteudo_revisar'];
                $conteudos_cs = $this->request->data['conteudo_cs'];
                $conteudos_designer = $this->request->data['conteudo_designer'];
                $conteudos_cliente = $this->request->data['conteudo_cliente'];
                
                $sociais_criar = $this->request->data['social_criar'];
                $sociais_revisar = $this->request->data['social_revisar'];
                $sociais_cs = $this->request->data['social_cs'];
                $sociais_designer = $this->request->data['social_designer'];
                $sociais_cliente = $this->request->data['social_cliente'];
                
                $masters = $this->request->data['master'];
                
                if ($masters) {
                    foreach (@$masters as $master) {
                        if ($master != '') {
                            $aprovacaouser = $this->Aprovacaousers->newEntity();
                            $aprovacaouser->hierarquia_id = 1;
                            $aprovacaouser->profile_id = $master;
                            $aprovacaouser->aprovacao_id = $aprovacaoId;
                            $aprovacaouser->tipo = 'master';
                            $this->Aprovacaousers->save($aprovacaouser);
                        }
                    }
                }

                if ($pautas_criar) {
                    foreach (@$pautas_criar as $pauta_criar) {
                        if ($pauta_criar != '') {
                            $aprovacaouser = $this->Aprovacaousers->newEntity();
                            $aprovacaouser->hierarquia_id = 1;
                            $aprovacaouser->profile_id = $pauta_criar;
                            $aprovacaouser->aprovacao_id = $aprovacaoId;
                            $aprovacaouser->tipo = 'pauta';
                            $this->Aprovacaousers->save($aprovacaouser);
                        }
                    }
                }

                if ($pautas_revisar) {
                    foreach (@$pautas_revisar as $pauta_revisar) {
                        if ($pauta_revisar != '') {
                            $aprovacaouser = $this->Aprovacaousers->newEntity();
                            $aprovacaouser->hierarquia_id = 3;
                            $aprovacaouser->profile_id = $pauta_revisar;
                            $aprovacaouser->aprovacao_id = $aprovacaoId;
                            $aprovacaouser->tipo = 'pauta';
                            $this->Aprovacaousers->save($aprovacaouser);
                        }
                    }
                }

                if ($pautas_cs) {
                    foreach (@$pautas_cs as $pauta_cs) {
                        if ($pauta_cs != '') {
                            $aprovacaouser = $this->Aprovacaousers->newEntity();
                            $aprovacaouser->hierarquia_id = 4;
                            $aprovacaouser->profile_id = $pauta_cs;
                            $aprovacaouser->aprovacao_id = $aprovacaoId;
                            $aprovacaouser->tipo = 'pauta';
                            $this->Aprovacaousers->save($aprovacaouser);
                        }
                    }
                }

                if ($pautas_designer) {
                    foreach (@$pautas_designer as $pauta_designer) {
                        if ($pauta_designer != '') {
                            $aprovacaouser = $this->Aprovacaousers->newEntity();
                            $aprovacaouser->hierarquia_id = 2;
                            $aprovacaouser->profile_id = $pauta_designer;
                            $aprovacaouser->aprovacao_id = $aprovacaoId;
                            $aprovacaouser->tipo = 'pauta';
                            $this->Aprovacaousers->save($aprovacaouser);
                        }
                    }
                }
                
                if ($pautas_cliente) {
                    foreach (@$pautas_cliente as $pauta_cliente) {
                        if ($pauta_cliente != '') {
                            $aprovacaouser = $this->Aprovacaousers->newEntity();
                            $aprovacaouser->hierarquia_id = 5;
                            $aprovacaouser->profile_id = $pauta_cliente;
                            $aprovacaouser->aprovacao_id = $aprovacaoId;
                            $aprovacaouser->tipo = 'pauta';
                            $this->Aprovacaousers->save($aprovacaouser);
                        }
                    }
                }

                if ($conteudos_criar) {
                    foreach (@$conteudos_criar as $conteudo_criar) {
                        if ($conteudo_criar != '') {
                            $aprovacaouser = $this->Aprovacaousers->newEntity();
                            $aprovacaouser->hierarquia_id = 1;
                            $aprovacaouser->profile_id = $conteudo_criar;
                            $aprovacaouser->aprovacao_id = $aprovacaoId;
                            $aprovacaouser->tipo = 'conteudo';
                            $this->Aprovacaousers->save($aprovacaouser);
                        }
                    }
                }

                if ($conteudos_revisar) {
                    foreach (@$conteudos_revisar as $conteudo_revisar) {
                        if ($conteudo_revisar != '') {
                            $aprovacaouser = $this->Aprovacaousers->newEntity();
                            $aprovacaouser->hierarquia_id = 3;
                            $aprovacaouser->profile_id = $conteudo_revisar;
                            $aprovacaouser->aprovacao_id = $aprovacaoId;
                            $aprovacaouser->tipo = 'conteudo';
                            $this->Aprovacaousers->save($aprovacaouser);
                        }
                    }
                }

                if ($conteudos_designer) {
                    foreach (@$conteudos_designer as $conteudo_designer) {
                        if ($conteudo_designer != '') {
                            $aprovacaouser = $this->Aprovacaousers->newEntity();
                            $aprovacaouser->hierarquia_id = 2;
                            $aprovacaouser->profile_id = $conteudo_designer;
                            $aprovacaouser->aprovacao_id = $aprovacaoId;
                            $aprovacaouser->tipo = 'conteudo';
                            $this->Aprovacaousers->save($aprovacaouser);
                        }
                    }
                }

                if ($conteudos_cs) {
                    foreach (@$conteudos_cs as $conteudo_cs) {
                        if ($conteudo_cs != '') {
                            $aprovacaouser = $this->Aprovacaousers->newEntity();
                            $aprovacaouser->hierarquia_id = 4;
                            $aprovacaouser->profile_id = $conteudo_cs;
                            $aprovacaouser->aprovacao_id = $aprovacaoId;
                            $aprovacaouser->tipo = 'conteudo';
                            $this->Aprovacaousers->save($aprovacaouser);
                        }
                    }
                }

                if ($conteudos_cliente) {
                    foreach (@$conteudos_cliente as $conteudo_cliente) {
                        if ($conteudo_cliente != '') {
                            $aprovacaouser = $this->Aprovacaousers->newEntity();
                            $aprovacaouser->hierarquia_id = 5;
                            $aprovacaouser->profile_id = $conteudo_cliente;
                            $aprovacaouser->aprovacao_id = $aprovacaoId;
                            $aprovacaouser->tipo = 'conteudo';
                            $this->Aprovacaousers->save($aprovacaouser);
                        }
                    }
                }

                if ($sociais_criar) {
                    foreach (@$sociais_criar as $social_criar) {
                        if ($social_criar != '') {
                            $aprovacaouser = $this->Aprovacaousers->newEntity();
                            $aprovacaouser->hierarquia_id = 1;
                            $aprovacaouser->profile_id = $social_criar;
                            $aprovacaouser->aprovacao_id = $aprovacaoId;
                            $aprovacaouser->tipo = 'social';
                            $this->Aprovacaousers->save($aprovacaouser);
                        }
                    }
                }

                if ($sociais_revisar) {
                    foreach (@$sociais_revisar as $social_revisar) {
                        if ($social_revisar != '') {
                            $aprovacaouser = $this->Aprovacaousers->newEntity();
                            $aprovacaouser->hierarquia_id = 3;
                            $aprovacaouser->profile_id = $social_revisar;
                            $aprovacaouser->aprovacao_id = $aprovacaoId;
                            $aprovacaouser->tipo = 'social';
                            $this->Aprovacaousers->save($aprovacaouser);
                        }
                    }
                }

                if ($sociais_designer) {
                    foreach (@$sociais_designer as $social_designer) {
                        if ($social_designer != '') {
                            $aprovacaouser = $this->Aprovacaousers->newEntity();
                            $aprovacaouser->hierarquia_id = 2;
                            $aprovacaouser->profile_id = $social_designer;
                            $aprovacaouser->aprovacao_id = $aprovacaoId;
                            $aprovacaouser->tipo = 'social';
                            $this->Aprovacaousers->save($aprovacaouser);
                        }
                    }
                }

                if ($sociais_cs) {
                    foreach (@$sociais_cs as $social_cs) {
                        if ($social_cs != '') {
                            $aprovacaouser = $this->Aprovacaousers->newEntity();
                            $aprovacaouser->hierarquia_id = 4;
                            $aprovacaouser->profile_id = $social_cs;
                            $aprovacaouser->aprovacao_id = $aprovacaoId;
                            $aprovacaouser->tipo = 'social';
                            $this->Aprovacaousers->save($aprovacaouser);
                        }
                    }
                }

                if ($sociais_cliente) {
                    foreach (@$sociais_cliente as $social_cliente) {
                        if ($social_cliente != '') {
                            $aprovacaouser = $this->Aprovacaousers->newEntity();
                            $aprovacaouser->hierarquia_id = 5;
                            $aprovacaouser->profile_id = $social_cliente;
                            $aprovacaouser->aprovacao_id = $aprovacaoId;
                            $aprovacaouser->tipo = 'social';
                            $this->Aprovacaousers->save($aprovacaouser);
                        }
                    }
                }

                $this->Flash->success('Hierarquia de aprovação salva com sucesso!');
                $this->redirect(array(
                    'controller' => 'aprovacoes',
                    'action' => 'index'
                ));
            }
        }
        
        $clientes = $this->Cliente->find('all', array(
            'conditions' => array(
                'Cliente.id' => $idCliente,
            )
        ));
        
        $cliente = $clientes->first();
        
        $usersMaster = $this->Profiles->find('list', array(
            'contain' => ['Users'],
            'conditions' => array(
                'OR' => array(
                    array('Users.cliente_id' => $idCliente),
                    array('Users.cliente_id' => $cliente['cliente_id'])
                )
            )          
        ));
        $this->set(compact('usersMaster'));
        
        $usersCriar = $this->Profiles->find('list', array(
            'contain' => ['Users'],
            'conditions' => array(
                'OR' => array(
                    array('Users.cliente_id' => $idCliente),
                    array('Users.cliente_id' => $cliente['cliente_id'])
                )
            ),
            'joins' => array(
                array(
                    'type' => 'inner',
                    'table' => 'user_has_hierarquias',
                    'alias' => 'UserHierarquia',
                    'conditions' => array(
                        'OR' => array(
                            array('UserHierarquia.hierarquia_id' => 1)
                        ),
                        ('UserHierarquia.user_id = Users.id')
                    )
                )
            )
            
        ));
        $this->set(compact('usersCriar'));

        $usersRevisar = $this->Profiles->find('list', array(
            'contain' => ['Users'],
            'conditions' => array(
                'OR' => array(
                    array('Users.cliente_id' => $idCliente),
                    array('Users.cliente_id' => $cliente['cliente_id'])
                )
            ),
            'joins' => array(
                array(
                    'type' => 'inner',
                    'table' => 'user_has_hierarquias',
                    'alias' => 'UserHierarquia',
                    'conditions' => array(
                        'UserHierarquia.hierarquia_id' => 3,
                        ('UserHierarquia.user_id = Users.id')
                    )
                )
            )
        ));
        $this->set(compact('usersRevisar'));
        
        $usersCs = $this->Profiles->find('list', array(
            'contain' => ['Users'],
            'conditions' => array(
                'OR' => array(
                    array('Users.cliente_id' => $idCliente),
                    array('Users.cliente_id' => $cliente['cliente_id'])
                )
            ),
            'joins' => array(
                array(
                    'type' => 'inner',
                    'table' => 'user_has_hierarquias',
                    'alias' => 'UserHierarquia',
                    'conditions' => array(
                        'UserHierarquia.hierarquia_id' => 4,
                        ('UserHierarquia.user_id = Users.id')
                    )
                )
            )
        ));
        $this->set(compact('usersCs'));

        $usersDesigner = $this->Profiles->find('list', array(
            'contain' => ['Users'],
            'conditions' => array(
                'OR' => array(
                    array('Users.cliente_id' => $idCliente),
                    array('Users.cliente_id' => $cliente['cliente_id'])
                )
            ),
            'joins' => array(
                array(
                    'type' => 'inner',
                    'table' => 'user_has_hierarquias',
                    'alias' => 'UserHierarquia',
                    'conditions' => array(
                        'UserHierarquia.hierarquia_id' => 2,
                        ('UserHierarquia.user_id = Users.id')
                    )
                )
            )
        ));
        $this->set(compact('usersDesigner'));
        
        $usersCliente = $this->Profiles->find('list', array(
            'contain' => ['Users'],
            'conditions' => array(
                'OR' => array(
                    array('Users.cliente_id' => $idCliente),
                    array('Users.cliente_id' => $cliente['cliente_id'])
                )
            ),
            'joins' => array(
                array(
                    'type' => 'inner',
                    'table' => 'user_has_hierarquias',
                    'alias' => 'UserHierarquia',
                    'conditions' => array(
                        'UserHierarquia.hierarquia_id' => 5,
                        ('UserHierarquia.user_id = Users.id')
                    )
                )
            )
        ));
        $this->set(compact('usersCliente'));
        
        // Preencher formulário
        
        $master = $this->Aprovacaousers->find('all', array(
            'contain' => ['Aprovacoes'],
            'conditions' => array(
                'Aprovacoes.cliente_id' => $idCliente,
                'Aprovacaousers.hierarquia_id' => 1,
                'Aprovacaousers.tipo' => 'master'
            )
        ));
        
        foreach ($master as $m){
            $masters[] = $m['profile_id'];
        }
        
        $this->set(compact("pautas_criar"));
        
        $pauta_criar = $this->Aprovacaousers->find('all', array(
            'contain' => ['Aprovacoes'],
            'conditions' => array(
                'Aprovacoes.cliente_id' => $idCliente,
                'Aprovacaousers.hierarquia_id' => 1,
                'Aprovacaousers.tipo' => 'pauta'
            )
        ));
        
        foreach ($pauta_criar as $pc){
            $pautas_criar[] = $pc['profile_id'];
        }
        
        $this->set(compact("pautas_criar"));
        
        $pauta_revisar = $this->Aprovacaousers->find('all', array(
            'contain' => ['Aprovacoes'],
            'conditions' => array(
                'Aprovacoes.cliente_id' => $idCliente,
                'Aprovacaousers.hierarquia_id' => 3,
                'Aprovacaousers.tipo' => 'pauta'
            )
        ));
        
        foreach ($pauta_revisar as $pr){
            $pautas_revisar[] = $pr['profile_id'];
        }
        
        $this->set(compact("pautas_revisar"));
        
        $pauta_designer = $this->Aprovacaousers->find('all', array(
            'contain' => ['Aprovacoes'],
            'conditions' => array(
                'Aprovacoes.cliente_id' => $idCliente,
                'Aprovacaousers.hierarquia_id' => 2,
                'Aprovacaousers.tipo' => 'pauta'
            )
        ));
        
        foreach ($pauta_designer as $pd){
            $pautas_designer[] = $pd['profile_id'];
        }
        
        $this->set(compact("pautas_designer"));
        
        $pauta_aprovar = $this->Aprovacaousers->find('all', array(
            'contain' => ['Aprovacoes'],
            'conditions' => array(
                'Aprovacoes.cliente_id' => $idCliente,
                'Aprovacaousers.hierarquia_id' => 4,
                'Aprovacaousers.tipo' => 'pauta'
            )
        ));
        
        foreach ($pauta_aprovar as $pa){
            $pautas_cs[] = $pa['profile_id'];
        }
        
        $this->set(compact("pautas_cs"));
        
        $pauta_cliente = $this->Aprovacaousers->find('all', array(
            'contain' => ['Aprovacoes'],
            'conditions' => array(
                'Aprovacoes.cliente_id' => $idCliente,
                'Aprovacaousers.hierarquia_id' => 5,
                'Aprovacaousers.tipo' => 'pauta'
            )
        ));
        
        foreach ($pauta_cliente as $pc){
            $pautas_cliente[] = $pc['profile_id'];
        }
        
        $this->set(compact("pautas_cliente"));
        
        $conteudo_criar = $this->Aprovacaousers->find('all', array(
            'contain' => ['Aprovacoes'],
            'conditions' => array(
                'Aprovacoes.cliente_id' => $idCliente,
                'Aprovacaousers.hierarquia_id' => 1,
                'Aprovacaousers.tipo' => 'conteudo'
            )
        ));
        
        foreach ($conteudo_criar as $cc){
            $conteudos_criar[] = $cc['profile_id'];
        }
        
        $this->set(compact("conteudos_criar"));
        
        $conteudo_revisar = $this->Aprovacaousers->find('all', array(
            'contain' => ['Aprovacoes'],
            'conditions' => array(
                'Aprovacoes.cliente_id' => $idCliente,
                'Aprovacaousers.hierarquia_id' => 3,
                'Aprovacaousers.tipo' => 'conteudo'
            )
        ));
        
        foreach ($conteudo_revisar as $cr){
            $conteudos_revisar[] = $cr['profile_id'];
        }
        
        $this->set(compact("conteudos_revisar"));
        
        $conteudo_designer = $this->Aprovacaousers->find('all', array(
            'contain' => ['Aprovacoes'],
            'conditions' => array(
                'Aprovacoes.cliente_id' => $idCliente,
                'Aprovacaousers.hierarquia_id' => 2,
                'Aprovacaousers.tipo' => 'conteudo'
            )
        ));
        
        foreach ($conteudo_designer as $cd){
            $conteudos_designer[] = $cd['profile_id'];
        }
        
        $this->set(compact("conteudos_designer"));
        
        $conteudo_aprovar = $this->Aprovacaousers->find('all', array(
            'contain' => ['Aprovacoes'],
            'conditions' => array(
                'Aprovacoes.cliente_id' => $idCliente,
                'Aprovacaousers.hierarquia_id' => 4,
                'Aprovacaousers.tipo' => 'conteudo'
            )
        ));
        
        foreach ($conteudo_aprovar as $ca){
            $conteudos_cs[] = $ca['profile_id'];
        }
        
        $this->set(compact("conteudos_cs"));
        
        $conteudo_cliente = $this->Aprovacaousers->find('all', array(
            'contain' => ['Aprovacoes'],
            'conditions' => array(
                'Aprovacoes.cliente_id' => $idCliente,
                'Aprovacaousers.hierarquia_id' => 5,
                'Aprovacaousers.tipo' => 'conteudo'
            )
        ));
        
        foreach ($conteudo_cliente as $cc){
            $conteudos_cliente[] = $cc['profile_id'];
        }
        
        $this->set(compact("conteudos_cliente"));
        
        $social_criar = $this->Aprovacaousers->find('all', array(
            'contain' => ['Aprovacoes'],
            'conditions' => array(
                'Aprovacoes.cliente_id' => $idCliente,
                'Aprovacaousers.hierarquia_id' => 1,
                'Aprovacaousers.tipo' => 'social'
            )
        ));
        
        foreach ($social_criar as $sc){
            $sociais_criar[] = $sc['profile_id'];
        }
        
        $this->set(compact("sociais_criar"));
        
        $social_revisar = $this->Aprovacaousers->find('all', array(
            'contain' => ['Aprovacoes'],
            'conditions' => array(
                'Aprovacoes.cliente_id' => $idCliente,
                'Aprovacaousers.hierarquia_id' => 3,
                'Aprovacaousers.tipo' => 'social'
            )
        ));
        
        foreach ($social_revisar as $sr){
            $sociais_revisar[] = $sr['profile_id'];
        }
        
        $this->set(compact("sociais_revisar"));
        
        $social_designer = $this->Aprovacaousers->find('all', array(
            'contain' => ['Aprovacoes'],
            'conditions' => array(
                'Aprovacoes.cliente_id' => $idCliente,
                'Aprovacaousers.hierarquia_id' => 2,
                'Aprovacaousers.tipo' => 'social'
            )
        ));
        
        foreach ($social_designer as $sd){
            $sociais_designer[] = $sd['profile_id'];
        }
        
        $this->set(compact("sociais_designer"));
        
        $social_aprovar = $this->Aprovacaousers->find('all', array(
            'contain' => ['Aprovacoes'],
            'conditions' => array(
                'Aprovacoes.cliente_id' => $idCliente,
                'Aprovacaousers.hierarquia_id' => 4,
                'Aprovacaousers.tipo' => 'social'
            )
        ));
        
        foreach ($social_aprovar as $sa){
            $sociais_cs[] = $sa['profile_id'];
        }
        
        $this->set(compact("sociais_cs"));
        
        $social_cliente = $this->Aprovacaousers->find('all', array(
            'contain' => ['Aprovacoes'],
            'conditions' => array(
                'Aprovacoes.cliente_id' => $idCliente,
                'Aprovacaousers.hierarquia_id' => 5,
                'Aprovacaousers.tipo' => 'social'
            )
        ));
        
        foreach ($social_cliente as $sc){
            $sociais_cliente[] = $sc['profile_id'];
        }
        
        $this->set(compact("sociais_cliente"));
        
        $this->set(compact('aprovacao'));
        $this->set('_serialize', ['aprovacao']);
    }
    
    public function delete($cliente) {
        $this->loadModel("Aprovacaousers");
        $aprovacoes = $this->Aprovacaousers->find('all', array(
            'contain' => ['Aprovacoes'],
            'conditions' => array(
                'Aprovacoes.cliente_id' => $cliente
            )
        ));

        foreach ($aprovacoes as $aprovacao) {
            $this->Aprovacaousers->delete($aprovacao);
        }
        
        return true;
    }

}
