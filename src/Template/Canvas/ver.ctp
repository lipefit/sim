<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-th-large"></i> <?= __('Canvas') ?></h3>
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
                    <h6 class="card-title"><?= $canvas['titulo']; ?></h6>
                </div>
                <div class="card-block member-list">
                    <div class="row">
                        <div class="col-sm-3 col-md-3">
                            <div class="media flex-column fixHeith">
                                <div class="panel-body noPadding" style="height: 380px;">
                                    <div class="row">
                                        <div class="col-sm-16 col-md-16">
                                            <div class="panel-heading bg1 noBg">
                                                Parceiros Chave <i class="fa fa-key faCanvas"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-16 col-md-16">
                                            <ul class="ulCanvas parceiros-chave">
                                                <?php foreach ($parceirosChave as $pc): ?>
                                                    <li class="<?= $pc['cor']; ?> showActions" rel="<?= $pc['id']; ?>">
                                                        <?= $pc['texto']; ?>
                                                        <div class="pull-right actions" style="display: none;">
                                                            <a href="#data" rel="parceiros-chave_<?= $pc['id']; ?>" class="editPost"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            <?= $this->Form->postLink('<i class="fa fa-times" aria-hidden="true"></i>', array('action' => 'excluirPost', $pc['id']), array('escape' => false), 'Tem certeza que deseja excluir esse postit?');
                                                            ?>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer" style="height: 30px; line-height: 0px; padding: 14px;">
                                    <a class="addPost btn btn-outline-primary btn-round" href="#data" rel="parceiros-chave">+ Adicionar post-it</a>
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="media flex-column fixHeith" style="height: 215px;">
                                <div class="panel-body noPadding" style="height: 145px;">
                                    <div class="row">
                                        <div class="col-sm-16 col-md-16">
                                            <div class="panel-heading bg2 noBg">
                                                Atividades Chave <i class="fa fa-key faCanvas"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-16 col-md-16">
                                            <ul class="ulCanvas atividades-chave">
                                                <?php foreach ($atividadesChave as $ac): ?>
                                                    <li class="<?= $ac['cor']; ?> showActions" rel="<?= $ac['id']; ?>">
                                                        <?= $ac['texto']; ?>
                                                        <div class="pull-right actions" style="display: none;">
                                                            <a href="#data" rel="atividades-chave_<?= $ac['id']; ?>" class="editPost"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            <?= $this->Form->postLink('<i class="fa fa-times" aria-hidden="true"></i>', array('action' => 'excluirPost', $ac['id']), array('escape' => false), 'Tem certeza que deseja excluir esse postit?');
                                                            ?>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer" style="height: 30px; line-height: 0px; padding: 14px;">
                                    <a class="addPost btn btn-outline-primary btn-round" href="#data" rel="atividades-chave">+ Adicionar post-it</a>
                                </div>
                            </div>
                            <div class="media flex-column fixHeith" style="height: 215px;">
                                <div class="panel-body noPadding" style="height: 145px;">
                                    <div class="row">
                                        <div class="col-sm-16 col-md-16">
                                            <div class="panel-heading bg3 noBg">
                                                Recursos Chave <i class="fa fa-key faCanvas"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-16 col-md-16">
                                            <ul class="ulCanvas recursos-chave">
                                                <?php foreach ($recursosChave as $rc): ?>
                                                    <li class="<?= $rc['cor']; ?> showActions" rel="<?= $rc['id']; ?>">
                                                        <?= $rc['texto']; ?>
                                                        <div class="pull-right actions" style="display: none;">
                                                            <a href="#data" rel="recursos-chave_<?= $rc['id']; ?>" class="editPost"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            <?= $this->Form->postLink('<i class="fa fa-times" aria-hidden="true"></i>', array('action' => 'excluirPost', $rc['id']), array('escape' => false), 'Tem certeza que deseja excluir esse postit?');
                                                            ?>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer" style="height: 30px; line-height: 0px; padding: 14px;">
                                    <a class="addPost btn btn-outline-primary btn-round" href="#data" rel="recursos-chave">+ Adicionar post-it</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="media flex-column fixHeith">
                                <div class="panel-body noPadding" style="height: 380px;">
                                    <div class="row">
                                        <div class="col-sm-16 col-md-16">
                                            <div class="panel-heading bg4 noBg">
                                                Proposta de Valor <i class="fa fa-gift faCanvas"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-16 col-md-16">
                                            <ul class="ulCanvas proposta-de-valor">
                                                <?php foreach ($propostaDeValor as $pv): ?>
                                                    <li class="<?= $pv['cor']; ?> showActions" rel="<?= $pv['id']; ?>">
                                                        <?= $pv['texto']; ?>
                                                        <div class="pull-right actions" style="display: none;">
                                                            <a href="#data" rel="proposta-de-valor_<?= $pv['id']; ?>" class="editPost"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            <?= $this->Form->postLink('<i class="fa fa-times" aria-hidden="true"></i>', array('action' => 'excluirPost', $pv['id']), array('escape' => false), 'Tem certeza que deseja excluir esse postit?');
                                                            ?>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div> 
                                <div class="panel-footer" style="height: 30px; line-height: 0px; padding: 14px;">
                                    <a class="addPost btn btn-outline-primary btn-round" href="#data" rel="proposta-de-valor">+ Adicionar post-it</a>
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="media flex-column fixHeith" style="height: 215px;">
                                <div class="panel-body noPadding" style="height: 145px;">
                                    <div class="row">
                                        <div class="col-sm-16 col-md-16">
                                            <div class="panel-heading bg5 noBg">
                                                Relaçao com o Cliente <i class="fa fa-heart-o faCanvas"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">   
                                        <div class="col-sm-16 col-md-16">
                                            <ul class="ulCanvas relacao-com-o-cliente">
                                                <?php foreach ($relacaoComCliente as $rcc): ?>
                                                    <li class="<?= $rcc['cor']; ?> showActions" rel="<?= $rcc['id']; ?>">
                                                        <?= $rcc['texto']; ?>
                                                        <div class="pull-right actions" style="display: none;">
                                                            <a href="#data" rel="relacao-com-o-cliente_<?= $rcc['id']; ?>" class="editPost"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            <?= $this->Form->postLink('<i class="fa fa-times" aria-hidden="true"></i>', array('action' => 'excluirPost', $rcc['id']), array('escape' => false), 'Tem certeza que deseja excluir esse postit?');
                                                            ?>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer" style="height: 30px; line-height: 0px; padding: 14px;">
                                    <a class="addPost btn btn-outline-primary btn-round" href="#data" rel="relacao-com-o-cliente">+ Adicionar post-it</a>
                                </div>
                            </div>
                            <div class="media flex-column fixHeith" style="height: 215px;">
                                <div class="panel-body noPadding" style="height: 145px;">
                                    <div class="row">
                                        <div class="col-sm-16 col-md-16">
                                            <div class="panel-heading bg6 noBg">
                                                Canais <i class="fa fa-truck faCanvas"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-16 col-md-16">
                                            <ul class="ulCanvas canais">
                                                <?php foreach ($canais as $c): ?>
                                                    <li class="<?= $c['cor']; ?> showActions" rel="<?= $c['id']; ?>">
                                                        <?= $c['texto']; ?>
                                                        <div class="pull-right actions" style="display: none;">
                                                            <a href="#data" rel="canais_<?= $c['id']; ?>" class="editPost"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            <?= $this->Form->postLink('<i class="fa fa-times" aria-hidden="true"></i>', array('action' => 'excluirPost', $c['id']), array('escape' => false), 'Tem certeza que deseja excluir esse postit?');
                                                            ?>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer" style="height: 30px; line-height: 0px; padding: 14px;">
                                    <a class="addPost btn btn-outline-primary btn-round" href="#data" rel="canais">+ Adicionar post-it</a>
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="media flex-column fixHeith">
                                <div class="panel-body noPadding" style="height: 380px;">
                                    <div class="row">
                                        <div class="col-sm-16 col-md-16">
                                            <div class="panel-heading bg7 noBg">
                                                Segmentos de Mercado <i class="fa fa-bar-chart-o faCanvas" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-16 col-md-16">
                                            <ul class="ulCanvas segmentos-de-mercado">
                                                <?php foreach ($segmentosDeMercado as $sdm): ?>
                                                    <li class="<?= $sdm['cor']; ?> showActions" rel="<?= $sdm['id']; ?>">
                                                        <?= $sdm['texto']; ?>
                                                        <div class="pull-right actions" style="display: none;">
                                                            <a href="#data" rel="segmentos-de-mercado_<?= $sdm['id']; ?>" class="editPost"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            <?= $this->Form->postLink('<i class="fa fa-times" aria-hidden="true"></i>', array('action' => 'excluirPost', $sdm['id']), array('escape' => false), 'Tem certeza que deseja excluir esse postit?');
                                                            ?>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer" style="height: 30px; line-height: 0px; padding: 14px;">
                                    <a class="addPost btn btn-outline-primary btn-round" href="#data" rel="segmentos-de-mercado">+ Adicionar post-it</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1 col-md-1"></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8 col-md-8">
                            <div class="media flex-column fixHeith">
                                <div class="panel-body noPadding" style="height: 380px;">
                                    <div class="row">
                                        <div class="col-sm-16 col-md-16">
                                            <div class="panel-heading bg8 noBg">
                                                Estrutura de Custos <i class="fa fa-file-text-o faCanvas"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-16 col-md-16">
                                            <ul class="ulCanvas estrutura-de-custos">
                                                <?php foreach ($estruturaDeCustos as $edc): ?>
                                                    <li class="<?= $edc['cor']; ?> showActions" rel="<?= $edc['id']; ?>">
                                                        <?= $edc['texto']; ?>
                                                        <div class="pull-right actions" style="display: none;">
                                                            <a href="#data" rel="estrutura-de-custos_<?= $edc['id']; ?>" class="editPost"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            <?= $this->Form->postLink('<i class="fa fa-times" aria-hidden="true"></i>', array('action' => 'excluirPost', $edc['id']), array('escape' => false), 'Tem certeza que deseja excluir esse postit?');
                                                            ?>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer" style="height: 30px; line-height: 0px; padding: 14px;">
                                    <a class="addPost btn btn-outline-primary btn-round" href="#data" rel="estrutura-de-custos">+ Adicionar post-it</a>
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-7 col-md-7">
                            <div class="media flex-column fixHeith">
                                <div class="panel-body noPadding" style="height: 380px;">
                                    <div class="row">
                                        <div class="col-sm-16 col-md-16">
                                            <div class="panel-heading bg9 noBg">
                                                Fontes de Renda <i class="fa fa-money faCanvas"></i>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-sm-16 col-md-16">
                                            <ul class="ulCanvas fontes-de-renda">
                                                <?php foreach ($fontesDeRenda as $fdr): ?>
                                                    <li class="<?= $fdr['cor']; ?> showActions" rel="<?= $fdr['id']; ?>">
                                                        <?= $fdr['texto']; ?>
                                                        <div class="pull-right actions" style="display: none;">
                                                            <a href="#data" rel="fontes-de-renda_<?= $fdr['id']; ?>" class="editPost"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            <?= $this->Form->postLink('<i class="fa fa-times" aria-hidden="true"></i>', array('action' => 'excluirPost', $fdr['id']), array('escape' => false), 'Tem certeza que deseja excluir esse postit?');
                                                            ?>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer" style="height: 30px; line-height: 0px; padding: 14px;">
                                    <a class="addPost btn btn-outline-primary btn-round" href="#data" rel="fontes-de-renda">+ Adicionar post-it</a>
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-1 col-md-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="display: none;">
    <div id="data">
        <h3 class="popupTitle">Adicionar Post-it</h3>

        <div id="previewNote" class="note yellow" style="left:0;top:65px;z-index:1">
            <div class="body"></div>
            <div class="author"></div>
            <span class="data"></span>
        </div>

        <div id="noteData">
            <form action="" method="post" class="note-form">
                <label for="note-body">Texto</label>
                <textarea name="note-body" id="note-body" class="pr-body" cols="30" rows="6"></textarea>

                <label>Cor</label>
                <div class="color yellow"></div>
                <div class="color blue"></div>
                <div class="color green"></div>
                <div class="color red"></div>
                <div class="color pink"></div>
                <input type="hidden" value="" name="tipo" id="tipoPost">
                <input type="hidden" value="" name="id" id="idPost">
                <input type="hidden" value="<?= $canvas['id']; ?>" name="canvasId" id="canvasId">
                <a id="note-submit" href="" class="green-button">Salvar</a>
            </form>
        </div>
    </div>
