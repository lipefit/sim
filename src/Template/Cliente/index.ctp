<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cliente[]|\Cake\Collection\CollectionInterface $clientes
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><?= __('Clientes') ?></h3>
        </div>
        <div class="col text-right ">
            <div class="btn-group pull-right">
                <a href='/cliente/add' class="btn btn-primary btn-round"><span class="text"><?= __('Adicionar novo') ?></span> <i class="fa fa-plus ml-2"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-16">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __('Clientes') ?></h5>
                </div>
                <div class="card-block">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>Id </th>
                                <th>Nome Fantasia</th>
                                <th>Site</th>
                                <th>CPF / CNPJ</th> 
                                <th>Criado</th>
                                <th>Modificado</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientes as $cliente): ?>
                                <tr class="odd">
                                    <td><?= $this->Number->format($cliente->id) ?></td>	
                                    <td><?= h($cliente->nomeFantasia) ?></td>
                                    <td><?= h($cliente->site) ?></td>
                                    <td><?= h($cliente->cpfCnpj) ?></td>
                                    <td><?= h($cliente->created) ?></td>
                                    <td><?= h($cliente->updated) ?></td>
                                    <td class="center">
                                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $cliente->id], ['class' => 'btn btn-primary']) ?>
                                        <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $cliente->id], ['class' => 'btn btn-danger'], ['confirm' => __('Você tem certeza que deseja apagar o cliente # {0}?', $cliente->nomeFantasia)]) ?>  	
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
