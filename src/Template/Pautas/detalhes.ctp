<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-file-text"></i> <?= __('Pautas de conteúdos') ?></h3>
        </div>
        <div class="col text-right ">
            <div class="btn-group pull-right">
                <a href='javascript:history.back()' class="btn btn-warning btn-round"><span class="text"><?= __('Voltar') ?></span></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title"><?= __('Pauta de conteúdo') ?></h6>
                </div>
                <div class='row'>
                    <div class='col-sm-16 col-md-16'>
                        <div class='card-block'>
                            <p><strong>Título</strong></p>
                            <h4><?= $pauta->titulo; ?></h4>
                            <br />
                            <p><strong>Persona: </strong> <?= $pauta->persona->nome; ?></p> 
                            <p><strong>Desafio: </strong> <?= $pauta->desafio->desafio; ?></p> 
                            <p><strong>Tipo de conteúdo: </strong> <?= $pauta->tipo; ?></p> 
                            <p><strong>Palavras-chave: </strong> <?= $pauta->palavras; ?></p> 
                            <p><strong>Data de publicação: </strong> <?= $pauta->dataPublicacao; ?></p> 
                            <p><strong>Hora de publicação: </strong> <?= $pauta->horaPublicacao; ?></p>
                            <br />
                            <p><strong>Considerações</strong></p>
                            <p><?= $pauta->consideracoes; ?></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title"><?= __('Comentários') ?></h6>
                </div>
                <div class='row'>
                    <div class='col-sm-16 col-md-16'>
                        <div class='card-block'>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title"><?= __('Imagem') ?></h6>
                </div>
                <div class='row'>
                    <div class='col-sm-16 col-md-16'>
                        <div class='card-block'>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>