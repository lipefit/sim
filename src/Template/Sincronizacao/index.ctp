<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-chain"></i> <?= __('Conectar mídias sociais') ?></h3>
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
                    <h6 class="card-title"><?= __('Conectar mídias sociais') ?></h6>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-lg-1 col-md-1">
                            <?php echo $this->Html->image('/icons/facebook.png', array("width" => "56")); ?>
                        </div>
                        <div class="col-lg-11 col-md-11">
                            <h4>Facebook</h4>
                            <?php
                            if (@$fb->access_token == "") {
                                ?>
                                <div>
                                    <i class="fa fa-check" aria-hidden="true" style="color:#ee0000;"></i>
                                    Não Conectado
                                    <a class="btn btn-primary btn-large" href="<?= $loginUrl; ?>" style="margin-left: 40px;">Conectar</a>
                                </div>                                
                                <?php
                            } else {
                                echo "<div>";
                                echo "<i class='fa fa-check' aria-hidden='true' style='color:#00ee00;'></i> Conectado: " . $fb->page_name;
                                echo "</div><br>";
                                echo $this->Form->postLink('Desconectar', array('action' => 'delFacebook', $fb->id), array('class' => 'btn btn-danger btn-large', 'inline' => false, 'confirm' => 'Tem certeza que deseja desconectar?'));
                            }
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-1 col-md-1">
                            <?php echo $this->Html->image('/icons/linkedin.png', array("width" => "56")); ?>
                        </div>
                        <div class="col-lg-11 col-md-11">
                            <h4>Linkedin</h4>

                            <?php
                            if (@$lk->access_token == "") {
                                ?>
                                <div>
                                    <i class="fa fa-check" aria-hidden="true" style="color:#ee0000;"></i>
                                    Não Conectado
                                    <?=
                                    $this->Html->link("Conectar", array(
                                        'controller' => 'sincronizacao',
                                        'action' => 'loginLinkedin'), array(
                                        'class' => 'btn btn-primary btn-large',
                                        'style' => 'margin-left: 40px;'
                                    ));
                                    ?>
                                </div>                                
                                <?php
                            } else {
                                echo "<div>";
                                echo "<i class='fa fa-check' aria-hidden='true' style='color:#00ee00;'></i> Conectado: " . $lk->page_name;
                                echo "</div><br>";
                                echo $this->Form->postLink('Desconectar', array('action' => 'delLinkedin', $lk->id), array('class' => 'btn btn-danger btn-large', 'inline' => false, 'confirm' => 'Tem certeza que deseja desconectar?'));
                            }
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-1 col-md-1">
                            <?php echo $this->Html->image('/icons/twitter.png', array("width" => "56")); ?>
                        </div>
                        <div class="col-lg-11 col-md-11">
                            <h4>Twitter</h4>
                            <?php
                            if (@$twitter->screen_name == "") {
                                ?>
                                <div>
                                    <i class="fa fa-check" aria-hidden="true" style="color:#ee0000;"></i>
                                    Não Conectado
                                    <?=
                                    $this->Html->link("Conectar", array(
                                        'controller' => 'sincronizacao',
                                        'action' => 'loginTwitter'), array(
                                        'class' => 'btn btn-primary btn-large',
                                        'style' => 'margin-left: 40px;'
                                    ));
                                    ?>
                                </div>                                
                                <?php
                            } else {
                                echo "<div>";
                                echo "<i class='fa fa-check' aria-hidden='true' style='color:#00ee00;'></i> Conectado: " . $twitter->screen_name;
                                echo "</div><br>";
                                echo $this->Form->postLink('Desconectar', array('action' => 'delTwitter', $twitter->id), array('class' => 'btn btn-danger btn-large', 'inline' => false, 'confirm' => 'Tem certeza que deseja desconectar?'));
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
