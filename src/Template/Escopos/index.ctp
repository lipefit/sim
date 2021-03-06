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
            <h3><i class="fa fa-gavel"></i> <?= __('Escopo') ?></h3>
        </div>
        <div class="col text-right ">
            <div class="btn-group pull-right">
                <a href='/escopos/add' class="btn btn-primary btn-round"><span class="text"><?= __('Adicionar Serviço') ?></span> <i class="fa fa-plus ml-2"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-16">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('Serviço') ?></h5>
                </div>
                <div class="card-block">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>Id </th>
                                <th>Serviço</th>
                                <th>Descrição</th>
                                <th>Quantidade</th> 
                                <th>Frequência</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($escopos as $escopo): ?>
                                <tr>
                                    <td><?= $this->Number->format($escopo->id) ?></td>
                                    <td><?= h($escopo->servico) ?></td>
                                    <td><?= h($escopo->descricao) ?></td>
                                    <td><?= h($escopo->quantidade) ?></td>
                                    <td><?= h($escopo->frequencia) ?></td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Ações </button>
                                            <div class="dropdown-menu"> 
                                                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $escopo->id], ['class' => 'dropdown-item']) ?>
                                                <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $escopo->id], ['class' => 'dropdown-item'], ['confirm' => __('Você tem certeza que deseja apagar o serviço # {0}?', $escopo->servico)]) ?>
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