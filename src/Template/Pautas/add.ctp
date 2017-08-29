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
        <div class="col-sm-16 col-md-16">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title"><?= __('Nova pauta de conteúdo') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($pauta) ?>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group">
                                <label for="titulo">Título </label>
                                <?= $this->Form->control('titulo', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Título da pauta']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="form-group">
                                <label for="persona">Persona </label>
                                <?= $this->Form->control('persona_id', ['id' => 'persona', 'label' => false, 'class' => 'form-control', 'options' => $personas, 'empty' => '---']); ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="desafio">Desafio </label>
                                <?= $this->Form->control('desafio_id', ['id' => 'desafio', 'label' => false, 'class' => 'form-control', 'placeholder' => 'Desafio', 'disabled' => 'disabled', 'empty' => '---']); ?>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5">
                            <div class="form-group">
                                <label for="jornada">Jornada </label>
                                <?= $this->Form->control('jornada', ['label' => false, 'class' => 'form-control', 'options' => $jornadas, 'empty' => '---']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="form-group">
                                <label for="tipo">Tipo de Conteúdo </label>
                                <?= $this->Form->control('tipo', ['label' => false, 'class' => 'form-control', 'options' => $tipos, 'empty' => '---']); ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="dataPublicacao">Data da publicação </label>
                                <?= $this->Form->control('dataPublicacao', ['label' => false, 'class' => 'form-control datepicker', 'type' => 'text']); ?>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5">
                            <div class="form-group">
                                <label for="horaPublicacao">Hora da publicação </label>
                                <?= $this->Form->control('horaPublicacao', ['label' => false, 'class' => 'form-control hora']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group">
                                <label for="palavras">Palavras-chave (separadas por vírgula)</label>
                                <?= $this->Form->control('palavras', ['id' => 'tags', 'label' => false, 'class' => 'form-control', 'placeholder' => 'Palavras-chave']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group">
                                <label for="consideracoes">Considerações </label>
                                <?= $this->Form->control('consideracoes', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Considerações']); ?>
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
<?= $this->element('Modal/pauta'); ?>
<?php
$p = "";
foreach (@$palavraschave as $palavra) {
    $p .= "'" . $palavra->palavra . "',";
}
?>
<script>
    $(function () {
        var availableTags = [
            <?= $p; ?>
        ];
        function split(val) {
            return val.split(/,\s*/);
        }
        function extractLast(term) {
            return split(term).pop();
        }

        $("#tags")
        // don't navigate away from the field on tab when selecting an item
        .on("keydown", function (event) {
            if (event.keyCode === $.ui.keyCode.TAB &&
                    $(this).autocomplete("instance").menu.active) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 0,
            source: function (request, response) {
                // delegate back to autocomplete, but extract the last term
                response($.ui.autocomplete.filter(
                        availableTags, extractLast(request.term)));
            },
            focus: function () {
                // prevent value inserted on focus
                return false;
            },
            select: function (event, ui) {
                var terms = split(this.value);
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push(ui.item.value);
                // add placeholder to get the comma-and-space at the end
                terms.push("");
                this.value = terms.join(", ");
                return false;
            }
        });
        
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
