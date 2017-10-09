<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Database\Type;

Type::build('date')
        ->useLocaleParser()
        ->setLocaleFormat('dd/MM/yyyy');
Type::build('datetime')
        ->useLocaleParser()
        ->setLocaleFormat('dd/MM/yyyy HH:mm:ss');
Type::build('timestamp')
        ->useLocaleParser()
        ->setLocaleFormat('dd/MM/yyyy HH:mm:ss');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = [
        'Acl' => [
            'className' => 'Acl.Acl'
        ]
    ];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();

        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'passwordHasher' => [
                        'className' => 'Fallback',
                        'hashers' => [
                            'Default',
                            'Weak' => ['hashType' => 'sha1']
                        ]
                    ]
                ]
            ],
            'authorize' => [
                'Acl.Actions' => ['actionPath' => 'controllers/']
            ],
            'loginAction' => [
                'plugin' => false,
                'controller' => 'Users',
                'action' => 'login'
            ],
            'loginRedirect' => [
                'plugin' => false,
                'controller' => 'Dashboard',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'plugin' => false,
                'controller' => 'Users',
                'action' => 'login'
            ],
            'unauthorizedRedirect' => [
                'controller' => 'Dashboard',
                'action' => 'index',
                'prefix' => false
            ],
            'authError' => 'Você não está autorizado a acessar esse local.',
            'flash' => [
                'element' => 'error'
            ]
        ]);

        $this->Auth->allow("ativar", "salvarSenha", "salvar-senha", "sincronizar-analytics", "sincronizarAnalytics", "getBounce", "get-bounce");
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event) {
        $this->loadComponent('Cookie');
        $this->loadComponent('Auth');
        $this->loadModel('Cliente');
        $this->loadModel('Profiles');
        $user = $this->Auth->User();
        $this->set('authUser', $user);
        if (@$user) {
            $_clientes = $this->Cliente->find('all', [
                'conditions' => [
                    'Cliente.status' => 1,
                    'OR' => array(
                        array('Cliente.cliente_id' => $user['cliente_id']),
                        array('Cliente.id' => $user['cliente_id'])
                    )
                ]
            ]);

            $this->set(compact('_clientes'));

            $this->set("masterClient", $user['cliente_id']);

            $profiles = $this->Profiles->find('all', [
                'conditions' => [
                    'Profiles.user_id' => $user['id']
                ]
            ]);
            $profile = $profiles->first();

            $this->set('profile', $profile);
        }

//        if (!array_key_exists('_serialize', $this->viewVars) &&
//                in_array($this->response->type(), ['application/json', 'application/xml'])
//        ) {
//            $this->set('_serialize', true);
//        }

        if ($user['group_id'] == 1 || $user['group_id'] == 3 || $user['group_id'] == 6 || $user['group_id'] == 4 || $user['group_id'] == 7) {
            if (@$this->Cookie->read('cliente_id')) {
                $this->set('cliente_id_cookie', $this->Cookie->read('cliente_id'));
            } else {
                /*
                 * Se não existe sessao antiga entao cria uma nova
                 */
                $this->Cookie->write('cliente_id', $user['cliente_id']);
                $this->set('cliente_id_cookie', $user['cliente_id']);
            }
        } else {
            $this->Cookie->write('cliente_id', $user['cliente_id']);
            $this->set('cliente_id_cookie', $user['cliente_id']);
        }
    }

}
