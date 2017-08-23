<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = 'Simarketing';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $this->Html->charset() ?>

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Simarketing - Plataforma de Marketing Digital">
        <meta name="author" content="Felipe Almeida">
        <title>
            <?= $cakeDescription ?>:
            <?= $this->fetch('title') ?>
        </title>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <!-- Fontawesome icon CSS -->
        <?= $this->Html->css('/js/font-awesome-4.7.0/css/font-awesome.min.css') ?>

        <!-- Bootstrap CSS -->
        <?= $this->Html->css('/js/bootstrap4alpha/css/bootstrap.css') ?>

        <!-- DataTables Responsive CSS -->
        <?= $this->Html->css('/js/datatables/css/dataTables.bootstrap4.css') ?>
        <?= $this->Html->css('/js/datatables/css/responsive.dataTables.min.css') ?>

        <!-- jvectormap CSS -->
        <?= $this->Html->css('/js/jquery-jvectormap/jquery-jvectormap-2.0.3.css') ?>

        <!-- Adminux CSS -->
        <?= $this->Html->css('dark_blue_adminux.css') ?>
        <?= $this->Html->css('/js/morrisjs/morris.css') ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>

        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <?= $this->Html->script('jquery-2.1.1.min.js') ?>
        <?= $this->Html->script('/js/bootstrap4alpha/js/tether.min.js') ?>
        <?= $this->Html->script('/js/bootstrap4alpha/js/bootstrap.min.js') ?>

        <!--Cookie js for theme chooser and applying it --> 
        <?= $this->Html->script('/js/cookie/jquery.cookie.js') ?>

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug --> 
        <?= $this->Html->script('ie10-viewport-bug-workaround.js') ?> <!-- slimscrolls js -->
        <?= $this->Html->script('/js/slim_scrolls/jquery.slimscroll.min.js') ?>

        <!-- Circular chart progress js -->
        <?= $this->Html->script('/js/cicular_progress/circle-progress.min.js') ?>

        <!--sparklines js-->
        <?= $this->Html->script('/js/sparklines/jquery.sparkline.min.js') ?>

        <!-- jvectormap JavaScript -->
        <?= $this->Html->script('/js/jquery-jvectormap/jquery-jvectormap.js') ?>
        <?= $this->Html->script('/js/jquery-jvectormap/jquery-jvectormap-world-mill-en.js') ?>

        <!-- chart js -->
        <?= $this->Html->script('/js/chartjs/Chart.bundle.min.js') ?>
        <?= $this->Html->script('/js/chartjs/utils.js') ?>

        <!-- spincremente js -->
        <?= $this->Html->script('/js/spincrement/jquery.spincrement.min.js') ?>

        <!-- DataTables JavaScript -->
        <?= $this->Html->script('/js/datatables/js/jquery.dataTables.min.js') ?>
        <?= $this->Html->script('/js/datatables/js/dataTables.bootstrap4.js') ?>
        <?= $this->Html->script('/js/datatables/js/dataTables.responsive.min.js') ?>

        <!-- Masked Input -->
        <?= $this->Html->script('masked.js') ?>

        <!-- custome template js -->
        <?= $this->Html->script('adminux.js') ?>
        <?= $this->Html->script('dashboard1.js') ?>

        <?= $this->Html->script('tinymce/tinymce.min.js'); ?>

        <!-- Morris Charts JavaScript --> 
        <?= $this->Html->script('/js/cicular_progress/circle-progress.min.js') ?>
        <?= $this->Html->script('/js/raphael/raphael.min.js') ?>
        <?= $this->Html->script('/js/morrisjs/morris.min.js') ?>

        <!-- Flot Charts JavaScript --> 
        <?= $this->Html->script('/js/flot/excanvas.min.js') ?>
        <?= $this->Html->script('/js/flot/jquery.flot.js') ?>
        <?= $this->Html->script('/js/flot/jquery.flot.pie.js') ?>
        <?= $this->Html->script('/js/flot/jquery.flot.resize.js') ?>
        <?= $this->Html->script('/js/flot/jquery.flot.time.js') ?>
        <?= $this->Html->script('/js/flot-tooltip/jquery.flot.tooltip.min.js') ?>

        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>
    <body class="menuclose menuclose-right">

        <?= $this->element('Loader/loader'); ?>

        <?= $this->element('Header/header'); ?>

        <?= $this->element('Sidebar/left'); ?>

        <div class="wrapper-content">
            <?= $this->Flash->render() ?>

            <?= $this->fetch('content'); ?> 
            <?= $this->element('Footer/footer'); ?>
        </div>

        <?= $this->element('Modal/pauta'); ?>
        <?= $this->element('Modal/conteudo'); ?>
    </body>
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

            $(".datepicker").datepicker();
            $(".hora").mask("99:99");

            tinymce.init({
                selector: '.tinymce',
                height: 300,
                theme: 'modern',
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools codesample responsivefilemanager'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
                image_advtab: true,
                templates: [
                    {title: 'Test template 1', content: 'Test 1'},
                    {title: 'Test template 2', content: 'Test 2'}
                ],
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tinymce.com/css/codepen.min.css'
                ],
                external_filemanager_path: "http://localhost:8765/js/tinymce/plugins/filemanager/",
                filemanager_title: "Responsive Filemanager",
                external_plugins: {"filemanager": "http://localhost:8765/js/tinymce/plugins/filemanager/plugin.min.js"}
            });
        });
    </script>
    <style>
        .dropdown-item{
            width: auto !important;
        }
    </style>
</html>
