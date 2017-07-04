<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><?= __('Premissas') ?></h3>
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
                    <div class="row align-items-center justify-content-between">
                        <h6 class="card-title col-sm-12 col-md-12"><?= __('Responsabilidade da Agência') ?></h6>
                        <div class="btn-group pull-right">
                            <a href='<?= $this->request->webroot . 'premissas/add/Agência'; ?>' class="btn btn-success btn-round"><span class="text"><?= __('Atualizar') ?></span></a>
                        </div>
                    </div>
                </div>
                <?php                
                foreach ($premissasAgencia as $premissaAgencia){
                    echo "<div class='row'>";
                        echo "<div class='col-sm-16 col-md-16'>";
                            echo "<div class='card-block'>";
                                echo "<p><i>Alterado em: ".implode("/", array_reverse(explode("-",$premissaAgencia['date'])))." por: ".$premissaAgencia['user']['profile']['name']." ".$premissaAgencia['user']['profile']['surname']."</i></p>";
                                echo "<p>".$premissaAgencia['value']."</p>";
                            echo "</div>";    
                        echo "</div>";
                    echo "</div>";
                }
                ?>  
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-16 col-md-16">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center justify-content-between">
                        <h6 class="card-title col-sm-12 col-md-12"><?= __('Responsabilidade do Cliente') ?></h6>
                        <div class="btn-group pull-right">
                            <a href='<?= $this->request->webroot . 'premissas/add/Cliente'; ?>' class="btn btn-success btn-round"><span class="text"><?= __('Atualizar') ?></span></a>
                        </div>
                    </div>
                </div>
                <?php                
                foreach ($premissasCliente as $premissaCliente){
                    echo "<div class='row'>";
                        echo "<div class='col-sm-16 col-md-16'>";
                            echo "<div class='card-block'>";
                                echo "<p><i>Alterado em: ".implode("/", array_reverse(explode("-",$premissaCliente['date'])))." por: ".$premissaCliente['user']['profile']['name']." ".$premissaCliente['user']['profile']['surname']."</i></p>";
                                echo "<p>".$premissaCliente['value']."</p>";
                            echo "</div>";    
                        echo "</div>";
                    echo "</div>";
                }
                ?> 
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-16 col-md-16">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center justify-content-between">
                        <h6 class="card-title col-sm-12 col-md-12"><?= __('Responsabilidade do Parceiro') ?></h6>
                        <div class="btn-group pull-right">
                            <a href='<?= $this->request->webroot . 'premissas/add/Parceiro'; ?>' class="btn btn-success btn-round"><span class="text"><?= __('Atualizar') ?></span></a>
                        </div>
                    </div>
                </div>
                <?php                
                foreach ($premissasParceiro as $premissaParceiro){
                    echo "<div class='row'>";
                        echo "<div class='col-sm-16 col-md-16'>";
                            echo "<div class='card-block'>";
                                echo "<p><i>Alterado em: ".implode("/", array_reverse(explode("-",$premissaParceiro['date'])))." por: ".$premissaParceiro['user']['profile']['name']." ".$premissaParceiro['user']['profile']['surname']."</i></p>";
                                echo "<p>".$premissaParceiro['value']."</p>";
                            echo "</div>";    
                        echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
