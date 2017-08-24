<?php
$clientList;
foreach ($_clientes as $cliente) {
    $clientList[$cliente['id']] = $cliente['nomeFantasia'];
}

/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
use Cake\Routing\Router
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-group"></i> <?= __('Persona da marca') ?></h3>
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
                    <h6 class="card-title"><?= __('Nova persona') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($persona) ?>
                    <div class="row">
                        <div class="col-sm-2 col-md-2">
                            <div class="avatar-changing">
                                <select name="avatar" class="image-picker form-control">
                                    <?php for ($i = 1; $i <= 20; $i++) { ?>
                                        <?php $c = ($i < 10) ? '0' . $i : $i; ?>
                                        <option data-img-src="<?php echo Router::url('/'); ?>avatar/<?php echo $c; ?>.jpg" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>

                                <a class="btn btn-info" id="avatar-menos" href="javascript:;"><span class="fa fa-arrow-left"></span></a>
                                <a class="btn btn-info" id="avatar-mais" href="javascript:;"><span class="fa fa-arrow-right"></span></a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="nome">Persona da Marca</label>
                                <?= $this->Form->control('nome', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Nome da persona','value'=>$clientList[$cliente_id_cookie]]); ?>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="idade">Idade</label>
                                <?= $this->Form->control('idade', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Idade', 'type' => 'text']); ?>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="sexo">Sexo</label>
                                <?= $this->Form->control('sexo', ['label' => false, 'class' => 'form-control', 'options' => $sexos]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 col-md-8">
                            <div class="form-group">
                                <label for="graduacao">Graduação</label>
                                <?= $this->Form->control('graduacao', ['label' => false, 'class' => 'form-control', 'options' => $graduacoes]); ?>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <div class="form-group">
                                <label for="cargo">Cargo</label>
                                <?= $this->Form->control('cargo', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Cargo']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 col-md-8">
                            <div class="form-group">
                                <label for="segmento">Segmento</label>
                                <?= $this->Form->control('segmento', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Segmento']); ?>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <div class="form-group">
                                <label for="arqueotipo">Arquétipo</label>
                                <?= $this->Form->control('arqueotipo', ['label' => false, 'class' => 'form-control', 'options' => $arqueotipos]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 col-md-8">
                            <div class="form-group">
                                <label for="background">Background</label>
                                <?= $this->Form->control('background', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Background']); ?>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <div class="form-group">
                                <label for="slogam">Slogan</label>
                                <?= $this->Form->control('slogam', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Slogan', 'type' => 'text']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 col-md-8">
                            <div class="form-group">
                                <label for="estilo">Estilo de vida</label>
                                <?= $this->Form->control('estilo', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Estilo de vida', 'type' => 'text']); ?>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <div class="form-group">
                                <label for="sonho">Sonho</label>
                                <?= $this->Form->control('sonho', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Sonho', 'type' => 'text']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 col-md-8">
                            <div class="form-group">
                                <label for="interesse">Interesse</label>
                                <?= $this->Form->control('interesse', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Interesse', 'type' => 'text']); ?>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <div class="form-group">
                                <label for="caracteristicas">Caracteristicas</label>
                                <?= $this->Form->control('caracteristicas', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Comportamentais, Psicográficas, Demográficas e Geograficas']); ?>
                            </div>
                        </div>
                    </div>
<!--                    <div class="row">
                        <div class="col-sm-8 col-md-8">
                            <div class="form-group">
                                <label for="objetivos">Objetivos</label>
                                <?= $this->Form->control('objetivos', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Objetivos']); ?>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <div class="form-group">
                                <label for="solucao">Solução</label>
                                <?= $this->Form->control('solucao', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Solução']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-16 col-md-16">
                            <div class="form-group">
                                <label for="palavras">Palavras-chave (Separadas por virgulas)</label>
                                <?= $this->Form->control('palavras', ['label' => false, 'class' => 'form-control', 'type' => 'text']); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title"><?= __('Adicionar desafios') ?></h6>
                            </div>
                        </div>
                    </div>

                    <div class="base">
                        <div class="row clone">
                            <div class="col-sm-16 col-md-16">
                                <div class="form-group">
                                    <?= $this->Form->control('desafios[]', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Desafio']); ?>
                                </div>
                            </div>                        
                        </div>
                        <div class="row">
                            <div class="col-sm-16 col-md-16">
                                <div class="form-group">
                                    <?= $this->Form->control('desafios[]', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Desafio']); ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <a href="javascript:void(0);" class="btn btn-info" id="copiarDesafio"><i class="fa fa-plus"></i> Adicionar desafio</a>
                        </div>
                    </div>-->
                    <center><?= $this->Form->button(__('Salvar'), ['class' => 'btn btn-primary']) ?></center>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Html->script('/js/img_picker/image-picker.js'); ?>
<?= $this->Html->css('/js/img_picker/image-picker.css'); ?>
<script>
    var atual_avatar = 0;
    $(document).ready(function () {
        $(".image-picker").imagepicker();
        atual_avatar = $(".image-picker").val();

        $('#avatar-mais').click(function () {

            if (atual_avatar != 20) {
                atual_avatar++;
            }

            $('.image-picker').val(atual_avatar).change();
        });

        $('#avatar-menos').click(function () {
            if (atual_avatar != 1) {
                atual_avatar--;
            }
            $('.image-picker').val(atual_avatar).change();
        });

        $("#copiarDesafio").click(function () {
            var _html = $(".clone").clone().removeClass("clone").appendTo(".base");
        });
    });
</script>
<style>
    .clone{display:none;}
</style>
