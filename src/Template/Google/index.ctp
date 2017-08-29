<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-google"></i> <?= __('Google') ?></h3>
        </div>
        <div class="col text-right ">
            <div class="btn-group pull-right">
                <a href='javascript:history.back()' class="btn btn-warning btn-round"><span class="text"><?= __('Voltar') ?></span></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-16 col-md-16">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title"><?= __('Google') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($google, ['url' => ['action' => 'add']]) ?>
                    <?php
                    // Carrega a biblioteca PHP CLiente do Google API
                    require_once(ROOT . DS . 'vendor' . DS . 'Google' . DS . 'google-api-php-client' . DS . 'src' . DS . 'Google' . DS . 'autoload.php');

                    // Cria o objeto cliente e configura a autorizacao a partir do client_secrets.json baixado de Developers Console
                    $client = new Google_Client();
                    $client->setAuthConfigFile('http://simarketing.provisorio.ws/webroot/client_secrets.json'); //Presente também em oauth2callback.php
                    $client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);
                    $client->setAccessType("offline"); //habilita o modo Offline da API
                    $client->setApprovalPrompt("force"); //forçar o prompt de aprovação
                    // Se o usuario ja autorizou entao pegue o access token
                    if (@$google['Google']['token'] != null) {
                        $client->setAccessToken($google['Google']['token']);

                        $analytics = new Google_Service_Analytics($client);

                        echo "<div class='row'>";
                        echo "<div class='col-lg-16 col-md-16'>";
                        echo "<div class='row'>";
                        echo "<div class='col-lg-16 col-md-16'>";
                        echo "<label for = 'SincronizacaoPagina'>Escolha um Site entre os sites encontrados na sua conta do Google</label>";
                        echo showSitesList($analytics, @$google['Google']['site']);
                        echo "<input type='hidden' value='" . $_COOKIE['access_token'] . "' name='token'>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    } elseif ($_COOKIE['access_token'] != null) {
                        // Configura o access token no cliente, dando preferencia para informaçao salva no banco de dados
                        // Caso nao exista, utiliza a sessao

                        $client->setAccessToken($_COOKIE['access_token']);

                        // Verifica se existe uma Sessao ativa, caso contrário recria a Sessao
                        if (!isset($_GET['code'])) {
                            $oauth_url = 'http://simarketing.provisorio.ws/google/oauth2callback';
                            if ($client->isAccessTokenExpired()) {
                                echo '<script>window.location = "' . $oauth_url . '";</script>';
                            }
                        } else {
                            $client->authenticate($_GET['code']);
                            setcookie('access_token', $client->getAccessToken());
                            $redirect_uri = 'http://simarketing.provisorio.ws/google/oauth2callback';
                            echo '<script>window.location = "' . $redirect_uri . '";</script>';
                        }

                        $analytics = new Google_Service_Analytics($client);

                        //$json = json_decode($cookieHelper->read('access_token'));

                        echo "<div class='row'>";
                        echo "<div class='col-lg-16 col-md-16'>";
                        echo "<div class='row'>";
                        echo "<div class='col-lg-16 col-md-16'>";
                        echo "<label for = 'SincronizacaoPagina'>Escolha um Site entre os sites encontrados na sua conta do Google</label>";
                        echo showSitesList($analytics, @$google['Google']['site']);
                        echo "<input type='hidden' value='" . $_COOKIE['access_token'] . "' name='token'>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        //                    echo "<br>";
                        //                    getPages($analytics, @$google['Google']['site']);
                    } else {
                        $redirect_uri = 'http://simarketing.provisorio.ws/google/oauth2callback'; //Presente também em oauth2callback.php
                        echo '<script>window.location = "' . $redirect_uri . '";</script>';
                    }
                    ?>
                </div>

                <center><?= $this->Form->button(__('Salvar'), ['class' => 'btn btn-primary']) ?></center>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<?php

function getPages($analytics, $profileId) {

    $optParams = array(
        'dimensions' => 'ga:pageTitle,ga:pagePath',
        'sort' => '-ga:pageviews',
    );

    $results = $analytics->data_ga->get(
            'ga:' . $profileId, '2012-01-01', '2017-12-31', 'ga:pageviews', $optParams);

    $rows = $results->getRows();

    $retorno = "";
    foreach ($rows as $row) {
        $retorno .= "Página: " . $row[1] . " - Número de views = " . $row[2] . "<br/>";
    }

    echo $retorno;
}

