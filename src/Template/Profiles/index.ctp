<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><?= __('Perfil') ?></h3>
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
                    <h6 class="card-title"><?= __('Editar perfil') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($profile) ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <?= $this->Form->control('name', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Nome']); ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="sobrenome">Sobrenome</label>
                                <?= $this->Form->control('surname', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Sobrenome']); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <?= $this->Form->control('telefone', ['label' => false, 'class' => 'form-control tel', 'placeholder' => 'Telefone']); ?>
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
$(function($){
   $(".tel").mask("(99)9999-9999?9");
});
</script>