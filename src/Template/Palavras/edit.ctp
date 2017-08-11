<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-key"></i> <?= __('Palavras-chave') ?></h3>
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
                    <h6 class="card-title"><?= __('Editar palavra-chave') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($palavra) ?>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="palavra">Palavra-chave </label>
                                <?= $this->Form->control('palavra', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Palavra-chave']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="produto">Produto/Serviço</label>
                                <?= $this->Form->control('produto', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Produto/Serviço']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="persona">Persona </label>
                                <?= $this->Form->control('persona_id', ['label' => false, 'class' => 'form-control', 'options' => $personas, 'empty' => '---']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="etapa">Etapa da jornada </label>
                                <?= $this->Form->control('etapa', ['label' => false, 'class' => 'form-control', 'options' => $jornadas, 'empty' => '---']); ?>
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