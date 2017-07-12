<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><?= __('Identidade visual') ?></h3>
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
                    <h6 class="card-title"><?= __('Editar identidade') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($identidade,['type' => 'file']) ?>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="nome">Nome do arquivo </label>
                                <?= $this->Form->control('nome', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Nome do Arquivo']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="tipografia">Tipografia</label>
                                <?= $this->Form->control('tipografia', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Tipografia', 'type' => 'text']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="estilo">Estilo </label>
                                <?= $this->Form->control('estilo', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Estilo', 'type' => 'text']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="formas">Formas</label>
                                <?= $this->Form->control('formas', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Formas', 'type' => 'text']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="restricoes">Restrições </label>
                                <?= $this->Form->control('restricoes', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Restrições', 'type' => 'text']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="arquivo">Arquivo </label>
                                <?= $this->Form->control('file', ['label' => false, 'class' => 'form-control', 'type' => 'file']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8"></div>
                        <div class="col-lg-8 col-md-8" style="text-align: right;">
                            <?php
                                if($identidade['arquivo'] != ""){
                                    echo "<a class='btn btn-info' href='".WWW_ROOT."files". DS .$identidade['arquivo']."' target='_blank'>Baixar Arquivo!</a>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="fontes">Fontes </label>
                                <?= $this->Form->control('fontes', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Fontes', 'type' => 'text']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="cor">Cor </label>
                                <?= $this->Form->control('cor', ['label' => false, 'class' => 'form-control', 'type' => 'color']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="descricao">Descrição </label>
                                <?= $this->Form->control('descricao', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Descrições']); ?>
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
