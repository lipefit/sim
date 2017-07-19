<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-eye"></i> <?= __('Concorrentes') ?></h3>
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
                    <h6 class="card-title"><?= __('Editar concorrente') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($concorrente) ?>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="concorrente">Concorrente</label>
                                <?= $this->Form->control('name', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Concorrente']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="url">Url</label>
                                <?= $this->Form->control('url', ['label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'URL']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="produtoServico">Produto / Serviço</label>
                                <?= $this->Form->control('produto', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Produto / Serviço']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <?= $this->Form->control('tipo', ['label' => false, 'class' => 'form-control', 'options' => $tipos, 'placeholder' => 'Tipo']); ?>
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