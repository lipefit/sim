<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Palavra[]|\Cake\Collection\CollectionInterface $palavras
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-key"></i> <?= __('Palavras-chave') ?></h3>
        </div>
        <div class="col text-right ">
            <div class="btn-group pull-right">
                <a href='/palavras/add' class="btn btn-primary btn-round"><span class="text"><?= __('Adicionar') ?></span> <i class="fa fa-plus ml-2"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-16">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('Palavras-chave') ?></h5>
                </div>
                <div class="card-block">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>Id </th>
                                <th>Palavra-chave</th>
                                <th>Persona</th>
                                <th>Etapa da jornada</th> 
                                <th>Produto/Serviço</th>
                                <th>CPC</th>
                                <th>Volume de busca</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($palavras as $palavra): ?>
                                <tr>
                                    <td><?= $this->Number->format($palavra->id) ?></td>
                                    <td><?= h($palavra->palavra) ?></td>
                                    <td><?= h($palavra->persona) ?></td>
                                    <td><?= h($palavra->etapa) ?></td>
                                    <td><?= h($palavra->produto) ?></td>
                                    <td><?= h($palavra->cpc) ?></td>
                                    <td><?= h($palavra->volume) ?></td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Ações </button>
                                            <div class="dropdown-menu"> 
                                                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $palavra->id], ['class' => 'dropdown-item']) ?>
                                                <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $palavra->id], ['class' => 'dropdown-item'], ['confirm' => __('Você tem certeza que deseja apagar a palavra # {0}?', $palavra->palavra)]) ?>
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