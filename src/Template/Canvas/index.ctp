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
            <h3><?= __('Canvas') ?></h3>
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
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($canvas as $cv): ?>
                                <tr>
                                    <td><?= $this->Number->format($cv->id) ?></td>	
                                    <td><?= $cv->titulo ?></td>
                                    <td><?= $cv->data ?></td>
                                    <td class="center">
                                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $cv->id], ['class' => 'btn btn-primary']) ?>
                                        <?= $this->Html->link(__('Ver'), ['action' => 'ver', $cv->id], ['class' => 'btn btn-warning']) ?>
                                        <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $cv->id], ['class' => 'btn btn-danger'], ['confirm' => __('Você tem certeza que deseja apagar o canvas # {0}?', $cv->titulo)]) ?>  	
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
<script>
    "use strict";
    $(document).ready(function () {
        $('#dataTable').DataTable({
            responsive: true,
            pageLength: 10,
            sPaginationType: "full_numbers",
            oLanguage: {
                oPaginate: {
                    sFirst: "<<",
                    sPrevious: "<",
                    sNext: ">",
                    sLast: ">>"
                }
            }
        });
    });
</script>
