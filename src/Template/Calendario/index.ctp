<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container mb-4">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-calendar"></i> <?= __('Calendário editorial') ?></h3>
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
                    <h6 class="card-title"><?= __('Calendário editorial') ?></h6>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-16">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    "use strict";
    $(document).on('ready', function () {
        /* initialize the calendar
         -----------------------------------------------------------------*/
        $('#calendar').fullCalendar({
            ignoreTimezone: false,
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            buttonText: {
                today: "Hoje",
                month: "Mês",
                week: "Semana",
                day: "Dia"
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek'
            },
            events: [
                <?php if(@$conteudos):
                        foreach ($conteudos as $conteudo):
                            if($conteudo->pauta->dataPublicacao != ""):
                                $title = $conteudo->status;
                                $data = $conteudo->pauta->dataPublicacao->format('Y-m-d');
                                if($conteudo->status == "Rascunho"):
                                    $class = "label-default";
                                elseif($conteudo->status == "Revisão"):
                                    $class = "label-warning"; 
                                elseif($conteudo->status == "Aprovação"):
                                    $class = "label-primary";
                                elseif($conteudo->status == "Publicação agendada"):
                                    $class = "label-success";
                                elseif($conteudo->status == "Publicado"):
                                    $class = "label-info";
                                endif; ?>
                                {
                                    title: 'Blog / <?=$title;?>',
                                    start: '<?=$data;?>',
                                    className: '<?=$class;?>',
                                    url: 'conteudos/detalhes/<?=$conteudo->id;?>',
//                                    icon: 'pencil',
                                    description: '<?=$conteudo->pauta->titulo;?>',
                                },
                            <?php endif;
                        endforeach;
                    endif; ?>
                <?php if(@$sociais):
                        foreach ($sociais as $social):
                            if($social->dataPublicacao != ""):
                                $title = $social->sociai->status;
                                $data = $social->dataPublicacao->format('Y-m-d');
                                if($social->sociai->status == "Rascunho"):
                                    $class = "label-default";
                                elseif($social->sociai->status == "Revisão"):
                                    $class = "label-warning"; 
                                elseif($social->sociai->status == "Aprovação"):
                                    $class = "label-primary";
                                elseif($social->sociai->status == "Publicação agendada"):
                                    $class = "label-success";
                                elseif($social->sociai->status == "Publicado"):
                                    $class = "label-info";
                                endif; ?>
                                {
                                    title: 'Social / <?=$title;?>',
                                    start: '<?=$data;?>',
                                    className: '<?=$class;?>',
                                    url: 'sociais/detalhes/<?=$social->sociai->id;?>',
//                                    icon: 'pencil',
                                    description: '<?=@$social->pauta->titulo;?>',
                                },
                            <?php endif;
                        endforeach;
                    endif; ?>                    
                    

            ],
            eventRender: function(event, element) {
                if(event.icon){          
                   element.find(".fc-title").prepend("<span class='fa fa-"+event.icon+"' style='float:left; margin-right:10px;'></span> ");
                }
                element.find(".fc-content").attr("title",event.description);
            }
        });
    });
</script>
