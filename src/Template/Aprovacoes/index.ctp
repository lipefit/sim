<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-check"></i> <?= __('Hierarquia de aprovação') ?></h3>
        </div>
        <div class="col text-right ">
            <div class="btn-group pull-right">
                <a href='javascript:history.back()' class="btn btn-warning btn-round"><span class="text"><?= __('Voltar') ?></span></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-16 col-md-16">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title"><i class="fa fa-question" aria-hidden="true"></i> <?= __('Dúvidas') ?></h6>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <p>- No formulário abaixo, selecione os responsáveis por cada etapa, podendo ser mais de um usuário.</p>
                            <p>- Caso não selecione ninguém, a etapa sera ignorada. Por exemplo, se não selecionar ninguém para aprovar, o conteúdo fica pronto para publicar logo apos a revisão.</p>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->Form->create($aprovacao) ?>
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title"><?= __('Aprovador Master') ?></h6>
                </div>
                <div class="card-block">

                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <?=
                            $this->Form->input('master', array(
                                'label' => 'Aprovador master',
                                'options' => $usersMaster,
                                'multiple' => true,
                                'class' => 'chosen-select col-lg-16 col-md-16',
                                'data-placeholder' => 'Escolha suas opções',
                                'value' => @$master
                            ));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title"><?= __('Pauta de conteúdo') ?></h6>
                </div>
                <div class="card-block">

                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <?=
                            $this->Form->input('pauta_criar', array(
                                'label' => 'Rascunho',
                                'options' => $usersCriar,
                                'multiple' => true,
                                'class' => 'chosen-select col-lg-16 col-md-16',
                                'data-placeholder' => 'Escolha suas opções',
                                'value' => @$pautas_criar
                            ));
                            ?>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <?=
                            $this->Form->input('pauta_designer', array(
                                'label' => '2ª etapa (Designer)',
                                'options' => $usersDesigner,
                                'multiple' => true,
                                'class' => 'chosen-select col-lg-16 col-md-16',
                                'data-placeholder' => 'Escolha suas opções',
                                'value' => @$pautas_designer
                            ));
                            ?>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <?=
                            $this->Form->input('pauta_revisar', array(
                                'label' => '3ª etapa (Revisor)',
                                'options' => $usersRevisar,
                                'multiple' => true,
                                'class' => 'chosen-select col-lg-16 col-md-16',
                                'data-placeholder' => 'Escolha suas opções',
                                'value' => @$pautas_revisar
                            ));
                            ?>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <?=
                            $this->Form->input('pauta_cs', array(
                                'label' => '4ª etapa (CS)',
                                'options' => $usersCs,
                                'multiple' => true,
                                'class' => 'chosen-select col-lg-16 col-md-16',
                                'data-placeholder' => 'Escolha suas opções',
                                'value' => @$pautas_cs
                            ));
                            ?>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <?=
                            $this->Form->input('pauta_cliente', array(
                                'label' => '5ª etapa (Cliente)',
                                'options' => $usersCliente,
                                'multiple' => true,
                                'class' => 'chosen-select col-lg-16 col-md-16',
                                'data-placeholder' => 'Escolha suas opções',
                                'value' => @$pautas_cliente
                            ));
                            ?>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h6 class="card-title"><?= __('Conteúdo') ?></h6>
                </div>
                <div class="card-block">

                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <?=
                            $this->Form->input('conteudo_criar', array(
                                'label' => 'Rascunho',
                                'options' => $usersCriar,
                                'multiple' => true,
                                'class' => 'chosen-select col-lg-16 col-md-16',
                                'data-placeholder' => 'Escolha suas opções',
                                'value' => @$conteudos_criar
                            ));
                            ?>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <?=
                            $this->Form->input('conteudo_designer', array(
                                'label' => '2ª etapa (Designer)',
                                'options' => $usersDesigner,
                                'multiple' => true,
                                'class' => 'chosen-select col-lg-16 col-md-16',
                                'data-placeholder' => 'Escolha suas opções',
                                'value' => @$conteudos_designer
                            ));
                            ?>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <?=
                            $this->Form->input('conteudo_revisar', array(
                                'label' => '3ª etapa (Revisor)',
                                'options' => $usersRevisar,
                                'multiple' => true,
                                'class' => 'chosen-select col-lg-16 col-md-16',
                                'data-placeholder' => 'Escolha suas opções',
                                'value' => @$conteudos_revisar
                            ));
                            ?>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <?=
                            $this->Form->input('conteudo_cs', array(
                                'label' => '4ª etapa (CS)',
                                'options' => $usersCs,
                                'multiple' => true,
                                'class' => 'chosen-select col-lg-16 col-md-16',
                                'data-placeholder' => 'Escolha suas opções',
                                'value' => @$conteudos_cs
                            ));
                            ?>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <?=
                            $this->Form->input('conteudo_cliente', array(
                                'label' => '5ª etapa (Cliente)',
                                'options' => $usersCliente,
                                'multiple' => true,
                                'class' => 'chosen-select col-lg-16 col-md-16',
                                'data-placeholder' => 'Escolha suas opções',
                                'value' => @$conteudos_cliente
                            ));
                            ?>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h6 class="card-title"><?= __('Mídia social') ?></h6>
                </div>
                <div class="card-block">

                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <?=
                            $this->Form->input('social_criar', array(
                                'label' => 'Rascunho',
                                'options' => $usersCriar,
                                'multiple' => true,
                                'class' => 'chosen-select col-lg-16 col-md-16',
                                'data-placeholder' => 'Escolha suas opções',
                                'value' => @$sociais_criar
                            ));
                            ?>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <?=
                            $this->Form->input('social_designer', array(
                                'label' => '2ª etapa (Designer)',
                                'options' => $usersDesigner,
                                'multiple' => true,
                                'class' => 'chosen-select col-lg-16 col-md-16',
                                'data-placeholder' => 'Escolha suas opções',
                                'value' => @$sociais_designer
                            ));
                            ?>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <?=
                            $this->Form->input('social_revisar', array(
                                'label' => '3ª etapa (Revisor)',
                                'options' => $usersRevisar,
                                'multiple' => true,
                                'class' => 'chosen-select col-lg-16 col-md-16',
                                'data-placeholder' => 'Escolha suas opções',
                                'value' => @$sociais_revisar
                            ));
                            ?>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <?=
                            $this->Form->input('social_cs', array(
                                'label' => '4ª etapa (CS)',
                                'options' => $usersCs,
                                'multiple' => true,
                                'class' => 'chosen-select col-lg-16 col-md-16',
                                'data-placeholder' => 'Escolha suas opções',
                                'value' => @$sociais_cs
                            ));
                            ?>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <?=
                            $this->Form->input('social_cliente', array(
                                'label' => '5ª etapa (Cliente)',
                                'options' => $usersCliente,
                                'multiple' => true,
                                'class' => 'chosen-select col-lg-16 col-md-16',
                                'data-placeholder' => 'Escolha suas opções',
                                'value' => @$sociais_cliente
                            ));
                            ?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-block">
                    <center><?= $this->Form->button(__('Salvar'), ['class' => 'btn btn-primary']) ?></center>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
