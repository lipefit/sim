<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
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
        <div class="col-sm-16 col-md-16">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title"><?= __('Editar mídia social') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($social, ['type' => 'file']) ?>
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="persona">Persona </label>
                                <?= $this->Form->control('persona_id', ['id' => 'persona', 'label' => false, 'class' => 'form-control', 'options' => $personas, 'value' => $revisao->persona_id]); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="desafio">Desafio </label>
                                <?= $this->Form->control('desafio_id', ['id' => 'desafio', 'label' => false, 'class' => 'form-control', 'options' => $desafiospublicos, 'value' => $revisao->desafio_id]); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="dataPublicacao">Data da publicação </label>
                                <?= $this->Form->control('dataPublicacao', ['label' => false, 'class' => 'form-control datepicker', 'type' => 'text', 'value' => $revisao->dataPublicacao->format('d/m/Y')]); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="horaPublicacao">Hora da publicação </label>
                                <?= $this->Form->control('horaPublicacao', ['label' => false, 'class' => 'form-control hora', 'value' => $revisao->horaPublicacao]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="jornada">Jornada </label>
                                <?= $this->Form->control('jornada', ['label' => false, 'class' => 'form-control', 'options' => $jornadas, 'value' => $revisao->jornada]); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="titulo">Título do blog </label>
                                <?= $this->Form->control('titulo_id', ['label' => false, 'class' => 'form-control', 'options' => $titulos, 'value' => $revisao->titulo_id]); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="tema">Tema do post </label>
                                <?= $this->Form->control('tema', ['label' => false, 'class' => 'form-control', 'options' => $temas, 'value' => $revisao->tema]); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="cta">CTA (Call to action) </label>
                                <?= $this->Form->control('cta', ['label' => false, 'class' => 'form-control cta', 'placeholder' => 'Call to action', 'value' => $revisao->cta]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group">
                                <label for="observacoes">Observações </label>
                                <?= $this->Form->control('observacoes', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Observações', 'value' => $revisao->observacoes]); ?>
                            </div>
                        </div>
                    </div>

                    <hr>

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
                                                        'value' => $revisao->revisao_facebook
                                                    ));
                                                    ?>
                                                    <div id="_facebook" class="divContador"></div>
                                                </div>

                                                <div class="col-lg-8 col-md-8">
                                                    <div class="row">
                                                        <div class="col-lg-5 col-md-5">
                                                            <label for=""dataPublicacao>Data da Publicação</label>
                                                            <input name="data_facebook" type="text" value="<?= $revisao->data_facebook; ?>" class="datepicker form-control" data-date-format="dd/mm/yyyy">
                                                        </div>
                                                        <div class="col-lg-4 col-md-4">
                                                            <?php
                                                            echo $this->Form->input('hora_facebook', array(
                                                                'label' => 'Hora da Publicação',
                                                                'class' => 'horaPublicacao form-control',
                                                                'value' => $revisao->hora_facebook
                                                            ));
                                                            ?>
                                                        </div>
                                                        <div class="col-lg-7 col-md-7">
                                                            <?php
                                                            echo $this->Form->input('hashtag_facebook', array(
                                                                'label' => 'Hashtag (Separadas por vírgula, sem #)',
                                                                'type' => 'text',
                                                                'class' => 'form-control',
                                                                'value' => $revisao->hashtag_facebook
                                                            ));
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <div class="row">                                                        
                                                        <div class="col-lg-16 col-md-16">
                                                            <label for="arquivo">Upload de Imagem (1200 x 630 px) </label>
                                                            <?= $this->Form->control('imagem_facebook_upload', ['label' => false, 'class' => 'form-control', 'type' => 'file']); ?>
                                                            <?php
                                                            echo "<br />";
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
                                                        'value' => $revisao->revisao_linkedin
                                                    ));
                                                    ?>
                                                    <div id="_linkedin" class="divContador"></div>
                                                </div>

                                                <div class="col-lg-8 col-md-8">
                                                    <div class="row">
                                                        <div class="col-lg-5 col-md-5">
                                                            <label for=""dataPublicacao>Data da Publicação</label>
                                                            <input name="data_linkedin" type="text" value="<?= $revisao->data_linkedin; ?>" class="datepicker form-control" data-date-format="dd/mm/yyyy">
                                                        </div>
                                                        <div class="col-lg-4 col-md-4">
                                                            <?php
                                                            echo $this->Form->input('hora_linkedin', array(
                                                                'label' => 'Hora da Publicação',
                                                                'class' => 'horaPublicacao form-control',
                                                                'value' => $revisao->hora_linkedin
                                                            ));
                                                            ?>
                                                        </div>
                                                        <div class="col-lg-7 col-md-7">
                                                            <?php
                                                            echo $this->Form->input('hashtag_linkedin', array(
                                                                'label' => 'Hashtag (Separadas por vírgula, sem #)',
                                                                'type' => 'text',
                                                                'class' => 'form-control',
                                                                'value' => $revisao->hashtag_linkedin
                                                            ));
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <div class="row">                                                        
                                                        <div class="col-lg-16 col-md-16">
                                                            <label for="arquivo">Upload de Imagem (800 x 800 px) </label>
                                                            <?= $this->Form->control('imagem_linkedin_upload', ['label' => false, 'class' => 'form-control', 'type' => 'file']); ?>
                                                            <?php
                                                            echo "<br />";
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
                                                        'value' => $revisao->revisao_twitter
                                                    ));
                                                    ?>
                                                    <div id="_twitter" class="divContador"></div>
                                                </div>

                                                <div class="col-lg-8 col-md-8">
                                                    <div class="row">
                                                        <div class="col-lg-5 col-md-5">
                                                            <label for=""dataPublicacao>Data da Publicação</label>
                                                            <input name="data_twitter" type="text" value="<?= $revisao->data_twitter; ?>" class="datepicker form-control" data-date-format="dd/mm/yyyy">
                                                        </div>
                                                        <div class="col-lg-4 col-md-4">
                                                            <?php
                                                            echo $this->Form->input('hora_twitter', array(
                                                                'label' => 'Hora da Publicação',
                                                                'class' => 'horaPublicacao form-control',
                                                                'value' => $revisao->hora_twitter
                                                            ));
                                                            ?>
                                                        </div>
                                                        <div class="col-lg-7 col-md-7">
                                                            <?php
                                                            echo $this->Form->input('hashtag_twitter', array(
                                                                'label' => 'Hashtag (Separadas por vírgula, sem #)',
                                                                'type' => 'text',
                                                                'class' => 'form-control',
                                                                'value' => $revisao->hasgtag_twitter
                                                            ));
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <div class="row">                                                        
                                                        <div class="col-lg-16 col-md-16">
                                                            <label for="arquivo">Upload de Imagem (440 x 220 px) </label>
                                                            <?= $this->Form->control('imagem_twitter_upload', ['label' => false, 'class' => 'form-control', 'type' => 'file']); ?>
                                                            <?php
                                                            echo "<br />";
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
                                                        'value' => $revisao->revisao_google
                                                    ));
                                                    ?>
                                                </div>

                                                <div class="col-lg-8 col-md-8">
                                                    <div class="row">
                                                        <div class="col-lg-5 col-md-5">
                                                            <label for=""dataPublicacao>Data da Publicação</label>
                                                            <input name="data_google" type="text" value="<?= $revisao->data_google; ?>" class="datepicker form-control" data-date-format="dd/mm/yyyy">
                                                        </div>
                                                        <div class="col-lg-4 col-md-4">
                                                            <?php
                                                            echo $this->Form->input('hora_google', array(
                                                                'label' => 'Hora da Publicação',
                                                                'class' => 'horaPublicacao form-control',
                                                                'value' => $revisao->hora_google
                                                            ));
                                                            ?>
                                                        </div>
                                                        <div class="col-lg-7 col-md-7">
                                                            <?php
                                                            echo $this->Form->input('hashtag_google', array(
                                                                'label' => 'Hashtag (Separadas por vírgula, sem #)',
                                                                'type' => 'text',
                                                                'class' => 'form-control',
                                                                'value' => $revisao->hashtag_google
                                                            ));
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <div class="row">                                                        
                                                        <div class="col-lg-16 col-md-16">
                                                            <label for="arquivo">Upload de Imagem (497 x 373 px) </label>
                                                            <?= $this->Form->control('imagem_google_upload', ['label' => false, 'class' => 'form-control', 'type' => 'file']); ?>
                                                            <?php
                                                            echo "<br />";
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
                                                        'value' => $revisao->revisao_instagram
                                                    ));
                                                    ?>
                                                    <div id="_instagram" class="divContador"></div>
                                                </div>

                                                <div class="col-lg-8 col-md-8">
                                                    <div class="row">
                                                        <div class="col-lg-5 col-md-5">
                                                            <label for=""dataPublicacao>Data da Publicação</label>
                                                            <input name="data_instagram" type="text" value="<?= $revisao->data_instagram; ?>" class="datepicker form-control" data-date-format="dd/mm/yyyy">
                                                        </div>
                                                        <div class="col-lg-4 col-md-4">
                                                            <?php
                                                            echo $this->Form->input('hora_instagram', array(
                                                                'label' => 'Hora da Publicação',
                                                                'class' => 'horaPublicacao form-control',
                                                                'value' => $revisao->hora_instagram
                                                            ));
                                                            ?>
                                                        </div>
                                                        <div class="col-lg-7 col-md-7">
                                                            <?php
                                                            echo $this->Form->input('hashtag_instagram', array(
                                                                'label' => 'Hashtag (Separadas por vírgula, sem #)',
                                                                'type' => 'text',
                                                                'class' => 'form-control',
                                                                'value' => $revisao->hashtag_instagram
                                                            ));
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <div class="row">                                                        
                                                        <div class="col-lg-16 col-md-16">
                                                            <label for="arquivo">Upload de Imagem (1200 x 630 px) </label>
                                                            <?= $this->Form->control('imagem_instagram_upload', ['label' => false, 'class' => 'form-control', 'type' => 'file']); ?>
                                                            <?php
                                                            echo "<br />";
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

                    <hr>

                    <center><?= $this->Form->button(__('Salvar'), ['class' => 'btn btn-primary']) ?></center>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#persona').change(function () {
            $('#desafio').attr("disabled", "disable");

            $('#desafio').find('option').remove().end().append('<option>Carregando...</option>');

            var PersonaId = $("#persona option:selected").val();

            $.get('selecionaDesafio?id=' + PersonaId, function (data) {
                $('#desafio').removeAttr('disabled');
                $('#desafio').find('option').remove().end().append('<option value="">---</option>');

                for (var i = 0; i < data.length; i++) {
                    $('#desafio').append('<option value="' + data[i].id + '">' + data[i].desafio + '</option>')
                }
            });
        });

        $(".contador").keyup(function () {
            var rel = $(this).attr("rel");
            var splited = rel.split("_");
            var limite = splited[0];
            var tamanho = $(this).val().length;
            var restante = limite - tamanho;
            $("#_" + splited[1]).html(restante);
            if (restante < 0) {
                $("#_" + splited[1]).css("color", "#cc0000");
                $(this).css("color", "#cc0000");
            } else {
                $("#_" + splited[1]).css("color", "#656d78");
                $(this).css("color", "#656d78");
            }
        });

        $(".horaPublicacao").mask("99:99");
    });
</script>

<style>
    .divContador{
        float: right;
    }
</style>
