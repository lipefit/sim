<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pauta[]|\Cake\Collection\CollectionInterface $pautas
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-file-text"></i> <?= __('Pautas de Conteúdos') ?></h3>
        </div>
        <div class="col text-right ">
            <div class="btn-group pull-right">
                <a href='/pautas/add' class="btn btn-primary btn-round"><span class="text"><?= __('Adicionar nova') ?></span> <i class="fa fa-plus ml-2"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-16">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('Pautas de Conteúdos') ?></h5>
                </div>
                <div class="card-block">
                    <table class="table " id="dataTable">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Tipo</th>
                                <th>Recebido em</th>
                                <th>Aprovado em</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pautas as $pauta): ?>
                                <tr class="odd">
                                    <td><?= h($pauta->titulo) ?></td>
                                    <td><?= h($pauta->tipo) ?></td>
                                    <td><?= h($pauta->recebido) ?></td>
                                    <td><?= h($pauta->aprovado) ?></td>
                                    <td><?= h($pauta->status) ?></td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Ações </button>
                                            <div class="dropdown-menu"> 
                                                <?= $this->Html->link(__('Detalhes'), ['action' => 'detalhes', $pauta->id], ['class' => 'dropdown-item']) ?>
                                                <?= $this->Html->link(__('Duplicar'), ['action' => 'duplicar', $pauta->id], ['class' => 'dropdown-item']) ?>
                                                <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $pauta->id], ['confirm' => __('Você tem certeza que deseja apagar a pauta # {0}?', $pauta->titulo),'class' => 'dropdown-item']) ?>
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