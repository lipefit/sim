<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Escopo[]|\Cake\Collection\CollectionInterface $escopos
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><?= __('Acessos') ?></h3>
        </div>
        <div class="col text-right ">
            <div class="btn-group pull-right">
                <a href='/acessos/add' class="btn btn-primary btn-round"><span class="text"><?= __('Adicionar Acesso') ?></span> <i class="fa fa-plus ml-2"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-16">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('Acesso') ?></h5>
                </div>
                <div class="card-block">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>Id </th>
                                <th>Nome / Tipo</th>
                                <th>URL / HOST</th>
                                <th>Usuário</th> 
                                <th>Senha</th>
                                <th>Outros</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($acessos as $acesso): ?>
                                <tr>
                                    <td><?= $this->Number->format($acesso->id) ?></td>
                                    <td><?= h($acesso->nome) ?></td>
                                    <td><?= h($acesso->url) ?></td>
                                    <td><?= h($acesso->usuario) ?></td>
                                    <td>******</td>
                                    <td><?= h($acesso->outros) ?></td>
                                    <td class="center">
                                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $acesso->id], ['class' => 'btn btn-primary']) ?>
                                        <?= $this->Html->link(__('Ver senha'), ['action' => 'enviar-senha', $acesso->id], ['class' => 'btn btn-warning']) ?>
                                        <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $acesso->id], ['class' => 'btn btn-danger'], ['confirm' => __('Você tem certeza que deseja apagar o acesso # {0}?', $acesso->nome)]) ?>  	
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- /.table-responsive --> 
                </div>
            </div>
        </div>
    </div>
</div>