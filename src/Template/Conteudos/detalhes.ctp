<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-file-text"></i> <?= __('Conteúdos') ?></h3>
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
                        <strong>Criado por <?= $revisao->alias_autor->name . " " . $revisao->alias_autor->surname; ?></strong>
                        <br>
                        <strong>Em <?= $conteudo->created; ?></strong>
                    </div>
                    <div class="col-lg-3 col-sm-3">
                        <strong>Em revisão</strong>
                        <?php
                        if ($conteudo->status == "Aprovação" || $conteudo->status == "Publicação agendada" || $conteudo->status == "Publicado") {
                            echo "<br>";
                            echo "<strong>Revisado por " . $revisao->alias_revisor->name . " " . $revisao->alias_revisor->surname . "</strong><br>";
                            echo "<strong>Em " . $revisao->revisado . "</strong>";
                        }
                        ?>

                    </div>
                    <div class="col-lg-3 col-sm-3" style="text-align: center;">
                        <strong>Aguardando aprovação</strong>
                    </div>
                    <div class="col-lg-3 col-sm-3" style="text-align: center;">
                        <strong>Publicação agendada</strong>
                        <?php
                        if ($conteudo->status == "Publicação agendada") {
                            echo "<br>";
                            echo "<strong>Aprovado por " . $revisao->alias_aprovador->name . " " . $revisao->alias_aprovador->surname . "</strong><br>";
                            echo "<strong>Em " . $revisao->aprovado . "</strong>";
                        }
                        ?>
                    </div>
                    <div class="col-lg-3 col-sm-3" style="text-align: right;">
                        <strong>Publicado</strong>
                    </div>
                </div>
                <div class="row">
                    <div class="progress ">
                        <?php
                        switch ($conteudo->status) {
                            case "Rascunho":
                                $percentual = "5";
                                break;
                            case "Revisão":
                                $percentual = "29";
                                break;
                            case "Aprovação":
                                $percentual = "53";
                                break;
                            case "Publicação agendada":
                                $percentual = "72";
                                break;
                            case "Publicado":
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
                    <h6 class="card-title"><?= __('Conteúdo') ?></h6>
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
                            <hr />
                            <p><strong>Meta description</strong></p>
                            <p><?= $revisao->description; ?></p>
                            <hr />
                            <p><strong>Conteúdo</strong></p>
                            <?= $revisao->content; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-16 col-lg-5">
            <br>
            <div>
                <?php
                echo $this->Html->link(__('Editar conteúdo'), ['action' => 'edit', $conteudo->id], ['class' => 'btn btn-lg btn-secondary col-sm-16 col-lg-16']);
                echo "<br><br>";
                if ($conteudo->status == "Rascunho") {
                    echo $this->Html->link(__('Enviar para revisão'), ['action' => 'revisao', $conteudo->id], ['class' => 'btn btn-lg btn-primary col-sm-16 col-lg-16']);
                } else if ($conteudo->status == "Revisão") {
                    echo $this->Html->link(__('Aprovar revisão'), ['action' => 'aprovar_revisao', $conteudo->id], ['class' => 'btn btn-lg btn-primary col-sm-16 col-lg-16']);
                    echo "<br><br>";
                    echo $this->Html->link(__('Reprovar revisão'), ['action' => 'reprovar_revisao', $conteudo->id], ['class' => 'btn btn-lg btn-danger col-sm-16 col-lg-16']);
                } else if ($conteudo->status == "Aprovação") {
                    echo $this->Html->link(__('Aprovar e agendar publicação'), ['action' => 'aprovar', $conteudo->id], ['class' => 'btn btn-lg btn-primary col-sm-16 col-lg-16']);
                    echo "<br><br>";
                    echo $this->Html->link(__('Reprovar'), ['action' => 'reprovar', $conteudo->id], ['class' => 'btn btn-lg btn-danger col-sm-16 col-lg-16']);
                } else {
                    echo $this->Html->link(__('Publicar agora'), ['controller' => 'conteudos', 'action' => 'publicar', $pauta->id], ['class' => 'btn btn-lg btn-primary col-sm-16 col-lg-16']);
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
                                <a class="dropdown-item" href="javascrip:void(0)" data-toggle="modal" data-target="#mensagem_conteudo">Adicionar</a>
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