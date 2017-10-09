<?= $this->Form->create($user, ['class' => 'form-signin1 smallbox','url' => ['action' => 'salvarSenha']]) ?>
<h2 class="tex-black mb-4">Ativação de conta</h2>
<p>Cadastre sua senha para acesso ao sistema</p>
<label class="sr-only">Senha</label>
<?= $this->Form->input('password', array('label' => false, 'placeholder' => 'Senha', 'class' => 'form-control')); ?>
<br>
<?= $this->Form->submit(__('Salvar'), array(
    'class' => 'btn btn-lg btn-primary btn-round'
));
?>
<?= $this->Form->end() ?>