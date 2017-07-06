<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><?= __('Acessos') ?></h3>
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
                    <h6 class="card-title"><?= __('Editar acesso') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($acesso) ?>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="nome">Nome / Tipo </label>
                                <?= $this->Form->control('nome', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Nome / Tipo (Ex. Facebook)']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="url">Url / Host</label>
                                <?= $this->Form->control('url', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Url / Host']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="usuario">Usuário </label>
                                <?= $this->Form->control('usuario', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Usuário']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <?= $this->Form->control('senha', ['label' => false, 'class' => 'form-control', 'type' => 'password']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="outros">Outros </label>
                                <?= $this->Form->control('Outros', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Outros']); ?>
                            </div>
                        </div>
                    </div>
                    
                    <?= $this->Form->button(__('Salvar'), ['class' => 'btn btn-primary']) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>