</div>

<style>
    .fixHeith{
        height: 450px;
        /*overflow-y: auto;*/
        border: none !important; 
    }

    .noBg{
        border: none !important;
        /*background: #fff !important;*/
        border-radius: 0 !important;
        line-height: 14px;
    }

    .noBg i{
        margin-top: 5px;
    }

    .bg1{
        border-left: 4px solid #C52A51 !important;
        padding-left: 2px;
    }

    .bg2{
        border-left: 4px solid #DC75B0 !important;
        padding-left: 2px;
    }

    .bg3{
        border-left: 4px solid #62B81A !important;
        padding-left: 2px;
    }

    .bg4{
        border-left: 4px solid #FDBB45 !important;
        padding-left: 2px;
    }

    .bg5{
        border-left: 4px solid #FD7538 !important;
        padding-left: 2px;
    }

    .bg6{
        border-left: 4px solid #0DA5C5 !important;
        padding-left: 2px;
    }

    .bg7{
        border-left: 4px solid #15C88E !important;
        padding-left: 2px;
    }

    .bg8{
        border-left: 4px solid #8D358D !important;
        padding-left: 2px;
    }

    .bg9{
        border-left: 4px solid #906339 !important;
        padding-left: 2px;
    }

    .noPadding{
        padding: 10px 2px !important;
        line-height: 0px !important;
        /*overflow-y: auto;*/
    }

    .faCanvas{
        line-height: 0px !important;
        float: right !important;
    }

    .note{
        height:150px;
        padding:10px;
        width:150px;
        position:absolute;
        overflow:hidden;
        cursor:move;

        font-family:Trebuchet MS,Tahoma,Myriad Pro,Arial,Verdana,sans-serif;
        font-size:22px;

        /* Adding a CSS3 shadow below the note, in the browsers which support it: */
        -moz-box-shadow:2px 2px 0 #DDDDDD;
        -webkit-box-shadow:2px 2px 0 #DDDDDD;
        box-shadow:2px 2px 0 #DDDDDD;
    }

    .yellow{
        background-color:#FDFB8C;
        border:1px solid #DEDC65;	
    }

    .blue{
        background-color:#A6E3FC;
        border:1px solid #75C5E7;	
    }

    .green{
        background-color:#A5F88B;
        border:1px solid #98E775;	
    }

    .red{
        background-color:#FF6A6A;
        border:1px solid #CD5555;	
    }

    .pink{
        background-color:#F097CA;
        border:1px solid #E034CA;	
    }

    /* Each note has a data span, which holds its ID */
    span.data{	display:none; }

    /* Green button class: */
    a.green-button,a.green-button:visited{
        color:black;
        display:block;
        font-size:10px;
        font-weight:bold;
        padding:6px 5px 4px;
        text-align:center;
        width:75px;

        text-shadow:1px 1px 1px #DDDDDD;
        background:url(/postit/img/button_green.png) no-repeat left top;
    }

    a.green-button:hover{
        text-decoration:none;
        /*background-position:left bottom;*/
    }

    .author{
        /* The author name on the note: */
        bottom:10px;
        color:#666666;
        font-family:Arial,Verdana,sans-serif;
        font-size:12px;
        position:absolute;
        right:10px;
    }

    #main{
        /* Contains all the notes and limits their movement: */
        margin:0 auto;
        position:relative;
        width:980px;
        height:500px;
        z-index:10;
        background:url(/postit/img/add_a_note_help.gif) no-repeat left top;
    }

    h3.popupTitle{
        border-bottom:1px solid #DDDDDD;
        color:#666666;
        font-size:24px;
        font-weight:normal;
        padding:0 0 5px;
    }

    #noteData{
        /* The input form in the pop-up: */
        height:200px;
        margin:30px 0 0 200px;
        width:350px;
    }

    .note-form label{
        display:block;
        font-size:10px;
        font-weight:bold;
        letter-spacing:1px;
        text-transform:uppercase;
        padding-bottom:3px;
    }

    .note-form textarea, .note-form input[type=text]{
        background-color:#FCFCFC;
        border:1px solid #AAAAAA;
        font-family:Arial,Verdana,sans-serif;
        font-size:16px;
        height:60px;
        padding:5px;
        width:300px;
        margin-bottom:10px;
    }

    .note-form input[type=text]{	height:auto; }

    .color{
        /* The color swatches in the form: */
        cursor:pointer;
        float:left;
        height:10px;
        margin:0 5px 0 0;
        width:10px;
    }

    #note-submit{	margin:20px auto; }

    /* The styles below are only necessary for the demo page */

    p.tutInfo{
        /* The tutorial info on the bottom of the page */
        padding:10px 0;
        text-align:center;
        position:fixed;
        bottom:0px;
        background:#f0f0f0;
        border-top:1px solid #eaeaea;
        width:100%;
        z-index:15;
    }

    h1,h2,p.tutInfo{
        font-family:"Myriad Pro",Arial,Helvetica,sans-serif;
    }

    .ulCanvas{
        list-style: none; 
        padding: 0;
        margin-top: 12px;
    }

    .ulCanvas li{
        display: block;
        float: left;
        width: 100%;
        height: auto;
        line-height: 18px;
        border-radius: 5px;
        padding: 3px;
        margin-top: 6px;
        color: #333;
    }
