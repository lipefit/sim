<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-building"></i> <?= __('Cliente') ?></h3>
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
                    <h6 class="card-title"><?= __('Novo cliente') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($cliente) ?>
                    <div class="form-group">
                        <label for="nomeFantasia">Nome Fantasia</label>
                        <?= $this->Form->control('nomeFantasia',['label'=>false, 'class'=>'form-control','placeholder'=>'Nome Fantasia']); ?>
                    </div>
                    <div class="form-group">
                        <label for="razaoSocial">Razão Social</label>
                        <?= $this->Form->control('razaoSocial',['label'=>false, 'class'=>'form-control','placeholder'=>'Razão Social']); ?>
                    </div>
                    <div class="form-group">
                        <label for="sobre">Sobre a empresa</label>
                        <?= $this->Form->control('sobre',['label'=>false, 'class'=>'form-control','placeholder'=>'Sobre a empresa']); ?>
                    </div>
                    <div class="form-group">
                        <label for="especialidade">Especialidade</label>
                        <?= $this->Form->control('especialidade',['label'=>false, 'class'=>'form-control','placeholder'=>'Especialidade']); ?>
                    </div>
                    <div class="form-group">
                        <label for="site">Site</label>
                        <?= $this->Form->control('site',['label'=>false, 'class'=>'form-control','placeholder'=>'Site']); ?>
                    </div>
                    <div class="form-group">
                        <label for="blog">Blog</label>
                        <?= $this->Form->control('blog',['label'=>false, 'class'=>'form-control','placeholder'=>'Blog', 'type'=>'text']); ?>
                    </div>
                    <center><?= $this->Form->button(__('Salvar'), ['class' => 'btn btn-primary']) ?></center>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
