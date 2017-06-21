<?= $this->Form->create(null, ['class' => 'form-signin1 smallbox']) ?>
<h2 class="tex-black mb-4">Login</h2>
<label class="sr-only">E-mail</label>
<?= $this->Form->input('username', array('label' => false, 'placeholder' => 'E-mail', 'class' => 'form-control')); ?>
<br>
<label class="sr-only">Senha</label>
<?= $this->Form->input('password', array('label' => false, 'placeholder' => 'Senha', 'class' => 'form-control')); ?>
<br>
<?= $this->Form->submit(__('Entrar'), array(
    'class' => 'btn btn-lg btn-primary btn-round'
));
?>
<a href="#" class="btn btn-link mt-2 text-white">Esqueci a Senha</a>
<?= $this->Form->end() ?>