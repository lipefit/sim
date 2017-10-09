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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Simarketing - Plataforma de Marketing Digital">
        <meta name="author" content="Felipe Almeida">
        <link rel="icon" href="../favicon.ico">
        <title>Simarketing</title>
        <!-- Fontawesome icon CSS -->
        <?= $this->Html->css('/js/font-awesome-4.7.0/css/font-awesome.min.css') ?>

        <!-- Bootstrap CSS -->
        <?= $this->Html->css('/js/bootstrap4alpha/css/bootstrap.css') ?>

        <!-- Adminux CSS -->
        <?= $this->Html->css('dark_blue_adminux.css') ?>
    </head>
    <body class="menuclose menuclose-right">
        <?= $this->element('Loader/login'); ?>

        <?= $this->element('Header/login'); ?>


        <div class="wrapper-content-sign-in ">
            <?= $this->Flash->render() ?>
            <div class="container text-center">
                <?= $this->fetch('content'); ?>
            </div>
            <?= $this->element('Footer/login'); ?>
        </div>


        <!-- jQuery first, then Tether, then Bootstrap JS. -->

        <?= $this->Html->script('jquery-2.1.1.min.js') ?>

        <?= $this->Html->script('/js/bootstrap4alpha/js/tether.min.js') ?> 

        <?= $this->Html->script('/js/bootstrap4alpha/js/bootstrap.min.js') ?> 

        <!--Cookie js for theme chooser and applying it --> 
        <?= $this->Html->script('/js/cookie/jquery.cookie.js') ?>

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug --> <script src="../js/ie10-viewport-bug-workaround.js"></script> <script>
            "use strict";
            $('input[type="checkbox"]').on('change', function () {
                $(this).parent().toggleClass("active")
                $(this).closest(".media").toggleClass("active");
            });
            $(window).on("load", function () {
                /* loading screen */
                $(".loader_wrapper").fadeOut("slow");
            });

        </script>
    </body>
</html>
