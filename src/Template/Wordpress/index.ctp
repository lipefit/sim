<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-wordpress"></i> <?= __('Sincronizar wordpress') ?></h3>
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
                    <h6 class="card-title"><?= __('Sincronizar wordpress') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($wp) ?>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group">
                                <p>Recomendados criar um usuário no wordpress apenas para uso da sincronização. Com permissões para postagens de conteúdo.</p>
                                <label for="endereco">Endereço (Endereço principal onde o wordpress está instalado. É necessário que o arquivo xmlrpc.php do wordpress esteja nesse diretório.) </label>
                                <?= $this->Form->control('endereco', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Endereço']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group">
                                <label for="login">Login (Mesmo usuário usado para logar no admim.)</label>
                                <?= $this->Form->control('login', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Login', 'type' => 'text']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group">
                                <label for="estilo">Senha (Senha usada para logar no admin.) </label>
                                <?= $this->Form->control('senha', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Senha', 'type' => 'password']); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (@$wp->endereco == "") {
                        echo "<center>".$this->Form->button(__('Conectar'), ['class' => 'btn btn-primary'])."</center>";
                        echo $this->Form->end();
                    } else {
                        echo $this->Form->end();
                        echo "<center>".$this->Form->postLink('Desconectar', array('action' => 'delete', $wp->id), array('class' => 'btn btn-danger', 'inline' => false, 'confirm' => 'Tem certeza que deseja desconectar?'))."</center>";;
                    }
                    ?>
                                        
                </div>
            </div>
        </div>
    </div>
</div>
