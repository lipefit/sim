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
            <h3><i class="fa fa-check-square-o"></i> <?= __('Check lists') ?></h3>
        </div>
        <div class="col text-right ">
            <div class="btn-group pull-right">
                <a href='/checklists/add' class="btn btn-primary btn-round"><span class="text"><?= __('Adicionar Check list') ?></span> <i class="fa fa-plus ml-2"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-16">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('Check list') ?></h5>
                </div>
                <div class="card-block">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Data de Criação</th> 
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($checklists as $checklist): ?>
                                <tr>
                                    <td><?= h($checklist->nome) ?></td>
                                    <td><?= h($checklist->descricao) ?></td>
                                    <td><?= h($checklist->created) ?></td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Ações </button>
                                            <div class="dropdown-menu"> 
                                                <?= $this->Html->link(__('Responder'), ['action' => 'responder', $checklist->id], ['class' => 'dropdown-item']) ?>
                                                <?php if ($checklist->id != 8) { ?>                                        
                                                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $checklist->id], ['class' => 'dropdown-item']) ?>
                                                    <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $checklist->id], ['confirm' => __('Você tem certeza que deseja apagar o check list # {0}?', $checklist->nome),'class' => 'dropdown-item']) ?>
                                                <?php } ?>  	
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