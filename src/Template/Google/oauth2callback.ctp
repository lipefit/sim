<?php

// Carrega a biblioteca PHP CLiente do Google API
require_once(ROOT . DS . 'vendor' . DS . 'Google' . DS . 'google-api-php-client' . DS . 'src' . DS . 'Google' . DS . 'autoload.php');

// Cria o objeto cliente e configura a autorizacao a partir do client_secrets.json baixado de Developers Console
$client = new Google_Client();
$client->setAuthConfigFile('http://simarketing.provisorio.ws/webroot/client_secrets.json'); //Presente também em index.php
$client->setRedirectUri('http://simarketing.provisorio.ws/google/oauth2callback'); //Presente também em index.php
$client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);
$client->setAccessType("offline"); //habilita o modo Offline da API
$client->setApprovalPrompt("force"); //forçar o prompt de aprovação
// Manipula o flow de autorização do servidor
if (!isset($_GET['code'])) {
    $auth_url = $client->createAuthUrl();
    echo '<script>window.location = "' . $auth_url . '";</script>';
    //header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
    $client->authenticate($_GET['code']);
//	$_SESSION['access_token'] = $client->getAccessToken();
    setcookie('access_token', $client->getAccessToken());
    $redirect_uri = 'http://simarketing.provisorio.ws/google/index';
    echo '<script>window.location = "' . $redirect_uri . '";</script>';
    //header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}
