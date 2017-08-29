<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tatica[]|\Cake\Collection\CollectionInterface $taticas
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-external-link"></i> <?= __('Táticas de Conteúdo') ?></h3>
        </div>
        <div class="col text-right ">
            <div class="btn-group pull-right">
                <a href='/taticas/add' class="btn btn-primary btn-round"><span class="text"><?= __('Adicionar nova') ?></span> <i class="fa fa-plus ml-2"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-16">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('Tática de Conteúdo') ?></h5>
                </div>
                <div class="card-block">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>Voz</th>
                                <th>Storytelling</th>
                                <th>Arquétipo</th> 
                                <th>Tipo de conteúdo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($taticas as $tatica): ?>
                                <tr>
                                    <td><?= h($tatica->voz) ?></td>
                                    <td><?= h($tatica->storytelling) ?></td>
                                    <td><?= h($tatica->arquetipo) ?></td>
                                    <td><?= h($tatica->tipo) ?></td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Ações </button>
                                            <div class="dropdown-menu"> 
                                                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $tatica->id], ['class' => 'dropdown-item']) ?>
                                                <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $tatica->id], ['confirm' => __('Você tem certeza que deseja apagar a tática de conteúdo # {0}?', $tatica->voz),'class' => 'dropdown-item']) ?>
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