// Função para exibir a lista de sites em um perfil
function showSitesList($analytics, $siteEscolhido = null) {
    $accounts = $analytics->management_accounts->listManagementAccounts();
    if (count($accounts->getItems()) > 0) {
        $items = $accounts->getItems();

        $select = "<select name='site' class='form-control'>";
        foreach ($items as $item) {
            $properties = $analytics->management_webproperties->listManagementWebproperties($item->getId());
            if (count($properties->getItems()) > 0) {
                $items2 = $properties->getItems();
                foreach ($items2 as $item2) {
                    $profiles = $analytics->management_profiles->listManagementProfiles($item->getId(), $item2->getId());
                    if (count($profiles->getItems()) > 0) {
                        $items3 = $profiles->getItems();
                        foreach ($items3 as $item3) {
                            if ($siteEscolhido == $item3->getId()) {
                                $select .= "<option value='" . $item3->getId() . "' selected='selected'>" . $item->getName() . "</option>";
                            } else {
                                $select .= "<option value='" . $item3->getId() . "'>" . $item->getName() . "</option>";
                            }
                        }
                    } else {
                        throw new Exception('Não foram encontrados Views (profiles) para este usuário do Google');
                    }
                }
            } else {
                throw new Exception('Não foram encontradas Propriedades para este usuário');
            }
        }
        $select .= "</select>";
        echo $select;
    } else {
        throw new Exception('Não há contas no Analytics para este usuário');
    }
}

// Função para pegar o primeiro Profile ID do usuario
function getFirstprofileId(&$analytics) {
    // Pega a lista de contas gerenciadas pelo usuario
    $accounts = $analytics->management_accounts->listManagementAccounts();

    if (count($accounts->getItems()) > 0) {
        $items = $accounts->getItems();
        $firstAccountId = $items[0]->getId();

        // Pega a lista de propriedades (sites) do usuario
        $properties = $analytics->management_webproperties
                ->listManagementWebproperties($firstAccountId);

        if (count($properties->getItems()) > 0) {
            $items = $properties->getItems();
            $firstPropertyId = $items[0]->getId();

            // Pega a lista de Views (profiles) do usuario
            $profiles = $analytics->management_profiles
                    ->listManagementProfiles($firstAccountId, $firstPropertyId);

            if (count($profiles->getItems()) > 0) {
                $items = $profiles->getItems();

                // Retorna o primeiro View (profile) ID
                return $items[0]->getId();
            } else {
                throw new Exception('Não foram encontrados Views (profiles) para este usuário do Google');
            }
        } else {
            throw new Exception('Não foram encontradas Propriedades para este usuário');
        }
    } else {
        throw new Exception('Não há contas no Analytics para este usuário');
    }
}

function getResults(&$analytics, $profileId) {
    // Chama a Core Reporting API e executa as queries para extrair o número de sessões dos ultimos 7 dias
    return $analytics->data_ga->get(
                    'ga:' . $profileId, '30daysAgo', 'today', 'ga:pageviews'
    );
}

function getResultsPerCountry(&$analytics, $profileId) {
    // Chama a Core Reporting API e executa as queries para extrair o número de sessões dos ultimos 7 dias
    return $analytics->data_ga->get(
                    'ga:' . $profileId, '30daysAgo', 'today', 'ga:pageviews', array(
                'dimensions' => 'ga:country',
                'sort' => '-ga:pageviews',
                'max-results' => 10  //Exemplo aplicando limites
                    )
    );
}

function printResults(&$results) {
    // Imprime os resultados do Core Reporting API
    if (count($results->getRows()) > 0) {
        // Pega o nome do perfil
        //$profileName = $results->getProfileInfo()->getProfileName();
        $profileName = $results->getProfileInfo()->getProfileid();
        //print_r($results);
        // Pega a entrada para a primeira entrada na primeira linha
        $rows = $results->getRows();
        $sessions = $rows[0][0];

        // Imprime os resultados
        print "<p>Perfil do site: <b>$profileName</b></p>";
        print "<p>Total de visitas nos últimos 30 dias: <b>$sessions</b></p>";
    } else {
        print "<p>Não foram encontrados registros</p>";
    }
}

function getPageHits(&$analytics, $profileId) {
    $ids = 'ga:' . $profileId; //O ID para analisar
    $startDate = '30daysAgo'; //Exemplo: '2013-12-25';
    $endDate = 'today'; //Exemplo: '2014-01-08';
    //$metrics = 'ga:sessions'; //Exemplo
    //$metrics = 'ga:pageviews,ga:uniquePageviews';  //Outro exemplo
    $metrics = 'ga:pageviews';
    $dimensions = 'ga:pagePathLevel1';

    $optParams = array(
        'dimensions' => $dimensions,
        'max-results' => '20',
        'filters' => 'ga:medium==organic',
        'sort' => '-ga:pageviews'
    );

    $service = $analytics;

    $results = $service->data_ga->get($ids, $startDate, $endDate, $metrics, $optParams);

    echo "<br>MÉTRICAS DE TESTE (Page Views - Últimos N dias):<br>";
    echo "Filtrado somente resultados orgânicos<br><br>";

    //Executa o loop e exibe o resultado da consulta
    $rows = $results->getRows();
    foreach ($rows as $row) {
        echo "Página: " . $row[0] . " - Visualizações: " . $row[1] . "<br>";
    }

    //var_dump($rows); //Debug
    //return $results; //Sem necessidade, ja exibiu direto na funcao
}
?>