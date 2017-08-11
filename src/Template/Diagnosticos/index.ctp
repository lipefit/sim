<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-tasks"></i> <?= __('Diagnóstico') ?></h3>
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
                    <h6 class="card-title"><?= __('Editar diagnóstico') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($diagnostico) ?>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <center><h5>Insira a posição atual do seu cliente e acompanhe mensalmente o resultado</h5></center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="site">Site </label>
                                <?= $this->Form->control('site', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Site', 'type' => 'text']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="acesso">Quantidade de acessos no site?</label>
                                <?= $this->Form->control('acesso', ['label' => false, 'class' => 'form-control']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="palavras">Quantas palavras-chaves estão indexadas?</label>
                                <?= $this->Form->control('palavras', ['label' => false, 'class' => 'form-control']); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="responsivo">Site é responsivo?</label>
                                <?= $this->Form->control('responsivo', ['label' => false, 'class' => 'form-control', 'options' => $respostas]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="cta">O site já possui CTA´s?</label>
                                <?= $this->Form->control('cta', ['label' => false, 'class' => 'form-control', 'options' => $respostas]); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="backlinks">Quantidade de Backlinks? </label>
                                <?= $this->Form->control('backlinks', ['label' => false, 'class' => 'form-control']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="adwords">Google Adwords?</label>
                                <?= $this->Form->control('adwords', ['label' => false, 'class' => 'form-control', 'options' => $respostas]); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="acessoria">Tem Assessoria de Imprensa? </label>
                                <?= $this->Form->control('acessoria', ['label' => false, 'class' => 'form-control', 'options' => $respostas]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <label for="sociais">Quais Redes Sociais ele está Presente? </label>
                            <div class="btn-group" data-toggle="buttons" style="margin-left: 30px;">
                                <?php
                                $active = "";
                                if (@$diagnostico->facebook == 1) {
                                    $active = "active";
                                }
                                ?>
                                <label class="btn btn-primary <?= $active; ?>">
                                    <?= $this->Form->checkbox('facebook', ['label' => false, 'autocomplete' => 'off']); ?> <i class="fa fa-facebook"></i>
                                </label>
                                <?php
                                $active = "";
                                if (@$diagnostico->googleplus == 1) {
                                    $active = "active";
                                }
                                ?>
                                <label class="btn btn-primary <?= $active; ?>">
                                    <?= $this->Form->checkbox('googleplus', ['label' => false, 'autocomplete' => 'off']); ?> <i class="fa fa-google-plus"></i>
                                </label>
                                <?php
                                $active = "";
                                if (@$diagnostico->instagram == 1) {
                                    $active = "active";
                                }
                                ?>
                                <label class="btn btn-primary <?= $active; ?>">
                                    <?= $this->Form->checkbox('instagram', ['label' => false, 'autocomplete' => 'off']); ?> <i class="fa fa-instagram"></i>
                                </label>
                                <?php
                                $active = "";
                                if (@$diagnostico->linkedin == 1) {
                                    $active = "active";
                                }
                                ?>
                                <label class="btn btn-primary <?= $active; ?>">
                                    <?= $this->Form->checkbox('linkedin', ['label' => false, 'autocomplete' => 'off']); ?> <i class="fa fa-linkedin"></i>
                                </label>
                                <?php
                                $active = "";
                                if (@$diagnostico->twitter == 1) {
                                    $active = "active";
                                }
                                ?>
                                <label class="btn btn-primary <?= $active; ?>">
                                    <?= $this->Form->checkbox('twitter', ['label' => false, 'autocomplete' => 'off']); ?> <i class="fa fa-twitter"></i>
                                </label>
                                <?php
                                $active = "";
                                if (@$diagnostico->youtube == 1) {
                                    $active = "active";
                                }
                                ?>
                                <label class="btn btn-primary <?= $active; ?>">
                                    <?= $this->Form->checkbox('youtube', ['label' => false, 'autocomplete' => 'off']); ?> <i class="fa fa-youtube"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <label for="quantidade">Quantidade de seguidores em cada rede acima? </label>
                            <div class="row">
                                <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                        <label for="seg_facebook">Facebook </label>
                                        <?= $this->Form->control('seg_facebook', ['label' => false, 'class' => 'form-control']); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                        <label for="seg_googleplus">Google + </label>
                                        <?= $this->Form->control('seg_googleplus', ['label' => false, 'class' => 'form-control']); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                        <label for="seg_instagram">Instagram </label>
                                        <?= $this->Form->control('seg_instagram', ['label' => false, 'class' => 'form-control']); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                        <label for="seg_linkedin">Linkedin </label>
                                        <?= $this->Form->control('seg_linkedin', ['label' => false, 'class' => 'form-control']); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                        <label for="seg_twitter">Twitter </label>
                                        <?= $this->Form->control('seg_twitter', ['label' => false, 'class' => 'form-control']); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                        <label for="seg_youtube">Youtube </label>
                                        <?= $this->Form->control('seg_youtube', ['label' => false, 'class' => 'form-control']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group">
                                <label for="consideracoes">Considerações </label>
                                <?= $this->Form->control('consideracoes', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Considerações']); ?>
                            </div>
                        </div>
                    </div>

                    <center><?= $this->Form->button(__('Salvar'), ['class' => 'btn btn-primary']) ?></center>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>