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
        <div class="card-block">
            <div class="activity-block success">
                <div class="row">
                    <div class="col-lg-4 col-sm-4">
                        <strong>Rascunho</strong>
                        <br>
                        <strong>Criado por <?= $pauta->alias_autor->name . " " . $pauta->alias_autor->surname; ?></strong>
                        <br>
                        <strong>Em <?= $pauta->created; ?></strong>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <strong>Em revisão</strong>
                        <?php
                        if ($pauta->status == "Aprovação" || $pauta->status == "Aprovado") {
                            echo "<br>";
                            echo "<strong>Revisado por " . $pauta->alias_revisor->name . " " . $pauta->alias_revisor->surname . "</strong><br>";
                            echo "<strong>Em " . $pauta->revisado . "</strong>";
                        }
                        ?>

                    </div>
                    <div class="col-lg-4 col-sm-4" style="text-align: center;">
                        <strong>Aguardando aprovação</strong>
                    </div>
                    <div class="col-lg-4 col-sm-4" style="text-align: right;">
                        <strong>Aprovada</strong>
                        <?php
                        if ($pauta->status == "Aprovado") {
                            echo "<br>";
                            echo "<strong>Aprovada por " . $pauta->alias_aprovador->name . " " . $pauta->alias_aprovador->surname . "</strong><br>";
                            echo "<strong>Em " . $pauta->aprovado . "</strong>";
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="progress ">
                        <?php
                        switch ($pauta->status) {
                            case "Rascunho":
                                $percentual = "5";
                                break;
                            case "Revisão":
                                $percentual = "30";
                                break;
                            case "Aprovação":
                                $percentual = "63";
                                break;
                            case "Aprovado":
                                $percentual = "100";
                                break;
                            default :
                                break;
                        }
                        ?>
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentual; ?>%;"><span class="trackerball"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-16 col-lg-11">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title"><?= __('Pauta de conteúdo') ?></h6>
                </div>
                <div class='row'>
                    <div class='col-sm-16 col-lg-16'>
                        <div class='card-block'>
                            <p><strong>Título</strong></p>
                            <h4><?= $pauta->titulo; ?></h4>
                            <hr />
                            <p><strong>Persona: </strong> <?= $pauta->persona->nome; ?></p> 
                            <p><strong>Desafio: </strong> <?= $pauta->desafio->desafio; ?></p> 
                            <p><strong>Tipo de conteúdo: </strong> <?= $pauta->tipo; ?></p> 
                            <p><strong>Palavras-chave: </strong> <?= $pauta->palavras; ?></p> 
                            <p><strong>Data de publicação: </strong> <?= $pauta->dataPublicacao; ?></p> 
                            <p><strong>Hora de publicação: </strong> <?= $pauta->horaPublicacao; ?></p>
                            <hr />
                            <p><strong>Considerações</strong></p>
                            <p><?= $pauta->consideracoes; ?></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-16 col-lg-5">
            <br>
            <div>
                <?php
                        echo $this->Html->link(__('Editar pauta'), ['action' => 'edit', $pauta->id], ['class' => 'btn btn-lg btn-secondary col-sm-16 col-lg-16']);
                        echo "<br><br>";
                    if($pauta->status == "Rascunho"){
                        echo $this->Html->link(__('Enviar para revisão'), ['action' => 'revisao', $pauta->id], ['class' => 'btn btn-lg btn-primary col-sm-16 col-lg-16']);
                    }else if($pauta->status == "Revisão"){
                        echo $this->Html->link(__('Aprovar revisão'), ['action' => 'aprovar_revisao', $pauta->id], ['class' => 'btn btn-lg btn-primary col-sm-16 col-lg-16']);
                        echo "<br><br>";
                        echo $this->Html->link(__('Reprovar revisão'), ['action' => 'reprovar_revisao', $pauta->id], ['class' => 'btn btn-lg btn-danger col-sm-16 col-lg-16']);
                    }else if($pauta->status == "Aprovação"){
                        echo $this->Html->link(__('Aprovar'), ['action' => 'aprovar', $pauta->id], ['class' => 'btn btn-lg btn-primary col-sm-16 col-lg-16']);
                        echo "<br><br>";
                        echo $this->Html->link(__('Reprovar'), ['action' => 'reprovar', $pauta->id], ['class' => 'btn btn-lg btn-danger col-sm-16 col-lg-16']);
                    }else{
                        echo $this->Html->link(__('Criar conteúdo'), ['controller'=>'conteudos', 'action' => 'add', $pauta->id], ['class' => 'btn btn-lg btn-primary col-sm-16 col-lg-16']);
                    }
                ?>
            </div>
            <hr>
            <ul class="nav flex-column mt-2">
                <li><span class="page_subtitles">Comentários </span>
                    <ul class="nav pull-right">
                        <li class="nav-item">
                            <button class="btn btn-sm btn-link btn-round" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-chevron-down"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascrip:void(0)" data-toggle="modal" data-target="#mensagem_pauta">Adicionar</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <div class="list-unstyled comment-list">
                        <?php
                        foreach ($mensagens as $mensagem) {
                            ?>
                            <div class="media"> 
                                <span class="message_userpic">
                                    <img class="d-flex" src="../img/user-header.png" alt="">
                                    <span class="user-status bg-success "></span>
                                </span>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1"><?= $mensagem->profile->name . " " . $mensagem->profile->surname; ?> 
                                        <small class="pull-right"><?= $mensagem->created; ?></small>
                                    </h6>
                                    <p class="description"><?= $mensagem->mensagem; ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </li>
            </ul>
            <hr>
        </div>
    </div>
</div>