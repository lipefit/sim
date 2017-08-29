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
                    <h6 class="card-title"><?= __('Nova mídia social') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($social) ?>
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="persona">Persona </label>
                                <?= $this->Form->control('persona_id', ['id' => 'persona', 'label' => false, 'class' => 'form-control', 'options' => $personas, 'empty' => '---']); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="desafio">Desafio </label>
                                <?= $this->Form->control('desafio_id', ['id' => 'desafio', 'label' => false, 'class' => 'form-control', 'placeholder' => 'Desafio', 'disabled' => 'disabled', 'empty' => '---']); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="dataPublicacao">Data da publicação </label>
                                <?= $this->Form->control('dataPublicacao', ['label' => false, 'class' => 'form-control datepicker', 'type' => 'text']); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="horaPublicacao">Hora da publicação </label>
                                <?= $this->Form->control('horaPublicacao', ['label' => false, 'class' => 'form-control hora']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="jornada">Jornada </label>
                                <?= $this->Form->control('jornada', ['label' => false, 'class' => 'form-control', 'options' => $jornadas, 'empty' => '---']); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="titulo">Título do blog </label>
                                <?= $this->Form->control('titulo_id', ['label' => false, 'class' => 'form-control', 'options' => $titulos, 'empty' => '---']); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="tema">Tema do post </label>
                                <?= $this->Form->control('tema', ['label' => false, 'class' => 'form-control', 'options' => $temas, 'empty' => '---']); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="cta">CTA (Call to action) </label>
                                <?= $this->Form->control('cta', ['label' => false, 'class' => 'form-control cta', 'placeholder' => 'Call to action']); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group">
                                <label for="observacoes">Observações </label>
                                <?= $this->Form->control('observacoes', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Observações']); ?>
                            </div>
                        </div>
                    </div>
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
    });
</script>
