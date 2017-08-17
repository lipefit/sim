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
        <div class="col-sm-16 col-md-16">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title"><?= __('Novo conteúdo') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($conteudo) ?>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group">
                                <label for="titulo">Título </label>
                                <?= $this->Form->control('pauta_id', ['label' => false, 'value' => $pauta->id, 'type' => 'hidden']); ?>
                                <?= $this->Form->control('titulo', ['label' => false, 'class' => 'form-control', 'disabled' => 'disabled', 'style' => 'background:#252d47', 'value' => $pauta->titulo]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="form-group">
                                <label for="persona">Persona </label>
                                <?= $this->Form->control('persona_id', ['id' => 'persona', 'label' => false, 'class' => 'form-control', 'options' => $personas, 'disabled' => 'disabled', 'style' => 'background:#252d47', 'value' => $pauta->persona_id]); ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="desafio">Desafio </label>
                                <?= $this->Form->control('desafio_id', ['id' => 'desafio', 'label' => false, 'class' => 'form-control', 'placeholder' => 'Desafio', 'disabled' => 'disabled', 'style' => 'background:#252d47', 'value' => $pauta->desafio_id]); ?>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5">
                            <div class="form-group">
                                <label for="jornada">Jornada </label>
                                <?= $this->Form->control('jornada', ['label' => false, 'class' => 'form-control', 'options' => $jornadas, 'disabled' => 'disabled', 'style' => 'background:#252d47', 'value' => $pauta->jornada]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="form-group">
                                <label for="tipo">Tipo de Conteúdo </label>
                                <?= $this->Form->control('tipo', ['label' => false, 'class' => 'form-control', 'options' => $tipos, 'disabled' => 'disabled', 'style' => 'background:#252d47', 'value' => $pauta->tipo]); ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="dataPublicacao">Data da publicação </label>
                                <?= $this->Form->control('dataPublicacao', ['label' => false, 'class' => 'form-control datepicker', 'type' => 'text', 'value' => $pauta->dataPublicacao]); ?>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5">
                            <div class="form-group">
                                <label for="horaPublicacao">Hora da publicação </label>
                                <?= $this->Form->control('horaPublicacao', ['label' => false, 'class' => 'form-control hora', 'value' => $pauta->horaPublicacao]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group">
                                <label for="palavras">Palavras-chave (separadas por vírgula)</label>
                                <?= $this->Form->control('palavras', ['id' => 'tags', 'label' => false, 'class' => 'form-control', 'placeholder' => 'Palavras-chave', 'value' => $pauta->palavras]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group">
                                <label for="consideracoes">Considerações </label>
                                <?= $this->Form->control('consideracoes', ['label' => false, 'class' => 'form-control', 'disabled' => 'disabled', 'style' => 'background:#252d47', 'value' => $pauta->consideracoes]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="categorias">Categorias (Wordpress) </label>
                                <?= $this->Form->control('categorias[]', ['id' => 'categoria', 'label' => false, 'class' => 'form-control', 'options' => @$categorias, 'multiple' => 'multiple', 'type' => 'select']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="tags">Tags (Wordpress)</label>
                                <?= $this->Form->control('tags[]', ['id' => 'tags', 'label' => false, 'class' => 'form-control', 'options' => @$tags, 'multiple' => 'multiple', 'type' => 'select']); ?>
                            </div>
                        </div>
                    </div>         
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group">
                                <label for="url">URL </label>
                                <?= $this->Form->control('url', ['id' => 'url', 'label' => false, 'class' => 'form-control', 'Placeholder' => 'URL']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group">
                                <label for="meta-description">Meta description </label>
                                <?= $this->Form->control('description', ['label' => false, 'class' => 'form-control', 'type' => 'textarea']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group">
                                <label for="conteudo">Conteúdo </label>
                                <?= $this->Form->control('content', ['label' => false, 'class' => 'form-control tinymce', 'type' => 'textarea']); ?>
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

    var slug = function (str) {
        var $slug = '';
        var trimmed = $.trim(str);
        $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
                replace(/-+/g, '-').
                replace(/^-|-$/g, '');
        return $slug.toLowerCase();
    }

    $(function () {
        $('#url').val('<?php echo $diagnostico->site; ?>/' + slug('<?php echo $pauta->titulo ?>'));
    });
</script>