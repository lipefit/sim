<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-file-text"></i> <?= __('Mídias sociais') ?></h3>
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
                        <strong>Criado por <?= @$revisao->alias_autor->name . " " . @$revisao->alias_autor->surname; ?></strong>
                        <br>
                        <strong>Em <?= $social->created; ?></strong>
                    </div>
                    <div class="col-lg-3 col-sm-3">
                        <strong>Em revisão</strong>
                        <?php
                        if ($social->status == "Aprovação" || $social->status == "Publicação agendada" || $social->status == "Publicado") {
                            echo "<br>";
                            echo "<strong>Revisado por " . @$revisao->alias_revisor->name . " " . @$revisao->alias_revisor->surname . "</strong><br>";
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
                        if ($social->status == "Publicação agendada") {
                            echo "<br>";
                            echo "<strong>Aprovado por " . @$revisao->alias_aprovador->name . " " . @$revisao->alias_aprovador->surname . "</strong><br>";
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
                        switch ($social->status) {
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
                    <h6 class="card-title"><?= __('Mídia social') ?></h6>
                </div>
                <div class='row'>
                    <div class='col-sm-16 col-lg-16'>
                        <div class='card-block'>
                            <p><strong>Título</strong></p>
                            <h4><?= @$revisao->pauta->titulo; ?></h4>
                            <hr />
                            <p><strong>Persona: </strong> <?= @$revisao->pauta->personapublico->nome; ?></p> 
                            <p><strong>Desafio: </strong> <?= @$revisao->pauta->desafiospublico->desafio; ?></p> 
                            <p><strong>Jornada: </strong> <?= @$revisao->jornada; ?></p>
                            <p><strong>Tema: </strong> <?= @$revisao->tema; ?></p> 
                            <p><strong>Call to action: </strong> <?= @$revisao->cta; ?></p>
                            <p><strong>Data de publicação: </strong> <?= @$revisao->dataPublicacao; ?></p> 
                            <p><strong>Hora de publicação: </strong> <?= @$revisao->horaPublicacao; ?></p>
                            <hr />
                            <p><strong>Observações</strong></p>
                            <p><?= @$revisao->observacoes; ?></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-16 col-md-16">
                        <div id="accordion" role="tablist" aria-multiselectable="true" class="accordion">

                            <!--Facebook-->

                            <div class="card">
                                <div class="card-header" role="tab" id="headingOne">
                                    <p class="mb-0"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed text-white"> <i class="fa fa-facebook fa-lg mr-2"></i> Facebook </a> </p>
                                </div>
                                <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false">
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8">
                                                <?php
                                                echo $this->Form->input('revisao_facebook', array(
                                                    'label' => 'Conteúdo',
                                                    'class' => 'col-lg-16 col-md-16 contador form-control',
                                                    'div' => false,
                                                    'rel' => '2000_facebook',
                                                    'type' => 'textarea',
                                                    'value' => $revisao->revisao_facebook,
                                                    'disabled' => 'disabled',
                                                    'style' => 'background-color: transparent'
                                                ));
                                                ?>
                                                <div id="_facebook" class="divContador"></div>
                                            </div>

                                            <div class="col-lg-8 col-md-8">
                                                <div class="row">
                                                    <div class="col-lg-5 col-md-5">
                                                        <label for=""dataPublicacao>Data da Publicação</label>
                                                        <input name="data_facebook" type="text" value="<?=$revisao->data_facebook;?>" disabled="disabled" style="background-color: transparent" class="datepicker form-control" data-date-format="dd/mm/yyyy">
                                                    </div>
                                                    <div class="col-lg-4 col-md-4">
                                                        <?php
                                                        echo $this->Form->input('hora_facebook', array(
                                                            'label' => 'Hora da Publicação',
                                                            'class' => 'horaPublicacao form-control',
                                                            'value' => $revisao->hora_facebook,
                                                            'disabled' => 'disabled',
                                                            'style' => 'background-color: transparent'
                                                        ));
                                                        ?>
                                                    </div>
                                                    <div class="col-lg-7 col-md-7">
                                                        <?php
                                                        echo $this->Form->input('hashtag_facebook', array(
                                                            'label' => 'Hashtag (Separadas por vírgula, sem #)',
                                                            'type' => 'text',
                                                            'class' => 'form-control',
                                                            'value' => $revisao->hashtag_facebook,
                                                            'disabled' => 'disabled',
                                                            'style' => 'background-color: transparent'
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="row">                                                        
                                                    <div class="col-lg-16 col-md-16">
                                                        <?php
                                                        if ($revisao->imagem_facebook != "") {
                                                            echo "<img src='" . DS . 'files' . DS . $revisao->imagem_facebook . "' width='200'>";
                                                        }
                                                        ?>
                                                    </div>                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Linkedin-->

                            <div class="card">
                                <div class="card-header" role="tab" id="headingTwo">
                                    <p class="mb-0"> <a class="collapsed text-white" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> <i class="fa fa-linkedin fa-lg mr-2"></i> Linkedin </a> </p>
                                </div>
                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false">
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8">
                                                <?php
                                                echo $this->Form->input('revisao_linkedin', array(
                                                    'label' => 'Conteúdo',
                                                    'class' => 'col-lg-16 col-md-16 contador form-control',
                                                    'div' => false,
                                                    'rel' => '700_linkedin',
                                                    'type' => 'textarea',
                                                    'value' => $revisao->revisao_linkedin,
                                                    'disabled' => 'disabled',
                                                    'style' => 'background-color: transparent'
                                                ));
                                                ?>
                                                <div id="_linkedin" class="divContador"></div>
                                            </div>

                                            <div class="col-lg-8 col-md-8">
                                                <div class="row">
                                                    <div class="col-lg-5 col-md-5">
                                                        <label for=""dataPublicacao>Data da Publicação</label>
                                                        <input name="data_linkedin" type="text" value="<?=$revisao->data_linkedin;?>" disabled="disabled" style="background-color: transparent" class="datepicker form-control" data-date-format="dd/mm/yyyy">
                                                    </div>
                                                    <div class="col-lg-4 col-md-4">
                                                        <?php
                                                        echo $this->Form->input('hora_linkedin', array(
                                                            'label' => 'Hora da Publicação',
                                                            'class' => 'horaPublicacao form-control',
                                                            'value' => $revisao->hora_linkedin,
                                                            'disabled' => 'disabled',
                                                            'style' => 'background-color: transparent'
                                                        ));
                                                        ?>
                                                    </div>
                                                    <div class="col-lg-7 col-md-7">
                                                        <?php
                                                        echo $this->Form->input('hashtag_linkedin', array(
                                                            'label' => 'Hashtag (Separadas por vírgula, sem #)',
                                                            'type' => 'text',
                                                            'class' => 'form-control',
                                                            'value' => $revisao->hashtag_linkedin,
                                                            'disabled' => 'disabled',
                                                            'style' => 'background-color: transparent'
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="row">                                                        
                                                    <div class="col-lg-16 col-md-16">
                                                        <?php
                                                        if ($revisao->imagem_linkedin != "") {
                                                            echo "<img src='" . DS . 'files' . DS . $revisao->imagem_linkedin . "' width='200'>";
                                                        }
                                                        ?>
                                                    </div>                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Twitter-->

                            <div class="card">
                                <div class="card-header" role="tab" id="headingThree">
                                    <p class="mb-0"> <a class="collapsed text-white" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> <i class="fa fa-twitter fa-lg mr-2"></i> Twitter </a> </p>
                                </div>
                                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false">
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8">
                                                <?php
                                                echo $this->Form->input('revisao_twitter', array(
                                                    'label' => 'Conteúdo',
                                                    'class' => 'col-lg-16 col-md-16 contador form-control',
                                                    'div' => false,
                                                    'rel' => '140_twitter',
                                                    'type' => 'textarea',
                                                    'value' => $revisao->revisao_twitter,
                                                    'disabled' => 'disabled',
                                                    'style' => 'background-color: transparent'
                                                ));
                                                ?>
                                                <div id="_twitter" class="divContador"></div>
                                            </div>

                                            <div class="col-lg-8 col-md-8">
                                                <div class="row">
                                                    <div class="col-lg-5 col-md-5">
                                                        <label for=""dataPublicacao>Data da Publicação</label>
                                                        <input name="data_twitter" type="text" value="<?=$revisao->data_twitter;?>" disabled="disabled" style="background-color: transparent" class="datepicker form-control" data-date-format="dd/mm/yyyy">
                                                    </div>
                                                    <div class="col-lg-4 col-md-4">
                                                        <?php
                                                        echo $this->Form->input('hora_twitter', array(
                                                            'label' => 'Hora da Publicação',
                                                            'class' => 'horaPublicacao form-control',
                                                            'value' => $revisao->hora_twitter,
                                                            'disabled' => 'disabled',
                                                            'style' => 'background-color: transparent'
                                                        ));
                                                        ?>
                                                    </div>
                                                    <div class="col-lg-7 col-md-7">
                                                        <?php
                                                        echo $this->Form->input('hashtag_twitter', array(
                                                            'label' => 'Hashtag (Separadas por vírgula, sem #)',
                                                            'type' => 'text',
                                                            'class' => 'form-control',
                                                            'value' => $revisao->hashtag_twitter,
                                                            'disabled' => 'disabled',
                                                            'style' => 'background-color: transparent'
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="row">                                                        
                                                    <div class="col-lg-16 col-md-16">
                                                        <?php
                                                        if ($revisao->imagem_twitter != "") {
                                                            echo "<img src='" . DS . 'files' . DS . $revisao->imagem_twitter . "' width='200'>";
                                                        }
                                                        ?>
                                                    </div>                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Google-->

                            <div class="card">
                                <div class="card-header" role="tab" id="headingFour">
                                    <p class="mb-0"> <a class="collapsed text-white" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> <i class="fa fa-google-plus fa-lg mr-2"></i> Google + </a> </p>
                                </div>
                                <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" aria-expanded="false">
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8">
                                                <?php
                                                echo $this->Form->input('revisao_google', array(
                                                    'label' => 'Conteúdo',
                                                    'class' => 'col-lg-16 col-md-16 form-control',
                                                    'div' => false,
                                                    'type' => 'textarea',
                                                    'value' => $revisao->revisao_google,
                                                    'disabled' => 'disabled',
                                                    'style' => 'background-color: transparent'
                                                ));
                                                ?>
                                            </div>

                                            <div class="col-lg-8 col-md-8">
                                                <div class="row">
                                                    <div class="col-lg-5 col-md-5">
                                                        <label for=""dataPublicacao>Data da Publicação</label>
                                                        <input name="data_google" type="text" value="<?=$revisao->data_google;?>" disabled="disabled" style="background-color: transparent" class="datepicker form-control" data-date-format="dd/mm/yyyy">
                                                    </div>
                                                    <div class="col-lg-4 col-md-4">
                                                        <?php
                                                        echo $this->Form->input('hora_google', array(
                                                            'label' => 'Hora da Publicação',
                                                            'class' => 'horaPublicacao form-control',
                                                            'value' => $revisao->hora_google,
                                                            'disabled' => 'disabled',
                                                            'style' => 'background-color: transparent'
                                                        ));
                                                        ?>
                                                    </div>
                                                    <div class="col-lg-7 col-md-7">
                                                        <?php
                                                        echo $this->Form->input('hashtag_google', array(
                                                            'label' => 'Hashtag (Separadas por vírgula, sem #)',
                                                            'type' => 'text',
                                                            'class' => 'form-control',
                                                            'value' => $revisao->hashtag_google,
                                                            'disabled' => 'disabled',
                                                            'style' => 'background-color: transparent'
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="row">                                                        
                                                    <div class="col-lg-16 col-md-16">
                                                        <?php
                                                        if ($revisao->imagem_google != "") {
                                                            echo "<img src='" . DS . 'files' . DS . $revisao->imagem_google . "' width='200'>";
                                                        }
                                                        ?>
                                                    </div>                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Instagram -->

                            <div class="card">
                                <div class="card-header" role="tab" id="headingFive">
                                    <p class="mb-0"> <a class="collapsed text-white" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive"> <i class="fa fa-instagram fa-lg mr-2"></i> Instagram </a> </p>
                                </div>
                                <div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive" aria-expanded="false">
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8">
                                                <?php
                                                echo $this->Form->input('revisao_instagram', array(
                                                    'label' => 'Conteúdo',
                                                    'class' => 'col-lg-16 col-md-16 contador form-control',
                                                    'div' => false,
                                                    'rel' => '2000_instagram',
                                                    'type' => 'textarea',
                                                    'value' => $revisao->revisao_instagram,
                                                    'disabled' => 'disabled',
                                                    'style' => 'background-color: transparent'
                                                ));
                                                ?>
                                                <div id="_instagram" class="divContador"></div>
                                            </div>

                                            <div class="col-lg-8 col-md-8">
                                                <div class="row">
                                                    <div class="col-lg-5 col-md-5">
                                                        <label for=""dataPublicacao>Data da Publicação</label>
                                                        <input name="data_instagram" type="text" value="<?=$revisao->data_instagram;?>" disabled="disabled" style="background-color: transparent" class="datepicker form-control" data-date-format="dd/mm/yyyy">
                                                    </div>
                                                    <div class="col-lg-4 col-md-4">
                                                        <?php
                                                        echo $this->Form->input('hora_instagram', array(
                                                            'label' => 'Hora da Publicação',
                                                            'class' => 'horaPublicacao form-control',
                                                            'value' => $revisao->hora_instagram,
                                                            'disabled' => 'disabled',
                                                            'style' => 'background-color: transparent'
                                                        ));
                                                        ?>
                                                    </div>
                                                    <div class="col-lg-7 col-md-7">
                                                        <?php
                                                        echo $this->Form->input('hashtag_instagram', array(
                                                            'label' => 'Hashtag (Separadas por vírgula, sem #)',
                                                            'type' => 'text',
                                                            'class' => 'form-control',
                                                            'value' => $revisao->hashtag_instagram,
                                                            'disabled' => 'disabled',
                                                            'style' => 'background-color: transparent'
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="row">                                                        
                                                    <div class="col-lg-16 col-md-16">
                                                        <?php
                                                        if ($revisao->imagem_instagram != "") {
                                                            echo "<img src='" . DS . 'files' . DS . $revisao->imagem_instagram . "' width='200'>";
                                                        }
                                                        ?>
                                                    </div>                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-16 col-lg-5">
            <br>
            <div>
                <?php
                echo $this->Html->link(__('Editar mídia'), ['action' => 'edit', $social->id], ['class' => 'btn btn-lg btn-secondary col-sm-16 col-lg-16']);
                echo "<br><br>";
                if ($social->status == "Rascunho") {
                    echo $this->Html->link(__('Enviar para revisão'), ['action' => 'revisao', $social->id], ['class' => 'btn btn-lg btn-primary col-sm-16 col-lg-16']);
                } else if ($social->status == "Revisão") {
                    echo $this->Html->link(__('Aprovar revisão'), ['action' => 'aprovar_revisao', $social->id], ['class' => 'btn btn-lg btn-primary col-sm-16 col-lg-16']);
                    echo "<br><br>";
                    echo $this->Html->link(__('Reprovar revisão'), ['action' => 'reprovar_revisao', $social->id], ['class' => 'btn btn-lg btn-danger col-sm-16 col-lg-16']);
                } else if ($social->status == "Aprovação") {
                    echo $this->Html->link(__('Aprovar e agendar publicação'), ['action' => 'aprovar', $social->id], ['class' => 'btn btn-lg btn-primary col-sm-16 col-lg-16']);
                    echo "<br><br>";
                    echo $this->Html->link(__('Reprovar'), ['action' => 'reprovar', $social->id], ['class' => 'btn btn-lg btn-danger col-sm-16 col-lg-16']);
                } else {
                    echo $this->Html->link(__('Publicar agora'), ['controller' => 'sociais'], ['class' => 'btn btn-lg btn-primary col-sm-16 col-lg-16']);
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
                                <a class="dropdown-item" href="javascrip:void(0)" data-toggle="modal" data-target="#mensagem_social">Adicionar</a>
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
