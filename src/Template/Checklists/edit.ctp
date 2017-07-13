<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-check-square-o"></i> <?= __('Check list') ?></h3>
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
                    <h6 class="card-title"><?= __('Editar check list') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($checklist) ?>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="nome">Nome </label>
                                <?= $this->Form->control('nome', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Nome']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <?= $this->Form->control('descricao', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Descrição']); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-16">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"><?= __('Perguntas') ?></h5>
                                </div>
                                <div class="card-block">
                                    <table class="table" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>Id </th>
                                                <th>Categoria</th>
                                                <th>Pergunta</th> 
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($perguntas as $pergunta): ?>
                                                <tr>
                                                    <td><?= $this->Number->format($pergunta->id) ?></td>
                                                    <td><?= h($pergunta->categoria) ?></td>
                                                    <td><?= h($pergunta->pergunta) ?></td>
                                                    <td class="center">
                                                        <?= $this->Form->postLink(__('Apagar'), ['action' => 'deletePerguntas', $pergunta->id], ['class' => 'btn btn-danger'], ['confirm' => __('Você tem certeza que deseja apagar a pergunta # {0}?', $pergunta->pergunta)]) ?>  	
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <!-- /.table-responsive --> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title"><?= __('Adicionar perguntas') ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="base">
                        <div class="row clone">
                            <div class="col-lg-8 col-md-8">
                                <div class="form-group">
                                    <label for="categoria">Categoria</label>
                                    <?= $this->Form->control('categorias[]', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Categoria']); ?>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <div class="form-group">
                                    <label for="pergunta">Pergunta</label>
                                    <?= $this->Form->control('perguntas[]', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Pergunta']); ?>
                                </div>
                            </div>                        
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-8">
                                <div class="form-group">
                                    <label for="categoria">Categoria</label>
                                    <?= $this->Form->control('categorias[]', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Categoria']); ?>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <div class="form-group">
                                    <label for="pergunta">Pergunta</label>
                                    <?= $this->Form->control('perguntas[]', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Pergunta']); ?>
                                </div>
                            </div>                        
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <a href="javascript:void(0);" class="btn btn-info" id="copiarPergunta"><i class="fa fa-plus"></i> Adicionar pergunta</a>
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
    $(document).ready(function () {
        $("#copiarPergunta").click(function () {
            var _html = $(".clone").clone().removeClass("clone").appendTo(".base");
        });
    });
</script>
<style>
    .clone{display:none;}
</style>
