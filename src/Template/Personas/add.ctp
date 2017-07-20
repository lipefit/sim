<?php
/**
 * @var \App\View\AppView $this
 * @author Felipe Almeida
 */

use Cake\Routing\Router
?>
<div class="container">
    <div class="row  align-items-center justify-content-between">
        <div class="col-11 col-sm-12 page-title">
            <h3><i class="fa fa-group"></i> <?= __('Persona da marca') ?></h3>
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
                    <h6 class="card-title"><?= __('Nova persona') ?></h6>
                </div>
                <div class="card-block">
                    <?= $this->Form->create($persona) ?>
                    <div class="col-lg-2 col-md-2">
                        <div class="avatar-changing">
                            <select name="data[Personas][avatar]" class="image-picker form-control">
                                <?php for ($i = 1; $i <= 20; $i++) { ?>
                                    <?php $c = ($i < 10) ? '0' . $i : $i; ?>
                                    <option data-img-src="<?php echo Router::url('/'); ?>avatar/<?php echo $c; ?>.jpg" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>

                            <a class="btn btn-info" id="avatar-menos" href="javascript:;"><span class="fa fa-arrow-left"></span></a>
                            <a class="btn btn-info" id="avatar-mais" href="javascript:;"><span class="fa fa-arrow-right"></span></a>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Html->script('/js/img_picker/image-picker.js');?>
<?= $this->Html->css('/js/img_picker/image-picker.css');?>
<script>
    var atual_avatar = 0;
    $(document).ready(function () {
        $(".image-picker").imagepicker();
        atual_avatar = $(".image-picker").val();

        $('#avatar-mais').click(function () {

            if (atual_avatar != 20) {
                atual_avatar++;
            }

            $('.image-picker').val(atual_avatar).change();
        });

        $('#avatar-menos').click(function () {
            if (atual_avatar != 1) {
                atual_avatar--;
            }
            $('.image-picker').val(atual_avatar).change();
        });
    });
</script>