<?php
$url = "http://simarketing.provisorio.ws/projetos/";

use Cake\Datasource\ConnectionManager;

$conn = ConnectionManager::get('default');
?>
<script>
    var mudaTempo;
    $(document).ready(function () {
//        $(".addProjeto").click(function () {
//            var template = $("#templateAddProjeto").html();
//            $("#addProjeto").html(template);
//            $(".chosen-select").chosen({disable_search_threshold: 10});
//        });

        $(".addAtividade").click(function () {
            var projeto = $(this).attr("rel");
            var template = $("#templateAddAtividade").html();
            $("#addAtividade").html(template);
            $("#addAtividade").show();
        });

        $(".addTarefa").click(function () {
            var atividade = $(this).attr("rel");
            var template = $("#templateAddTarefa").html();
            template = template.replace("@{atividade_id}", atividade);
            $("#addTarefa_" + atividade).html(template);
            $("#addTarefa_" + atividade).show();
//            $(".chosen-select").chosen({disable_search_threshold: 10});
            datePicker();
        });

        $(".tempo").click(function () {
            if ($(this).find('i').hasClass("fa-play")) {
                var tarefa = $(this).attr("rel");
                $(this).find('i').removeClass("fa-play").addClass("fa-pause");
                mudaStatus(tarefa, "Trabalhando");
                alteraTempo(tarefa);
                $(".status_" + tarefa).html("Trabalhando");
            } else {
                var tarefa = $(this).attr("rel");
                $(this).find('i').removeClass("fa-pause").addClass("fa-play");
                mudaStatus(tarefa, "Pausada");
                $(".status_" + tarefa).html("Pausada");
                clearTimeout(mudaTempo);
            }
        });

    });

    function datePicker() {
        console.log("aqui");
        if ($(".datepicker").length > 0) {
            console.log("aqui 2");
            $(".datepicker").datepicker({format: 'dd/mm/yyyy'});
            $("#dp-2,#dp-3,#dp-4").datepicker(); // Sample
        }
    }

    function alteraTempo(tarefa) {
        var tempo = "";
        mudaTempo = setTimeout(function () {
            $.get('<?= $url; ?>consultaTempo?tarefa=' + tarefa, function (data) {
                tempo = data;
                $(".tempo[rel='" + tarefa + "']").find("span").html(tempo);
            });
            alteraTempo(tarefa);
        }, 1000);
    }

    function mudaStatus(tarefa, status) {
        $.get('<?= $url; ?>mudaStatus?tarefa=' + tarefa + "&status=" + status, function (data) {
            return true;
        });
    }