</style>
<?= $this->Html->script('/js/fancybox/jquery.fancybox-1.2.6.pack'); ?>
<?= $this->Html->css('/js/fancybox/jquery.fancybox-1.2.6') ?>
<script>
    $(document).ready(function () {
        // Configura a janela para adicionar post-it
        $(".addPost").fancybox({
            'zoomSpeedIn': 600,
            'zoomSpeedOut': 500,
            'easingIn': 'easeOutBack',
            'easingOut': 'easeInBack',
            'hideOnContentClick': false,
            'padding': 15
        });

        $(".addPost").click(function () {
            var tipo = $(this).attr("rel");
            $("#tipoPost").val(tipo);
            $(".body").html("");
            $("#note-body").val("");
            $('#previewNote').removeClass('yellow green blue red pink').addClass('yellow');
        });

        $(".editPost").fancybox({
            'zoomSpeedIn': 600,
            'zoomSpeedOut': 500,
            'easingIn': 'easeOutBack',
            'easingOut': 'easeInBack',
            'hideOnContentClick': false,
            'padding': 15
        });

        $(".editPost").click(function () {
            var rel = $(this).attr("rel");
            var sp = rel.split("_");
            var tipo = sp[0];
            var texto = $(this).parent().parent().text();
            var id = sp[1];
            var classe = $(this).parent().parent().attr('class').split(" ");
            var color = classe[0];

            $(".popupTitle").text("Editar Post-it");
            $("#tipoPost").val(tipo);
            $("#note-body").val(texto.trim());
            $("#idPost").val(id);
            $('.pr-body,.pr-author').keyup();
            $('#previewNote').removeClass('yellow').addClass(color);
        });

        // Altera a cor do post-it
        $('.color').click(function () {
            $('#previewNote').removeClass('yellow green blue red pink').addClass($(this).attr('class').replace('color', ''));
        });

        // Acrescenta texto no preview
        $('.pr-body,.pr-author').keyup(function (e) {
            if (!this.preview)
                this.preview = $('#previewNote');

            /* Setting the text of the preview to the contents of the input field, and stripping all the HTML tags: */
            this.preview.find($(this).attr('class').replace('pr-', '.')).html($(this).val().replace(/<[^>]+>/ig, ''));
        });

        /* The submit button: */
        $('#note-submit').click(function (e) {
            //$(this).replaceWith('<img src="/postit/img/ajax_load.gif" style="margin:30px auto;display:block" />');

            var body = $('.pr-body').val();
            var tipo = $('#tipoPost').val();
            var canvas = $('#canvasId').val();
            var color = $.trim($('#previewNote').attr('class').replace('note', ''));
            var id = $('#idPost').val();

            var data = {
                'body': body,
                'tipo': tipo,
                'canvas': canvas,
                'color': color,
                'id': id,
            };


            // Envia requisição via ajax
            base_url = '/';

            if (id == "") {
                $.post(base_url + 'canvas/savePost', data, function (msg) {
                    if (parseInt(msg)) {
                        $("." + tipo).append("<li class='" + color + "'>" + body + "</li>");
                        $('.pr-body').val("");
                        $('#tipoPost').val("");
                    }

                    $.fancybox.close();
                });
            } else {
                $.post(base_url + 'canvas/editPost', data, function (msg) {
                    if (parseInt(msg)) {
                        $("li[rel='" + id + "']").remove();
                        $("." + tipo).append("<li class='" + color + "'>" + body + "</li>");
                        $('.pr-body').val("");
                        $('#tipoPost').val("");
                        $('#idPost').val("");
                    }

                    $.fancybox.close();
                });
            }

            e.preventDefault();
        })

        $('.showActions').mouseover(function () {
            console.log("teste");
            $(this).find('.actions').show();
        });

        $('.showActions').mouseout(function () {
            $(this).find('.actions').hide();
        });

        $('.note-form').on('submit', function (e) {
            e.preventDefault();
        });

    });
</script>