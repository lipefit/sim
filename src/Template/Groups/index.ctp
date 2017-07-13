<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Group[]|\Cake\Collection\CollectionInterface $groups
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-users"></i> <?= __('Grupos de usuários') ?></h3>
        </div>
        <div class="col text-right ">
            <div class="btn-group pull-right">
                <a href='/groups/add' class="btn btn-primary btn-round"><span class="text"><?= __('Adicionar novo') ?></span> <i class="fa fa-plus ml-2"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-16">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('Grupos de usuários') ?></h5>
                </div>
                <div class="card-block">
                    <table class="table " id="dataTable">
                        <thead>
                            <tr>
                                <th>Id </th>
                                <th>Nome</th>
                                <th>Criado</th>
                                <th>Modificado</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($groups as $group): ?>
                                <tr class="odd">
                                    <td><?= $this->Number->format($group->id) ?></td>	
                                    <td><?= h($group->name) ?></td>
                                    <td><?= h($group->created) ?></td>
                                    <td><?= h($group->modified) ?></td>
                                    <td class="center">
                                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $group->id], ['class' => 'btn btn-primary']) ?>
                                        <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $group->id], ['class' => 'btn btn-danger'], ['confirm' => __('Você tem certeza que deseja apagar o usuário # {0}?', $group->name)]) ?>  	
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