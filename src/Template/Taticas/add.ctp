<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-external-link"></i> <?= __('Tática de conteúdo') ?></h3>
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
                    <h6 class="card-title"><?= __('Nova tática de conteúdo') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($tatica) ?>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="voz">Voz da marca</label>
                                <?= $this->Form->control('voz', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Voz da marca']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="tom">Tom da marca</label>
                                <?= $this->Form->control('tom_id', ['label' => false, 'class' => 'form-control', 'options' => $tons]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="storytelling">Storytelling</label>
                                <?= $this->Form->control('storytelling', ['label' => false, 'class' => 'form-control', 'options' => $storytellings]); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="curadoria">Curadoria</label>
                                <?= $this->Form->control('curadoria_id', ['label' => false, 'class' => 'form-control', 'options' => $curadorias]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="arquetipo">Arquétipo</label>
                                <?= $this->Form->control('arquetipo', ['label' => false, 'class' => 'form-control', 'options' => $arquetipos]); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="tipo">Tipo de conteúdo</label>
                                <?= $this->Form->control('tipo', ['label' => false, 'class' => 'form-control', 'options' => $tipos]); ?>
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