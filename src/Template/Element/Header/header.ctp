<?php
$clientList;
foreach ($_clientes as $cliente) {
    $clientList[$cliente['id']] = $cliente['nomeFantasia'];
}
?>
<header class="navbar-fixed">
    <nav class="navbar navbar-toggleable-md navbar-inverse bg-faded">
        <div class="sidebar-left"> 
            <?= $this->Html->link('', '/dashboard', ['class' => 'navbar-brand imglogo']); ?>
            <button class="btn btn-link icon-header mr-sm-2 pull-right menu-collapse" ><span class="fa fa-bars"></span></button>
        </div>
        <div class="d-flex mr-auto"> &nbsp;</div>
        <ul class="navbar-nav content-right">
            <li class="v-devider"></li>
            <li class="nav-item active">
                <button class="btn-link btn userprofile"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="text"><?php echo $clientList[$cliente_id_cookie]; ?></span>
                </button>
                <div class="dropdown-menu message-container">
                    <div class="list-unstyled">
                        <?php foreach ($clientList as $k => $cliente): ?>
                            <?php
                            echo $this->Html->link($this->Html->tag('h6', $cliente, array('class' => 'mt-0 mb-1')), '/cliente/altera_sessao/' . $k, ['class' => 'media', 'escape' => false]);
                            ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </li>
            <li class="nav-item active">
                <button class="btn btn-link icon-header "  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-envelope-o"></span> <span class="badge-number bg-success"></span></button>
                <div class="dropdown-menu message-container">
                    <div class="list-unstyled"> 
<!--                        <a href="#" class="media"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"></span>
                            <div class="media-body">
                                <h6 class="mt-0 mb-1">Dhananjay Chauhan</h6>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. </div>
                        </a> 
                        <a href="#" class="media"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"></span>
                            <div class="media-body">
                                <h6 class="mt-0 mb-1">Max Smith</h6>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. </div>
                        </a> 
                        <a href="#" class="media"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"></span>
                            <div class="media-body">
                                <h6 class="mt-0 mb-1">Astha Smith</h6>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. </div>
                        </a> 
                        <a href="#" class="media"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"></span>
                            <div class="media-body">
                                <h6 class="mt-0 mb-1">Tommy Cruszii</h6>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. </div>
                        </a> 
                        <a href="#" class="media"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"></span>
                            <div class="media-body">
                                <h6 class="mt-0 mb-1">Max Smith</h6>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. </div>
                        </a> -->
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <button class="btn btn-link icon-header badgeCircle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-bell-o"></span><span class="badge-number bg-danger"></span></button>
                <div class="dropdown-menu message-container">
                    <div class="list-unstyled">
<!--                        <div class="media"> <span class="alert-block bg-primary"><span class="fa fa-bullhorn"></span></span>
                            <div class="media-body"><b>Max Smith</b> updated post of <b>Astha Smith</b>. Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</div>
                        </div>
                        <div class="media"> <span class="alert-block bg-warning"><span class="fa fa-bell-o"></span></span>
                            <div class="media-body"><b>Max Smith</b> updated post of <b>Astha Smith</b>. Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</div>
                        </div>
                        <div class="media"> <span class="alert-block bg-danger"><span class="fa fa-exclamation-triangle"></span></span>
                            <div class="media-body"><b>Max Smith</b> updated post of <b>Astha Smith</b>. Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</div>
                        </div>
                        <div class="media">
                            <div class="media-body"><b>Max Smith</b> updated post of <b>Astha Smith</b>. Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</div>
                        </div>
                        <div class="media">
                            <div class="media-body"><b>Max Smith</b> updated post of <b>Astha Smith</b>. Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</div>
                        </div>-->
                    </div>
                </div>
            </li>
        </ul>
        <div class="sidebar-right pull-right " >
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item">
                    <button class="btn-link btn userprofile"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="text"><?=$profile['name']." ".$profile['surname'];?></span>
                    </button>
                </li>
                <li>
                    <?= $this->Html->link($this->Html->tag('span', '', array('class' => 'fa fa-sign-out')), '/users/logout', ['class' => 'btn btn-link icon-header', 'escape' => false]); ?>
                </li>
            </ul>
        </div>
    </nav>
</header>
