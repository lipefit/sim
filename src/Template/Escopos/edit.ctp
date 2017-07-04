<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><?= __('Serviço') ?></h3>
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
                    <h6 class="card-title"><?= __('Editar serviço') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($escopo) ?>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="servico">Serviço </label>
                                <?= $this->Form->control('servico', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Serviço (Ex. Facebook)']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="quantidade">Quantidade</label>
                                <?= $this->Form->control('quantidade', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Quantidade']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="frequencia">Frequência </label>
                                <?= $this->Form->control('frequencia', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Frequência','options'=>$frequencias]); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <?= $this->Form->control('descricao', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Descrição']); ?>
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