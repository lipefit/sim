<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-paperclip"></i> <?= __('Anexos') ?></h3>
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
                    <h6 class="card-title"><?= __('Novo anexo') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($anexo,['type' => 'file']) ?>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group">
                                <label for="titulo">Título </label>
                                <?= $this->Form->control('titulo', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Título']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group">
                                <label for="obs">Observações </label>
                                <?= $this->Form->control('obs', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Observações']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group">
                                <label for="anexo">Anexo </label>
                                <?= $this->Form->control('file', ['label' => false, 'class' => 'form-control', 'type' => 'file']); ?>
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