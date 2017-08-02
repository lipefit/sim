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
            <h3><i class="fa fa-eye"></i> <?= __('Concorrentes') ?></h3>
        </div>
        <div class="col text-right ">
            <div class="btn-group pull-right">
                <a href='/concorrentes/add' class="btn btn-primary btn-round"><span class="text"><?= __('Adicionar novo') ?></span> <i class="fa fa-plus ml-2"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-16">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('Concorrentes') ?></h5>
                </div>
                <div class="card-block">
                    <table class="table " id="dataTable">
                        <thead>
                            <tr>
                                <th>Id </th>
                                <th>Concorrente</th>
                                <th>URL</th>
                                <th>Produto/Serviço</th>
                                <th>Tipo</th>
                                <th>Criado</th>
                                <th>Modificado</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($concorrentes as $concorrente): ?>
                                <tr class="odd">
                                    <td><?= $this->Number->format($concorrente->id) ?></td>	
                                    <td><?= h($concorrente->name) ?></td>
                                    <td><?= h($concorrente->url) ?></td>
                                    <td><?= h($concorrente->produto) ?></td>
                                    <td><?= h($concorrente->tipo) ?></td>
                                    <td><?= h($concorrente->created) ?></td>
                                    <td><?= h($concorrente->modified) ?></td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Ações </button>
                                            <div class="dropdown-menu"> 
                                                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $concorrente->id], ['class' => 'dropdown-item']) ?>
                                                <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $concorrente->id], ['class' => 'dropdown-item'], ['confirm' => __('Você tem certeza que deseja apagar o concorrente # {0}?', $concorrente->name)]) ?>  	
                                            </div>
                                        </div>
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