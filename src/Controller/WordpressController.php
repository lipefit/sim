<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Wordpress Controller
 *
 * @property \App\Model\Table\WordpressTable $Wordpress
 *
 * @method \App\Model\Entity\Wordpress[] paginate($object = null, array $settings = [])
 */
class WordpressController extends AppController {

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

        require_once(ROOT . DS . 'vendor' . DS . 'WordpressClient.php');
        require_once(ROOT . DS . 'vendor' . DS . 'Exception' . DS . 'XmlrpcException.php');
        require_once(ROOT . DS . 'vendor' . DS . 'Exception' . DS . 'NetworkException.php');

        $wordpress = $this->Wordpress->find('all', [
            'conditions' => [
                'Wordpress.cliente_id' => $idCliente
            ]
        ]);
        $wp = $wordpress->first();

        if ($wp == null) {
            $wp = $this->Wordpress->newEntity();
        }

        if ($this->request->is('post')) {

            $remoteurl = $this->request->data['endereco'];
            $remoteuser = $this->request->data['login'];
            $remotepass = $this->request->data['senha'];

            if (substr($remoteurl, -1) != "/") {
                $remoteurl = $remoteurl . "/";
            }

            $remoteurl = $remoteurl . 'xmlrpc.php';
            $remoteurl = filter_var($remoteurl, FILTER_SANITIZE_URL);

            try {
                $endpoint = $remoteurl;

                $wpClient = new \HieuLe\WordpressXmlrpcClient\WordpressClient();

                $wpClient->setCredentials($endpoint, $remoteuser, $remotepass);
                
//                try {
//                    $result = $wpClient->getUsers();
//                } catch (\HieuLe\WordpressXmlrpcClient\Exception\XmlrpcException $ex) {
//                    $this->Flash->error(__($ex->getMessage()));
//                    return $this->redirect(['action' => 'index']);
//                }                

                $this->request->data['Wordpress']['cliente_id'] = $this->Cookie->read('cliente_id');

                $wp = $this->Wordpress->patchEntity($wp, $this->request->getData());
                if ($this->Wordpress->save($wp)) {
                    $this->Flash->success(__('Conexão feita com sucesso.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Erro na conexão. Por favor, tente novamente'));
                
            } catch (Exception $e) {
                if (strpos($e->getMessage(), '404') !== false) {
                    $mensagemErro = 'ERRO: Não foi possivel conectar-se à URL do WordPress remoto!';
                } else {
                    $mensagemErro = 'ERRO: ' . $e->getMessage();
                }
                $this->Flash->error(__($mensagemErro));
            }
        }

        $this->set(compact('wp'));
        $this->set('_serialize', ['wp']);
    }
    
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $wp = $this->Wordpress->get($id);
        if ($this->Wordpress->delete($wp)) {
            $this->Flash->success('Desconectado com sucesso');
            $this->redirect(array('action' => 'index'));
        }else{
            $this->Flash->error('Wordpress não pode ser desconectado', 'error_flash');
            $this->redirect(array('action' => 'index'));
        }
    }

}
