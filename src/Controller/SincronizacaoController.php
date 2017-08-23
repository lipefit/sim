<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Client;

/**
 * Sincronização Controller
 *
 * @property \App\Model\Table\SincronizacoesTable $Sincronizacoes
 *
 * @method \App\Model\Entity\Sincronizacoes[] paginate($object = null, array $settings = [])
 */
class SincronizacaoController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    public function index() {
        $this->loadModel("Faces");
        $this->loadModel("Linkedins");
        $this->loadModel("Twitters");
        $id_cliente = $this->Cookie->read('cliente_id');

        $fbs = $this->Faces->find('all', [
            'conditions' => [
                'Faces.cliente_id' => $id_cliente
            ]
        ]);
        $fb = $fbs->first();

        $lks = $this->Linkedins->find('all', [
            'conditions' => [
                'Linkedins.cliente_id' => $id_cliente
            ]
        ]);
        $lk = $lks->first();

        $twitters = $this->Twitters->find('all', [
            'conditions' => [
                'Twitters.cliente_id' => $id_cliente
            ]
        ]);
        $twitter = $twitters->first();

        // Criando url de login do facebook
        require_once(ROOT . DS . 'vendor' . DS . 'facebook' . DS . 'Facebook.php');
        require_once(ROOT . DS . 'vendor' . DS . 'facebook' . DS . 'autoload.php');

        $fbk = new \Facebook\Facebook([
            'app_id' => '150954231978669',
            'app_secret' => '8ea8f1efeda7273fa92bbdab9668453b',
            'default_graph_version' => 'v2.4'
        ]);

        $helper = $fbk->getRedirectLoginHelper();
        $perm = ['manage_pages, publish_pages, pages_show_list'];

