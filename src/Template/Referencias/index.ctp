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
            <h3><i class="fa fa-copy"></i> <?= __('Referências') ?></h3>
        </div>
        <div class="col text-right ">
            <div class="btn-group pull-right">
                <a href='/referencias/add' class="btn btn-primary btn-round"><span class="text"><?= __('Adicionar nova') ?></span> <i class="fa fa-plus ml-2"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-16">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('Referências') ?></h5>
                </div>
                <div class="card-block">
                    <table class="table " id="dataTable">
                        <thead>
                            <tr>
                                <th>Id </th>
                                <th>Referência</th>
                                <th>Url</th>
                                <th>Criado</th>
                                <th>Modificado</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($referencias as $referencia): ?>
                                <tr class="odd">
                                    <td><?= $this->Number->format($referencia->id) ?></td>	
                                    <td><?= h($referencia->name) ?></td>
                                    <td><?= h($referencia->url) ?></td>
                                    <td><?= h($referencia->created) ?></td>
                                    <td><?= h($referencia->modified) ?></td>
                                    <td class="center">
                                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $referencia->id], ['class' => 'btn btn-primary']) ?>
                                        <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $referencia->id], ['class' => 'btn btn-danger'], ['confirm' => __('Você tem certeza que deseja apagar a referência # {0}?', $referencia->name)]) ?>  	
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