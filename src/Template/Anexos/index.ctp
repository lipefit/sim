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
            <h3><i class="fa fa-paperclip"></i> <?= __('Anexos') ?></h3>
        </div>
        <div class="col text-right ">
            <div class="btn-group pull-right">
                <a href='/anexos/add' class="btn btn-primary btn-round"><span class="text"><?= __('Adicionar') ?></span> <i class="fa fa-plus ml-2"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-16">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('Anexos') ?></h5>
                </div>
                <div class="card-block">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Anexo</th>
                                <th>Criado em</th> 
                                <th>Criado por</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($anexos as $anexo): ?>
                                <tr>
                                    <td><?= h($anexo->titulo) ?></td>
                                    <td><?php echo "<a href='/files". DS .$anexo->anexo."' target='_blank'>".$anexo->anexo."</a>"; ?></td>
                                    <td><?= h($anexo->created) ?></td>
                                    <td><?= h($anexo->profile->name) ?></td>
                                    <td class="center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Ações </button>
                                            <div class="dropdown-menu"> 
                                                <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $anexo->id], ['confirm' => __('Você tem certeza que deseja apagar o anexo # {0}?', $anexo->titulo),'class' => 'dropdown-item']) ?>
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