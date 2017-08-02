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
            <h3><i class="fa fa-th-large"></i> <?= __('Canvas') ?></h3>
        </div>
        <div class="col text-right ">
            <div class="btn-group pull-right">
                <a href='/canvas/add' class="btn btn-primary btn-round"><span class="text"><?= __('Adicionar novo') ?></span> <i class="fa fa-plus ml-2"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-16">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('Canvas') ?></h5>
                </div>
                <div class="card-block">
                    <table class="table " id="dataTable">
                        <thead>
                            <tr>
                                <th>Id </th>
                                <th>Título </th>
                                <th>Data de criação</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($canvas as $cv): ?>
                                <tr>
                                    <td><?= $this->Number->format($cv->id) ?></td>	
                                    <td><?= $cv->titulo ?></td>
                                    <td><?= $cv->data ?></td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Ações </button>
                                            <div class="dropdown-menu"> 
                                                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $cv->id], ['class' => 'dropdown-item']) ?>
                                                <?= $this->Html->link(__('Ver'), ['action' => 'ver', $cv->id], ['class' => 'dropdown-item']) ?>
                                                <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $cv->id], ['class' => 'dropdown-item'], ['confirm' => __('Você tem certeza que deseja apagar o canvas # {0}?', $cv->titulo)]) ?>  	
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