</script>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-tasks"></i> <?= __('Projetos') ?></h3>
        </div>
        <div class="col text-right ">
            <div class="btn-group pull-right">
                <a href='javascript:history.back()' class="btn btn-warning btn-round"><span class="text"><?= __('Voltar') ?></span></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-16">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= __($projeto->nome) ?></h5>
                </div>
                <div class="card-block">
                    <?php
                    $atividades = $conn->execute("SELECT at.id as atId, at.projeto_id, at.nome, p.id FROM bd_simarketing.projeto_atividade at INNER JOIN bd_simarketing.projeto p ON at.projeto_id = p.id WHERE p.id = '" . $projeto->id . "'");
                    $atividades->execute();
                    $rowsAtividades = $atividades->fetchAll('assoc');
                    if ($rowsAtividades) {
                        ?>
                        <table class="table" cellpadding="0" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th colspan="8" id="addAtividade"></th>
                                    <th><a href="javascript:void(0);" class="btn btn-primary btn-xl addAtividade" style="float: right;">Adicionar Atividade</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($rowsAtividades as $atividade) {
                                    echo "<tr>"
                                    . "<td colspan='8'>"
                                    . "<strong> " . utf8_encode($atividade['nome']) . "</strong>"
                                    . "</td>"
                                    . "<td>"
                                    . "<div class='btn-group' style='float:right'>"
                                    . "<button type='button' class='btn btn-primary'>Ações</button>"
                                    . "<button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>"
                                    . "<span class='caret'></span>"
                                    . "<span class='sr-only'>Toggle Dropdown</span>"
                                    . "</button>"
                                    . "<ul class='dropdown-menu pull-right'>"
                                    . "<li><a href='javascript:void(0);' class='addTarefa dropdown-item' rel='" . $atividade['atId'] . "'>Adicionar tarefa</a></li>"
                                    . "<li>";
                                    echo $this->Form->postLink('Apagar atividade', array('action' => 'apagarAtividade', $atividade['atId']), array('class' => 'dropdown-item')
                                            , 'Tem certeza que deseja apagar a atividade?');
                                    echo "</li>"
                                    . "</ul>"
                                    . "</div>"
                                    . "</td>"
                                    . "</tr>"
                                    . "<tr id='addTarefa_" . $atividade['atId'] . "' style='display:none;'></tr>";
                                    $tarefas = $conn->execute("SELECT t.nome, t.responsavel, t.tempo, t.inicio, t.entrega, t.status, t.id, t.atividade_id, u.username, u.id as idUser FROM bd_simarketing.projeto_tarefa t INNER JOIN bd_simarketing.users u ON u.id = t.responsavel WHERE t.atividade_id = '" . $atividade['atId'] . "'") or die(mysql_error());
                                    $tarefas->execute();
                                    $rowsTarefas = $tarefas->fetchAll('assoc');
                                    if ($rowsTarefas) {
                                        echo "<tr>"
                                        . "<td class='atividadeCol_1'>"
                                        . "<strong> " . utf8_encode($atividade['nome']) . "</strong>"
                                        . "</td>"
                                        . "<td class='atividade'><strong>Responsável</strong></td>"
                                        . "<td class='atividade'><strong>Início</strong></td>"
                                        . "<td class='atividade'><strong>Entrega</strong></td>"
                                        . "<td class='atividade'></td>"
                                        . "<td class='atividade'></td>"
                                        . "<td class='atividade'><strong>Status</strong></td>"
                                        . "<td class='atividade'><strong>Sinalização</strong></td>"
                                        . "<td class='atividade'>"
                                        . "<div class='btn-group' style='float:right'>"
                                        . "<button type='button' class='btn btn-primary'>Ações</button>"
                                        . "<button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>"
                                        . "<span class='caret'></span>"
                                        . "<span class='sr-only'>Toggle Dropdown</span>"
                                        . "</button>"
                                        . "<ul class='dropdown-menu pull-right'>"
                                        . "<li><a href='javascript:void(0);' class='addTarefa dropdown-item' rel='" . $atividade['atId'] . "'>Adicionar Tarefa</a></li>"
                                        . "<li>";
                                        echo $this->Form->postLink('Apagar Atividade', array('action' => 'apagarAtividade', $atividade['atId']), array('class' => 'dropdown-item')
                                                , 'Tem certeza que deseja apagar a Atividade?');
                                        echo "</li>"
                                        . "</ul>"
                                        . "</div>"
                                        . "</td>"
                                        . "</tr>"
                                        . "<tr id='addTarefa_" . $atividade['atId'] . "' style='display:none;'></tr>";
                                    }
//                                    } else {
//                                        echo "<tr>"
//                                        . "<td colspan='8' class='atividadeCol_1'>"
//                                        . "<strong> " . utf8_encode($atividade['nome']) . "</strong>"
//                                        . "</td>"
//                                        . "<td class='atividade'>"
//                                        . "<div class='btn-group' style='float:right'>"
//                                        . "<button type='button' class='btn btn-primary'>Ações</button>"
//                                        . "<button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>"
//                                        . "<span class='caret'></span>"
//                                        . "<span class='sr-only'>Toggle Dropdown</span>"
//                                        . "</button>"
//                                        . "<ul class='dropdown-menu pull-right'>"
//                                        . "<li><a href='javascript:void(0);' class='addTarefa dropdown-item' rel='" . $atividade['atId'] . "'>Adicionar Tarefa</a></li>"
//                                        . "<li>";
//                                        echo $this->Form->postLink('Apagar Atividade', array('action' => 'apagarAtividade', $atividade['atId']), array('class'=>'dropdown-item')
//                                                , 'Tem certeza que deseja apagar a Atividade?');
//                                        echo "</li>"
//                                        . "</ul>"
//                                        . "</div>"
//                                        . "</td>"
//                                        . "</tr>"
//                                        . "<tr id='addTarefa_" . $atividade['atId'] . "' style='display:none;'></tr>";
//                                    }

                                    foreach ($rowsTarefas as $tarefa) {
                                        echo "<tr>"
                                        . "<td class='tarefaCol_1'>" . utf8_encode($tarefa['nome']) . "</td>"
                                        . "<td class='tarefa'>" . utf8_encode($tarefa['username']) . "</td>"
                                        . "<td class='tarefa'>" . implode('/', array_reverse(explode('-', $tarefa['inicio']))) . "</td>"
                                        . "<td class='tarefa'>" . implode('/', array_reverse(explode('-', $tarefa['entrega']))) . "</td>";
                                        if ($tarefa['status'] == "Finalizada") {
                                            echo "<td class='tarefa'></td>"
                                            . "<td class='tarefa'><a href='" . $url . "reabrirTarefa/" . $tarefa['id'] . "' class='btn btn-default btn-xs reabrir'>Reabrir</a></td>"
                                            . "<td class='tarefa status_" . $tarefa['id'] . "'>" . $tarefa['status'] . "</td>";
                                        } elseif ($tarefa['status'] == "Trabalhando") {
                                            echo "<script>alteraTempo('" . $tarefa['id'] . "');</script>";
                                            echo "<td class='tarefa'><a rel='" . $tarefa['id'] . "' href='javascript:void(0);' class='btn btn-info btn-xs tempo'><i class='fa fa-pause' aria-hidden='true'></i><span>" . $tarefa['tempo'] . "</span></a></td>"
                                            . "<td class='tarefa'><a href='" . $url . "entregarTarefa/" . $tarefa['id'] . "' class='btn btn-default btn-xs entregar'>Entregar</a></td>"
                                            . "<td class='tarefa status_" . $tarefa['id'] . "'>" . $tarefa['status'] . "</td>";
                                        } else {
                                            echo "<td class='tarefa'><a rel='" . $tarefa['id'] . "' href='javascript:void(0);' class='btn btn-info btn-xs tempo'><i class='fa fa-play' aria-hidden='true'></i><span>" . $tarefa['tempo'] . "</span></a></td>"
                                            . "<td class='tarefa'><a href='" . $url . "entregarTarefa/" . $tarefa['id'] . "' class='btn btn-default btn-xs entregar'>Entregar</a></td>"
                                            . "<td class='tarefa status_" . $tarefa['id'] . "'>" . $tarefa['status'] . "</td>";
                                        }
                                        echo "<td class='tarefa'><i class='list-group-status status-online'></i></td>"
                                        . "<td class='tarefa' align='right'>"
                                        . "<div class='btn-group' style='float:right'>"
                                        . "<button type='button' class='btn btn-primary'>Ações</button>"
                                        . "<button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>"
                                        . "<span class='caret'></span>"
                                        . "<span class='sr-only'>Toggle Dropdown</span>"
                                        . "</button>"
                                        . "<ul class='dropdown-menu pull-right'>"
                                        . "<li>";
                                        echo $this->Form->postLink('Apagar tarefa', array('action' => 'apagarTarefa', $tarefa['id']), array('class' => 'dropdown-item')
                                                , 'Tem certeza que deseja apagar a tarefa?');
                                        echo "</li>"
                                        . "</ul>"
                                        . "</div>"
                                        . "</td></tr>";
                                    }
                                }
                                ?>
                            </tbody>    
                        </table>
                        <?php
                    } else {
                        ?>
                        <table class="table" cellpadding="0" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th colspan="8" id="addAtividade"></th>
                                    <th><a href="javascript:void(0);" class="btn btn-primary btn-xl addAtividade" style="float: right;">Adicionar atividade</a></th>
                                </tr>
                            </thead>
                        </table>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script id="templateAddAtividade" type="template/javascript">
    <form action="<?= $url; ?>addAtividade" method="post">
    <div class="row">
    <div class="col-lg-15 col-md-15">
    <div class="form-group">
    <input type="hidden" name="projeto_id" value="<?= $projeto->id; ?>">
    <input type="text" name="nome" class="form-control">
    </div>
    </div>
    <div class="col-lg-1 col-md-1">
    <button class="btn btn-success btn-xl">Ok</button>
    </div>
    </div>
    </form>
</script>

<script id="templateAddTarefa" type="template/javascript">
    <td colspan="9" class="tarefa">
    <form action="<?= $url; ?>addTarefa" method="post">
    <div class="row">
    <div class="col-lg-4 col-md-4">
    <input type="hidden" name="projeto_id" value="<?= $projeto->id; ?>">
    <input type="hidden" name="atividade_id" value="@{atividade_id}">
    <input type="text" name="nome" class="form-control" placeholder="Tarefa">
    </div>
    <div class="col-lg-4 col-md-4">
    <?=
    $this->Form->input('', array(
        'label' => false,
        'name' => 'responsavel',
        'options' => $users,
        'multiple' => false,
        'class' => 'form-control col-lg-16 col-md-16',
        'data-placeholder' => 'Responsável'
    ));
    ?>
    </div>
    <div class="col-lg-3 col-md-3">
    <input type="text" name="inicio" class="form-control datepicker" data-date-format="dd/mm/yyyy" placeholder="Inicio">
    </div>
    <div class="col-lg-3 col-md-3">
    <input type="text" name="entrega" class="form-control datepicker" data-date-format="dd/mm/yyyy" placeholder="Entrega">
    </div>
    <div class="col-lg-2 col-md-2">
    <button class="btn btn-success btn-xl">Ok</button>
    </div>
    </div>
    </form>
    </td>
</script>

<style>
    table tr td{
        /*background: #f1f1f1;*/
    }

    .atividade{
        /*background: #f9f9f9;*/
    }

    .atividadeCol_1{
        /*background: #f9f9f9;*/
        padding-left: 30px !important;
    }

    .tarefa{
        /*background: #fff;*/
    }

    .tarefaCol_1{
        /*background: #fff;*/
        padding-left: 60px !important;
    }

    .list-group-status{
        float: none;
        margin-right: 0px;
        height: auto;
    }

    .tempo{
        font-weight: bold;
    }

    .entregar{
        border-color: #3fbae4;
        color: #3fbae4;
    }

    .entregar:hover{
        /*background: #fff;*/
        color: #3fbae4;
        border-color: #3fbae4;
    }

    .reabrir{
        border-color: #3fbae4;
        color: #3fbae4;
    }

    .reabrir:hover{
        /*background: #fff;*/
        color: #3fbae4;
        border-color: #3fbae4;
    }
</style>