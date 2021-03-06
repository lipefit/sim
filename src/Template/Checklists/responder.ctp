<?php

use Cake\Datasource\ConnectionManager;

$conn = ConnectionManager::get('default');
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-check-square-o"></i> <?= __('Check list') ?></h3>
        </div>
        <div class="col text-right ">
            <div class="btn-group pull-right">
                <a href='javascript:history.back()' class="btn btn-warning btn-round"><span class="text"><?= __('Voltar') ?></span></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-16 col-md-16">
            <?= $this->Form->create("", ['url' => ['action' => 'salvarRespostas']]) ?>
            <?php foreach ($perguntas as $pergunta) { ?>
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title"><?= __($pergunta->categoria) ?></h6>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <?php
                            $pts = $conn->execute("SELECT * FROM bd_simarketing.perguntas WHERE checklist_id = '" . $pergunta->checklist_id . "' AND categoria = '" . $pergunta->categoria . "'");
                            $pts->execute();
                            $rows = $pts->fetchAll('assoc');
                            $x = 0;
                            foreach ($rows as $row) {
                                $rps = $conn->execute("SELECT * FROM bd_simarketing.respostas WHERE pergunta_id = '" . $pergunta->id ."'");
                                $rps->execute();
                                $rowsRps = $pts->fetchAll('assoc');
                                ?>
                                <div class="col-lg-8 col-md-8">
                                    <div class="form-group">
                                        <label><?= $row['pergunta']; ?></label>
                                        <?= $this->Form->control('idPergunta[' . $x . ']', ['type' => 'hidden', 'value' => $row['id']]); ?>
                                        <?= $this->Form->control('pergunta[' . $x . ']', ['label' => false, 'class' => 'form-control', 'placeholder' => $row['pergunta']]); ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                </div>
            <?php } ?>
            <center><?= $this->Form->button(__('Salvar'), ['class' => 'btn btn-primary']) ?></center>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>