<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3>Dashboard</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-16 col-lg-16 col-xl-16">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Conteúdos do blog</h5>
                </div>
                <div class="card-block">
                    <div id="conteudo-blog" style="height: 200px;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-16 col-lg-5 col-xl-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Conteúdo por persona</h5>
                </div>
                <div class="card-block">
                    <div id="conteudo-persona" style="height: 200px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-16 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Conteúdo por desafio</h5>
                </div>
                <div class="card-block">
                    <div id="conteudo-desafio" style="height: 200px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-16 col-lg-5 col-xl-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Status do conteúdo</h5>
                </div>
                <div class="card-block">
                    <div id="status-conteudo" style="height: 200px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!--    <div class="row">
            <div class="col-md-16 col-lg-16 col-xl-16">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Conteúdos do Mídias sociais</h5>
                    </div>
                    <div class="card-block">
                        <div id="conteudo-midia" style="height: 200px;"></div>
                    </div>
                </div>
            </div>
        </div>-->
    <div class="row">
        <div class="col-md-16 col-lg-5 col-xl-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Conteúdo de mídia por persona</h5>
                </div>
                <div class="card-block">
                    <div id="midia-persona" style="height: 200px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-16 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Conteúdo por mídia</h5>
                </div>
                <div class="card-block">
                    <div id="conteudo-por-midia" style="height: 200px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-16 col-lg-5 col-xl-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Status das Mídias</h5>
                </div>
                <div class="card-block">
                    <div id="status-midia" style="height: 200px;"></div>
                </div>
            </div>
        </div>
    </div>
    <!--    <div class="row">
            <div class="col-md-16 col-lg-16 col-xl-16">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Google Analytics</h5>
                    </div>
                    <div class="card-block">
                        <div id="google-analytics" style="height: 200px;"></div>
                    </div>
                </div>
            </div>
        </div>-->
    <!--    <div class="row">
            <div class="col-md-16 col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Páginas mais acessadas</h5>
                    </div>
                    <div class="card-block">
                        <div id="paginas-acessadas">
                            <ul>
                                <li>http://www.asbmarketing.com.br/contato <span class="pull-right">340</span></li>
                                <li>http://www.asbmarketing.com.br/funil-vendas <span class="pull-right">367</span></li>
                                <li>http://asbmarketing.com.br/quem-somos <span class="pull-right">402</span></li>
                                <li>http://asbmarketing.com.br/materiais-educativos <span class="pull-right">670</span></li>
                                <li>http://asbmarketing.com.br/automacao-de-marketing <span class="pull-right">1130</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-16 col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Principais palavras-chave</h5>
                    </div>
                    <div class="card-block">
                        <div id="principais-palavras">
                            <ul>
                                <li>Inbound Marketing <span class="pull-right">120</span></li>
                                <li>Marketing de conteúdo <span class="pull-right">290</span></li>
                                <li>Marketing digital <span class="pull-right">345</span></li>
                                <li>Métricas e Kpis <span class="pull-right">456</span></li>
                                <li>Funil de vendas <span class="pull-right">898</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
</div>

<?php
$personas = "";
foreach ($porPersonas as $porPersona) {
    $personas .= '{label: "'.$porPersona['pauta']['personapublico']['nome'].'", value: '.$porPersona['count'].'},';
}

$desafios = "";
foreach ($porDesafios as $porDesafio) {
    $desafios .= '{label: "'.$porDesafio['pauta']['desafiospublico']['desafio'].'", value: '.$porDesafio['count'].'},';
}

$status = "";
foreach ($porStatus as $porStatu) {
    $status .= '{label: "'.$porStatu['status'].'", value: '.$porStatu['count'].'},';
}

$midiaPersonas = "";
foreach ($midiaPorPersonas as $midiaPorPersona) {
    $midiaPersonas .= '{label: "'.$midiaPorPersona['personapublico']['nome'].'", value: '.$midiaPorPersona['count'].'},';
}

$midiaStatus = "";
foreach ($midiaPorStatus as $midiaPorStatu) {
    $midiaStatus .= '{label: "'.$midiaPorStatu['status'].'", value: '.$midiaPorStatu['count'].'},';
}