        $redirect_url = 'http://simarketing.provisorio.ws/sincronizacao/loginFacebook';
        $loginUrl = $helper->getLoginUrl($redirect_url, $perm);
        $this->set('loginUrl', $loginUrl);
        $this->set(compact('twitter'));
        $this->set(compact('lk'));
        $this->set(compact('fb'));
    }

    public function loginFacebook() {
        $this->loadModel("Faces");
        $facebook = $this->Faces->newEntity();

        require_once(ROOT . DS . 'vendor' . DS . 'facebook' . DS . 'Facebook.php');
        require_once(ROOT . DS . 'vendor' . DS . 'facebook' . DS . 'autoload.php');

        $fb = new \Facebook\Facebook([
            'app_id' => '150954231978669',
            'app_secret' => '8ea8f1efeda7273fa92bbdab9668453b',
            'default_graph_version' => 'v2.4'
        ]);

        $helper = $fb->getRedirectLoginHelper();
        $erro = "";

        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            $erro = $e->getMessage();
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            $erro = $e->getMessage();
        }

        if (isset($accessToken)) {
            try {
                $response = $fb->get('/me?fields=id,name,accounts', $accessToken);
                $graphObject = $response->getDecodedBody();
                if (@$graphObject['accounts']) {
                    $accounts = $graphObject['accounts'];
                } else {
                    $this->Flash->error(__('Erro ao conectar. Por favor, tente novamente'));
                    $this->redirect('/sincronizacao/');
                }
            } catch (Facebook\Exceptions\FacebookResponseException $e) {
                $erro = $e->getMessage();
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                $erro = $e->getMessage();
            }
        }

        if ($erro != "") {
            $this->Flash->error(__('Erro ao conectar: ' . $erro . '  Por favor, tente novamente'));
            $this->redirect('/sincronizacao/');
        } else {
            $paginas = $accounts['data'];
            $select = "<select name='pagina' class='form-control'>";
            foreach ($paginas as $pagina) {
                $select .= "<option value='" . $pagina['access_token'] . "|sim|" . $pagina['id'] . "|sim|" . $pagina['name'] . "'>" . $pagina['name'] . "</option>";
            }
            $select .= "</select>";
            $this->set(compact("select"));
        }
        $this->set(compact('facebook'));
    }

    public function loginLinkedin() {
        $params = [
            'response_type' => 'code',
            'client_id' => '771oz82ttpmfru',
            'scope' => 'r_basicprofile r_emailaddress w_share rw_company_admin',
            'state' => 'simarketing123456',
            'redirect_uri' => 'http://simarketing.provisorio.ws/sincronizacao/retornoLinkedin',
        ];

        $this->redirect('https://www.linkedin.com/uas/oauth2/authorization?' . http_build_query($params));
    }

    public function loginTwitter() {
        require_once(ROOT . DS . 'vendor' . DS . 'twitteroauth' . DS . 'twitteroauth' . DS . 'twitteroauth.php');
        $connection = new \TwitterOAuth("0fVI82EilhsQcT2lRKBMyzADg", "OqkKQ8ZepOHHRiM77MGjoefSdEJTiTmJ5v5Lv4kE2Sh9HjXbrP");
        $temporary_credentials = $connection->getRequestToken("http://simarketing.provisorio.ws/sincronizacao/retornoTwitter");
        $redirect_url = $connection->getAuthorizeURL($temporary_credentials);
        $this->redirect($redirect_url);
    }

    public function retornoTwitter() {
        $this->loadModel("Twitters");
        $twitter = $this->Twitters->newEntity();
        $this->autoRender = false;
        require_once(ROOT . DS . 'vendor' . DS . 'twitteroauth' . DS . 'twitteroauth' . DS . 'twitteroauth.php');
        $connection = new \TwitterOAuth("0fVI82EilhsQcT2lRKBMyzADg", "OqkKQ8ZepOHHRiM77MGjoefSdEJTiTmJ5v5Lv4kE2Sh9HjXbrP", $this->request->query['oauth_token'], $this->request->query['oauth_verifier']);
        $token_credentials = $connection->getAccessToken($_REQUEST['oauth_verifier']);
        $cliente_id = $this->Cookie->read('cliente_id');
        $this->request->data['Twitters']['cliente_id'] = $cliente_id;
        $this->request->data['Twitters']['oauth_token'] = $token_credentials["oauth_token"];
        $this->request->data['Twitters']['oauth_token_secret'] = $token_credentials["oauth_token_secret"];
        $this->request->data['Twitters']['user_id'] = $token_credentials["user_id"];
        $this->request->data['Twitters']['screen_name'] = $token_credentials["screen_name"];
        $twitter = $this->Twitters->patchEntity($twitter, $this->request->getData());
        if ($this->Twitters->save($twitter)) {
            $this->Flash->success(__('Sincronização feita com sucesso.'));
            $this->redirect('/sincronizacao/');
        } else {
            $this->Flash->error(__('Erro ao conectar. Por favor, tente novamente'));
            $this->redirect('/sincronizacao/');
        }
    }

    public function retornoLinkedin() {
        $this->loadModel("Linkedins");
        $linkedin = $this->Linkedins->newEntity();
        if (!empty($this->request->query['code']) && !empty($this->request->query['state']) && ( $this->request->query['state'] == 'simarketing123456' )) {
            $params = [
                'grant_type' => 'authorization_code',
                'client_id' => '771oz82ttpmfru',
                'client_secret' => 'J45HNwCadeTCrAPo',
                'code' => $this->request->query['code'],
                'redirect_uri' => 'http://simarketing.provisorio.ws/sincronizacao/retornoLinkedin',
            ];

            $HttpSocket = new Client();
            $response = $HttpSocket->get('https://www.linkedin.com/uas/oauth2/accessToken', $params, ['type' => 'json']);

            $this->set(compact("response"));

            $token = json_decode($response->body);

            $user_linkedin = $this->_fetchLinkedin('/v1/people/~:(firstName,lastName,emailAddress)', $token->access_token);
            $pages = $this->_getPagesLinkedin('/v1/companies?oauth2_access_token=' . $token->access_token . ' &format=json&is-company-admin=true');

            if (!empty($pages->_total)) {
                $y = $pages->_total;
                $select = "<select name='pagina' class='form-control'>";
                for ($x = 0; $x < $y; $x++) {
                    $select .= "<option value='" . $token->access_token . "|sim|" . $pages->values[$x]->id . "|sim|" . $pages->values[$x]->name . "'>" . $pages->values[$x]->name . "</option>";
                }
                $select .= "</select>";
            } else {
                $select = "<br />Nenhuma página encontrada";
            }
            $this->set(compact("select"));
        } elseif (!empty($this->request->query['error']) && $this->request->query['error'] == 'access_denied') {
            $error_message = $this->request->query['error_description'];
            $this->Flash->error(__($error_message));
            $this->redirect($this->Auth->logout());
        } else if ($this->request->query['state'] != $this->state) {
            $error_message = "Security Error";
            $this->Flash->error(__($error_message));
            $this->redirect($this->Auth->logout());
        }
        $this->set(compact('linkedin'));
    }

    public function addFacebook() {
        $this->loadModel("Faces");
        $cliente_id = $this->Cookie->read('cliente_id');
        $facebook = $this->Faces->newEntity();
        $this->request->data['Faces']['cliente_id'] = $cliente_id;
        $valueOption = explode("|sim|", $this->request->data['pagina']);
        $this->request->data['Faces']['access_token'] = $valueOption[0];
        $this->request->data['Faces']['page_id'] = $valueOption[1];
        $this->request->data['Faces']['page_name'] = $valueOption[2];
        $facebook = $this->Faces->patchEntity($facebook, $this->request->getData());
        if ($this->Faces->save($facebook)) {
            $this->Flash->success(__('Sincronização feita com sucesso'));
            $this->redirect('/sincronizacao/');
        } else {
            $this->Flash->error(__('Erro ao conectar. Por favor, tente novamente'));
            $this->redirect('/sincronizacao/');
        }
    }

    public function addLinkedin() {
        $this->loadModel("Linkedins");
        $cliente_id = $this->Cookie->read('cliente_id');
        $linkedin = $this->Linkedins->newEntity();
        $this->request->data['Linkedins']['cliente_id'] = $cliente_id;
        $valueOption = explode("|sim|", $this->request->data['pagina']);
        $this->request->data['Linkedins']['access_token'] = $valueOption[0];
        $this->request->data['Linkedins']['page_id'] = $valueOption[1];
        $this->request->data['Linkedins']['page_name'] = $valueOption[2];
        $linkedin = $this->Linkedins->patchEntity($linkedin, $this->request->getData());
        if ($this->Linkedins->save($linkedin)) {
            $this->Flash->success(__('Sincronização feita com sucesso'));
            $this->redirect('/sincronizacao/');
        } else {
            $this->Flash->error(__('Erro ao conectar. Por favor, tente novamente'));
            $this->redirect('/sincronizacao/');
        }
    }

    public function delFacebook($id = null) {
        $this->loadModel("Faces");
        $this->request->allowMethod(['post', 'delete']);
        $face = $this->Faces->get($id);
        if ($this->Faces->delete($face)) {
            $this->Flash->success(__('Desconectado com sucesso'));
        } else {
            $this->Flash->error(__('Facebook não pode ser desconectado'));
        }

        return $this->redirect(['action' => 'index']);
    }
   
    public function delLinkedin($id = null) {
        $this->loadModel("Linkedins");
        $this->request->allowMethod(['post', 'delete']);
        $linkedin = $this->Linkedins->get($id);
        if ($this->Linkedins->delete($linkedin)) {
            $this->Flash->success(__('Desconectado com sucesso'));
        } else {
            $this->Flash->error(__('Facebook não pode ser desconectado'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function delTwitter($id = null) {
        $this->loadModel("Twitters");
        $this->request->allowMethod(['post', 'delete']);
        $twitter = $this->Twitters->get($id);
        if ($this->Twitters->delete($twitter)) {
            $this->Flash->success(__('Desconectado com sucesso'));
        } else {
            $this->Flash->error(__('Facebook não pode ser desconectado'));
        }

        return $this->redirect(['action' => 'index']);
    }

    protected function _fetchLinkedin($resource, $access_token = '') {
        $params = [
            'oauth2_access_token' => $access_token,
            'format' => 'json',
        ];
        $HttpSocket = new Client();
        $response = $HttpSocket->get('https://api.linkedin.com' . $resource, $params);

        return json_decode($response->body);
    }

    protected function _getPagesLinkedin($resource) {

        $HttpSocket = new Client();
        $response = $HttpSocket->get('https://api.linkedin.com' . $resource, [], ['type' => 'json']);

        return json_decode($response->body);
    }

}
