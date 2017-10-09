<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-tasks"></i> <?= __('Funil de vendas') ?></h3>
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
                    <h6 class="card-title"><?= __('Funil de vendas') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create("", ['url' => ['action' => 'index', 'controller' => 'funil']]) ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="persona">Persona </label>
                                <?= $this->Form->control('persona', ['label' => false, 'class' => 'form-control', 'options' => $personas]); ?>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5">
                            <div class="form-group">
                                <label for="desafio">Desafio </label>
                                <?= $this->Form->control('desafio', ['label' => false, 'class' => 'form-control', 'disabled' => true, 'type' => 'select', 'style' => 'background-color:transparent;']); ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="jornada">Jornada </label>
                                <?= $this->Form->control('jornada', ['label' => false, 'class' => 'form-control', 'options' => $jornadas]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="dataPublicacao">Data de publicação inicial </label>
                                <?= $this->Form->control('dataInicial', ['label' => false, 'class' => 'datepicker form-control', 'data-date-format' => "dd/mm/yyyy"]); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="dataPublicacao">Data de publicação final </label>
                                <?= $this->Form->control('dataFinal', ['label' => false, 'class' => 'datepicker form-control', 'data-date-format' => "dd/mm/yyyy"]); ?>
                            </div>
                        </div>
                    </div>
                    <center><?= $this->Form->button(__('Gerar funil'), ['class' => 'btn btn-primary']) ?></center>
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

            $.get('funil/selecionaDesafio?id=' + PersonaId, function (data) {
                $('#desafio').removeAttr('disabled');
                $('#desafio').find('option').remove().end().append('<option value="">---</option>');

                for (var i = 0; i < data.length; i++) {
                    $('#desafio').append('<option value="' + data[i].id + '">' + data[i].desafio + '</option>')
                }
            });
        });
    });
</script>