$analy = "";
foreach ($analytics as $anl){
    $analy .= '{y: "'.$anl['titulo'].'", a: '.$anl['views'].', b: '.$anl['avg'].'},';
}
?>

<script>
    "use strict"
    $(function () {
        // Conteúdo do Blog
        Morris.Bar({
            element: 'conteudo-blog',
            data: [
                <?=$analy;?>
            ],
            resize: true,
            hideHover: true,
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Visualizações', 'Taxa de rejeição'],
            barColors: ["#1E90FF", "#FFA500"]
        });

        // Conteúdo por persona
        Morris.Donut({
            element: 'conteudo-persona',
            data: [<?=$personas?>],
            resize: true,
            labelColor: '#fff',
            colors: ["#1E90FF", "#FFA500", "#F44336", "#B0C4DE", "#4682B4"]
        });

        // Conteúdo por desafio
        Morris.Donut({
            element: 'conteudo-desafio',
            data: [<?=$desafios;?>],
            resize: true,
            labelColor: '#fff',
            colors: ["#1E90FF", "#FFA500", "#F44336", "#B0C4DE", "#4682B4"]
        });

        // Status do conteúdo
        Morris.Donut({
            element: 'status-conteudo',
            data: [<?=$status?>],
            resize: true,
            labelColor: '#fff',
            colors: ["#1E90FF", "#FFA500", "#F44336", "#B0C4DE", "#4682B4"]
        });

        // Conteúdo da mídia
//        Morris.Bar({
//            element: 'conteudo-midia',
//            data: [
//                {y: 'Como ser vendas e Marketing ao mesmo tempo', a: 70, b: 10},
//                {y: 'Como aumentar sua produtividade em marketing', a: 120, b: 35},
//                {y: 'Vendas como foco em marketing', a: 40, b: 25},
//                {y: 'Como ter resultados nas vendas se você está focado em marketing', a: 75, b: 15},
//            ],
//            resize: true,
//            hideHover: true,
//            xkey: 'y',
//            ykeys: ['a', 'b'],
//            labels: ['Visualizações', 'Taxa de rejeição'],
//            barColors: ["#1E90FF", "#FFA500"]
//        });

        // Mídia por persona
        Morris.Donut({
            element: 'midia-persona',
            data: [<?=$midiaPersonas;?>],
            resize: true,
            labelColor: '#fff',
            colors: ["#1E90FF", "#FFA500", "#F44336", "#B0C4DE", "#4682B4"]
        });

        // Conteúdo por mídia
        Morris.Donut({
            element: 'conteudo-por-midia',
            data: [
                {label: "Facebook", value: <?=$midiaPorFacebook;?>},
                {label: "Instagram", value: <?=$midiaPorInstagram;?>},
                {label: "Twitter", value: <?=$midiaPorTwitter;?>},
                {label: "Linkedin", value: <?=$midiaPorLinkedin;?>},
                {label: "Google+", value: <?=$midiaPorGoogle;?>},
            ],
            resize: true,
            labelColor: '#fff',
            colors: ["#1E90FF", "#FFA500", "#F44336", "#B0C4DE", "#4682B4"]
        });

        // Status do conteúdo
        Morris.Donut({
            element: 'status-midia',
            data: [<?=$midiaStatus;?>],
            resize: true,
            labelColor: '#fff',
            colors: ["#1E90FF", "#FFA500", "#F44336", "#B0C4DE", "#4682B4"]
        });

        // Google Analytics
//        Morris.Line({
//            element: 'google-analytics',
//            data: [
//                {y: '2017-05', a: 80, b: 90},
//                {y: '2017-06', a: 70, b: 110},
//                {y: '2017-07', a: 75, b: 89},
//                {y: '2017-08', a: 100, b: 130},
//            ],
//            resize: true,
//            xkey: 'y',
//            ykeys: ['a', 'b'],
//            lineColors: ["#1E90FF", "#FFA500"],
//            labels: ['Usuários', 'Sessões']
//        });
    });
</script>
