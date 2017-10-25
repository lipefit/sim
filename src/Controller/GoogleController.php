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

        $googles = $this->Google->find('all', array(
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

        $googles = $this->Google->find('all', array(
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

    public function delete($id) {
        $google = $this->Google->get($id);
        if ($this->Google->delete($twitter)) {
            $this->Flash->success(__('Desconectado com sucesso'));
        } else {
            $this->Flash->error(__('Google não pode ser desconectado'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function sincronizarAnalytics() {

        $googles = $this->Google->find('all');

        if ($googles != null) {
            require_once(ROOT . DS . 'vendor' . DS . 'Google' . DS . 'google-api-php-client' . DS . 'src' . DS . 'Google' . DS . 'autoload.php');
            foreach ($googles as $google) {
                try {
                    $client = new \Google_Client();
                    $client->setAuthConfigFile('http://simarketing.provisorio.ws/webroot/client_secrets.json');
                    $client->addScope(\Google_Service_Analytics::ANALYTICS_READONLY);
                    $client->setAccessType("offline"); //habilita o modo Offline da API
                    $client->setApprovalPrompt("force");

                    if ($google['token'] != null) {
                        $client->setAccessToken($google['token']);
                        $analytics = new \Google_Service_Analytics($client);
                        $date = date("Y-m-d H:i:s");
                        $date = date('Y-m-d H:i:s', strtotime($date . '-1 day'));
                        $explodeDate = explode(" ", $date);
                        $data = $explodeDate[0];

                        // Pegar páginas
                        $optParams = array(
                            'dimensions' => 'ga:pageTitle,ga:pagePath',
                            'sort' => '-ga:pageviews',
                        );
                        $results = $analytics->data_ga->get(
                                'ga:' . $google['site'], '2012-01-01', $data, 'ga:pageviews', $optParams);

                        $rows = $results->getRows();

                        $this->getPages($google['cliente_id'], $rows);

                        // Pegar rejeição
                        $optParamsRejeicao = array(
                            'dimensions' => 'ga:pageTitle,ga:pagePath',
                            'sort' => '-ga:bounceRate',
                        );
                        $resultsRejeicao = $analytics->data_ga->get(
                                'ga:' . $google['site'], '2012-01-01', $data, 'ga:bounceRate', $optParamsRejeicao);


                        $rowsRejeicao = $resultsRejeicao->getRows();

                        $this->getRejeicao($google['cliente_id'], $rowsRejeicao);
                    }
                } catch (Exception $exc) {
                    
                }
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    function getPages($cliente, $rows) {
        $this->loadModel("Analytics");
        $this->loadModel("Cliente");
        $this->loadModel("Revisaos");

        $cls = $this->Cliente->find('all', [
            'conditions' => [
                'Cliente.id' => $cliente
            ]
        ]);
        $cl = $cls->first();
       

        $analytics = $this->Analytics->find('all', array(
            'conditions' => array(
                'Analytics.cliente_id' => $cliente
            )
        ));

        foreach ($analytics as $a) {
            $this->Analytics->delete($a);
        }

        foreach (@$rows as $row) {
            $revisaos = $this->Revisaos->find('all', array(
                'conditions' => array(
                    'Revisaos.url' => $cl->blog . $row[1]
                ),
            ));
            
            $contRevisao = $revisaos->count();
            
            if ($contRevisao > 0) {
                $revisao = $revisaos->first();
                $newAnalytics = $this->Analytics->newEntity();
                $this->request->data['Analytics']['pagina'] = $row[1];
                $this->request->data['Analytics']['views'] = $row[2];
                $this->request->data['Analytics']['cliente_id'] = $cliente;
                $this->request->data['Analytics']['titulo'] = $row[0];
                $this->request->data['Analytics']['revisao_id'] = $revisao->id;
                $newAnalytics = $this->Analytics->patchEntity($newAnalytics, $this->request->getData());
                $this->Analytics->save($newAnalytics);
            }
        }

    }

    function getRejeicao($cliente, $rows) {
        $this->loadModel("Analytics");

        foreach (@$rows as $row) {
            $analytics = $this->Analytics->find('all', array(
                'conditions' => array(
                    'Analytics.cliente_id' => $cliente,
                    'Analytics.pagina' => $row[1]
                )
            ));

            $a = $analytics->first();

            if ($a != null) {
                $this->request->data['Analytics']['rejeicao'] = $row[2];
                $a = $this->Analytics->patchEntity($a, $this->request->getData());
                $this->Analytics->save($a);
            }
        }
    }

    public function getBounce($cliente, $rows) {
        $this->loadModel("Analyticssource");

        $sources = $this->Analyticssource->find('all', array(
            'conditions' => array(
                'Analyticssource.cliente_id' => $cliente
            )
        ));

        foreach ($sources as $s) {
            $this->Analyticssource->delete($s);
        }

        foreach (@$rows as $row) {
            $source = "";
            switch ($row[1]) {
                case "(direct)":
                    $source = "Direct";
                    break;

                case "bing":
                    $source = "Organic Search";
                    break;

                case "yahoo":
                    $source = "Organic Search";
                    break;

                case "br.search.yahoo.com":
                    $source = "Organic Search";
                    break;

                case "facebook.com":
                    $source = "Social";
                    break;

                case "google":
                    $source = "Organic Search";
                    break;

                case "google.com.br":
                    $source = "Organic Search";
                    break;

                case "l.facebook.com":
                    $source = "Social";
                    break;

                case "lm.facebook.com":
                    $source = "Social";
                    break;

                case "m.facebook.com":
                    $source = "Social";
                    break;

                default :
                    $source = "Other";
            }

            $newSource = $this->Analyticssource->newEntity();
            $this->request->data['Analyticssource']['pagina'] = $row[0];
            $this->request->data['Analyticssource']['source'] = $source;
            $this->request->data['Analyticssource']['cliente_id'] = $cliente;
            $this->request->data['Analyticssource']['views'] = $row[2];
            $newSource = $this->Analyticssource->patchEntity($newSource, $this->request->getData());
            $this->Analyticssource->save($newSource);
        }
    }

}
