<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-sun-o"></i> <?= __('Objetivo') ?></h3>
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
                    <h6 class="card-title"><?= __('Editar objetivo') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($objetivo) ?>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="checklist1">Quais são seus dois maiores objetivos de negócio hoje?</label>
                                <?= $this->Form->control('checklist1', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Quais são seus dois maiores objetivos de negócio hoje?']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="checklist2">Quais o seu maior objetivo com o marketing digital hoje?</label>
                                <?= $this->Form->control('checklist2', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Quais o seu maior objetivo com o marketing digital hoje?']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="objetivo">Objetivo do contrato </label>
                                <?= $this->Form->control('objetivo', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Objetivo do contrato']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="consideracoes">Considerações</label>
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
