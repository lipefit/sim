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
                        <div class="col-sm-14 col-md-14">
                            <label for="principalObjetivo"><h3>Insira quais são os seus principais objetivos de négocio hoje</h3></label>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <a href="javascript:void(0);" class="btn btn-info" id="copiarPrincipalObjetivo"><i class="fa fa-plus"></i> Add</a>
                        </div>
                    </div>
                    <div class="basePrincipalObjetivo">
                        <div class="row clonePrincipalObjetivo">
                            <div class="col-sm-14 col-md-14">
                                <div class="form-group">
                                    <?= $this->Form->control('principalObjetivo[]', ['label' => false, 'class' => 'form-control']); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (count($pos) > 0) {
                            foreach ($pos as $po) {
                                ?>
                                <div class = "row">
                                    <div class = "col-sm-14 col-md-14">
                                        <div class = "form-group">
                                            <?= $this->Form->control('principalObjetivo[]', ['label' => false, 'class' => 'form-control', 'value' => $po->conteudo]); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-md-2">
                                        <a href="javascript:void(0);" class="btn btn-danger deletarPrincipalObjetivo">Deletar</a> 
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class = "row">
                                <div class = "col-sm-14 col-md-14">
                                    <div class = "form-group">
                                        <?= $this->Form->control('principalObjetivo[]', ['label' => false, 'class' => 'form-control']);?>                                        
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-14 col-md-14">
                            <label for="maiorObjetivo"><h3>Quais os seus maiores objetivos com o marketing digital hoje?</h3></label>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <a href="javascript:void(0);" class="btn btn-info" id="copiarMaiorObjetivo"><i class="fa fa-plus"></i> Add</a>
                        </div>
                    </div>
                    <div class="baseMaiorObjetivo">
                        <div class="row cloneMaiorObjetivo">
                            <div class="col-sm-14 col-md-14">
                                <div class="form-group">
                                    <?= $this->Form->control('maiorObjetivo[]', ['label' => false, 'class' => 'form-control']); ?>
                                </div>
                            </div>                        
                        </div>
                        <?php
                        if (count($mos) > 0) {
                            foreach ($mos as $mo) {
                                ?>
                                <div class = "row">
                                    <div class = "col-sm-14 col-md-14">
                                        <div class = "form-group">
                                            <?= $this->Form->control('maiorObjetivo[]', ['label' => false, 'class' => 'form-control', 'value' => $mo->conteudo]); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-md-2">
                                        <a href="javascript:void(0);" class="btn btn-danger deletarMaiorObjetivo">Deletar</a> 
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class = "row">
                                <div class = "col-sm-14 col-md-14">
                                    <div class = "form-group">
                                        <?= $this->Form->control('maiorObjetivo[]', ['label' => false, 'class' => 'form-control']);?>                                        
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-14 col-md-14">
                            <label for="objetivo"><h3>Objetivo do contrato</h3></label>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <a href="javascript:void(0);" class="btn btn-info" id="copiarObjetivo"><i class="fa fa-plus"></i> Add</a>
                        </div>
                    </div>
                    <div class="baseObjetivo">
                        <div class="row cloneObjetivo">
                            <div class="col-sm-14 col-md-14">
                                <div class="form-group">
                                    <?= $this->Form->control('objetivo[]', ['label' => false, 'class' => 'form-control']); ?>
                                </div>
                            </div>                        
                        </div>
                        <?php
                        if (count($ocs) > 0) {
                            foreach ($ocs as $oc) {
                                ?>
                                <div class = "row">
                                    <div class = "col-sm-14 col-md-14">
                                        <div class = "form-group">
                                            <?= $this->Form->control('objetivo[]', ['label' => false, 'class' => 'form-control', 'value' => $oc->conteudo]); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-md-2">
                                        <a href="javascript:void(0);" class="btn btn-danger deletarObjetivo">Deletar</a> 
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class = "row">
                                <div class = "col-sm-14 col-md-14">
                                    <div class = "form-group">
                                        <?= $this->Form->control('objetivo[]', ['label' => false, 'class' => 'form-control']);?>                                        
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-14 col-md-14">
                            <label for="consideracoes"><h3>Considerações</h3></label>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <a href="javascript:void(0);" class="btn btn-info" id="copiarConsideracoes"><i class="fa fa-plus"></i> Add</a>
                        </div>
                    </div>
                    <div class="baseConsideracoes">
                        <div class="row cloneConsideracoes">
                            <div class="col-sm-14 col-md-14">
                                <div class="form-group">
                                    <?= $this->Form->control('consideracoes[]', ['label' => false, 'class' => 'form-control']); ?>
                                </div>
                            </div>                        
                        </div>
                        <?php
                        if (count($cs) > 0) {
                            foreach ($cs as $c) {
                                ?>
                                <div class = "row">
                                    <div class = "col-sm-14 col-md-14">
                                        <div class = "form-group">
                                            <?= $this->Form->control('consideracoes[]', ['label' => false, 'class' => 'form-control', 'value' => $c->conteudo]); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-md-2">
                                        <a href="javascript:void(0);" class="btn btn-danger deletarConsideracao">Deletar</a> 
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class = "row">
                                <div class = "col-sm-14 col-md-14">
                                    <div class = "form-group">
                                        <?= $this->Form->control('consideracoes[]', ['label' => false, 'class' => 'form-control']);?>                                        
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                    </div>
                </div>
                <center><?= $this->Form->button(__('Salvar'), ['class' => 'btn btn-primary']) ?></center>
                    <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#copiarPrincipalObjetivo").click(function () {
            var _html = $(".clonePrincipalObjetivo").clone().removeClass("clonePrincipalObjetivo").appendTo(".basePrincipalObjetivo");
        });
        
        $("#copiarMaiorObjetivo").click(function () {
            var _html = $(".cloneMaiorObjetivo").clone().removeClass("cloneMaiorObjetivo").appendTo(".baseMaiorObjetivo");
        });
        
        $("#copiarObjetivo").click(function () {
            var _html = $(".cloneObjetivo").clone().removeClass("cloneObjetivo").appendTo(".baseObjetivo");
        });
        
        $("#copiarConsideracoes").click(function () {
            var _html = $(".cloneConsideracoes").clone().removeClass("cloneConsideracoes").appendTo(".baseConsideracoes");
        });
        
        $(".deletarPrincipalObjetivo").click(function(){
            $(this).parent().parent().remove();
        });
        
        $(".deletarMaiorObjetivo").click(function(){
            $(this).parent().parent().remove();
        });
        
        $(".deletarObjetivo").click(function(){
            $(this).parent().parent().remove();
        });
        
        $(".deletarConsideracao").click(function(){
            $(this).parent().parent().remove();
        });
    });
</script>
<style>
    .clonePrincipalObjetivo{display:none;}
    .cloneMaiorObjetivo{display:none;}
    .cloneObjetivo{display:none;}
    .cloneConsideracoes{display:none;}
</style>