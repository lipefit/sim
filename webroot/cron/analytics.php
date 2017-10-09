<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

echo "Começou processo para pegar informações do analytics";

$conecta = mysql_connect("bd_simarketing.mysql.dbaas.com.br", "bd_simarketing", "capifitsos9856") or print (mysql_error());
mysql_select_db("simarketing", $conecta) or print(mysql_error());

$sql = mysql_query("SELECT * FROM google");

if (mysql_num_rows($sql) > 0) {
    include("app/app/Vendor/Google/google-api-php-client/src/Google/autoload.php");
    for ($x = 0; $x < mysql_num_rows($sql); $x++) {
        $google = mysql_fetch_object($sql);
        $client = new Google_Client();
        $client->setAuthConfigFile('http://www.simarketing.com.br/client_secrets.json'); //Presente também em oauth2callback.php
        $client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);
        $client->setAccessType("offline"); //habilita o modo Offline da API
        $client->setApprovalPrompt("force");

        if ($google->token != null) {
            $client->setAccessToken($google->token);
            $analytics = new Google_Service_Analytics($client);
//            getPages($analytics, $google->site, $google->cliente_id);
//            getRejeicao($analytics, $google->site, $google->cliente_id);
            getBounce($analytics, $google->site, $google->cliente_id);
        }
    }
}

mysql_close($conecta);

function getPages($analytics, $profileId, $cliente) {
    $date = date("Y-m-d H:i:s");
    $date = date('Y-m-d H:i:s', strtotime($date . '-1 day'));
    $explodeDate = explode(" ", $date);
    $data = $explodeDate[0];
    $optParams = array(
        'dimensions' => 'ga:pageTitle,ga:pagePath',
        'sort' => '-ga:pageviews',
    );

    $results = $analytics->data_ga->get(
            'ga:' . $profileId, '2012-01-01', $data, 'ga:pageviews', $optParams);

    $resultsDaily = $analytics->data_ga->get(
            'ga:' . $profileId, $data, date("Y-m-d"), 'ga:pageviews', $optParams);

    $rowsDaily = $resultsDaily->getRows();
    $rows = $results->getRows();

    mysql_query("DELETE FROM analytics WHERE cliente_id = '" . $cliente . "'");
    mysql_query("DELETE FROM analyticsdaily WHERE cliente_id = '" . $cliente . "' AND data = '" . $data . "'");
    foreach (@$rows as $row) {
        mysql_query("INSERT INTO analytics (pagina, views, cliente_id, titulo) VALUES ('" . $row[1] . "','" . $row[2] . "','" . $cliente . "','" . $row[0] . "')");
    }

    foreach (@$rowsDaily as $rowDaily) {
        mysql_query("INSERT INTO analyticsdaily (pagina, views, cliente_id, data, titulo) VALUES ('" . $rowDaily[1] . "','" . $rowDaily[2] . "','" . $cliente . "','" . $data . "','" . $rowDaily[0] . "')");
    }

    echo "Terminou processo de pegar informações do analytics para o cliente " . $cliente . "<br />";
}

function getBounce($analytics, $profileId, $cliente) {
    $date = date("Y-m-d H:i:s");
    $date = date('Y-m-d H:i:s', strtotime($date . '-1 day'));
    $explodeDate = explode(" ", $date);
    $data = $explodeDate[0];
    $optParams = array(
        'dimensions' => 'ga:pagePath,ga:source',
        'sort' => '-ga:pagePath',
    );

    $results = $analytics->data_ga->get(
            'ga:' . $profileId, '2012-01-01', $data, 'ga:pageviews', $optParams);

    $rows = $results->getRows();

    mysql_query("DELETE FROM analyticssource WHERE cliente_id = '" . $cliente . "'");
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

        mysql_query("INSERT INTO analyticssource (pagina, source, cliente_id, views) VALUES ('" . $row[0] . "','" . $source . "','" . $cliente . "','" . $row[2] . "')");
    }
}

function getRejeicao($analytics, $profileId, $cliente) {

    $date = date("Y-m-d H:i:s");
    $date = date('Y-m-d H:i:s', strtotime($date . '-1 day'));
    $explodeDate = explode(" ", $date);
    $data = $explodeDate[0];

    $optParams = array(
        'dimensions' => 'ga:pageTitle,ga:pagePath',
        'sort' => '-ga:bounceRate',
    );

    $results = $analytics->data_ga->get(
            'ga:' . $profileId, '2012-01-01', $data, 'ga:bounceRate', $optParams);


    $resultsDaily = $analytics->data_ga->get(
            'ga:' . $profileId, $data, date("Y-m-d"), 'ga:bounceRate', $optParams);

    $rows = $results->getRows();
    $rowsDaily = $resultsDaily->getRows();

    foreach (@$rows as $row) {
        mysql_query("UPDATE analytics SET rejeicao='" . $row[2] . "' WHERE pagina = '" . $row[1] . "' AND cliente_id = '" . $cliente . "'");
    }

    foreach (@$rowsDaily as $rowDaily) {
        mysql_query("UPDATE analyticsdaily SET rejeicao='" . $rowDaily[2] . "' WHERE pagina = '" . $rowDaily[1] . "' AND cliente_id = '" . $cliente . "' AND data = '" . $data . "'");
    }

    echo "Terminou processo de pegar informações do analytics para o cliente " . $cliente . "<br />";
}
?>

