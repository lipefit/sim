<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\COnteudo[]|\Cake\Collection\CollectionInterface $conteudos
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-file-text"></i> <?= __('Conteúdos') ?></h3>
        </div>
        <div class="col text-right ">
            <div class="btn-group pull-right">
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-16">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('Conteúdos') ?></h5>
                </div>
                <div class="card-block">
                    <table class="table " id="dataTable">
                        <thead>
                            <tr>
                                <th>Id </th>
                                <th>Título</th>
                                <th>Tipo</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($conteudos as $conteudo): ?>
                                <tr class="odd">
                                    <td><?= $this->Number->format($conteudo->id) ?></td>	
                                    <td><?= h($conteudo->pauta->titulo) ?></td>
                                    <td><?= h($conteudo->pauta->tipo) ?></td>
                                    <td><?= h($conteudo->status) ?></td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Ações </button>
                                            <div class="dropdown-menu"> 
                                                <?= $this->Html->link(__('Detalhes'), ['action' => 'detalhes', $conteudo->id], ['class' => 'dropdown-item']) ?>
                                                <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $conteudo->id], ['class' => 'dropdown-item'], ['confirm' => __('Você tem certeza que deseja apagar o conteudo # {0}?', $conteudo->pauta->titulo)]) ?>
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