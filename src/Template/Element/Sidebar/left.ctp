<div class="sidebar-left">
    <div class="user-menu-items">
        <div class="list-unstyled btn-group">
            <button class="media btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"></span> 
                <span class="media-body"> <span class="mt-0 mb-1"><?= $profile['name'] . " " . $profile['surname']; ?></span> <small><?= $authUser['username']; ?> </small> </span> 
            </button>
            <div class="dropdown-menu"> 
                <a class="dropdown-item" href="<?= $this->request->webroot . 'profiles'; ?>">Perfil</a> 
                <a class="dropdown-item" href="#">Alterar Senha</a> 
            </div>
        </div>
    </div>
    <br>
    <ul class="nav flex-column in" id="side-menu">
        <li class="nav-item "> <?= $this->Html->link('Dashboard', '/dashboard', ['class' => 'nav-link']); ?></li>
        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Administração<i class="fa fa-angle-down "></i></a>
            <ul class="nav flex-column nav-second-level ">
                <li class="nav-item"><a href="<?= $this->request->webroot . 'groups'; ?>" class="nav-link"><i class="fa fa-users"></i> Grupos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'users'; ?>"><i class="fa fa-user"></i> Usuários</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'cliente'; ?>"><i class="fa fa-building"></i> Clientes</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-list"></i> Planos</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-money"></i> Financeiro</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-check"></i> Aprovações</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-unlock"></i> Permissões de Acesso</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-chain"></i> Conectar Midias</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-wordpress"></i> Sincronizar Wordpress</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-google-plus"></i> Google Analytics</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-bell"></i> Lembretes</a></li>
            </ul>
        </li>
        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Contrato<i class="fa fa-angle-down "></i></a>
            <ul class="nav flex-column nav-second-level ">
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'escopos'; ?>"><i class="fa fa-gavel"></i> Escopo</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'premissas'; ?>"><i class="fa fa-list-alt"></i> Premissas</a></li>
            </ul>
        </li>
        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Briefing<i class="fa fa-angle-down "></i></a>
            <ul class="nav flex-column nav-second-level ">
<!--                <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-th-large"></i> Canvas</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-check-square-o"></i> Check list</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-folder"></i> Projeto</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-file"></i> Campanhas</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-key"></i> Palavras-chaves</a></li>-->
            </ul>
        </li>
        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Planejamento<i class="fa fa-angle-down "></i></a>
            <ul class="nav flex-column nav-second-level ">
                
            </ul>
        </li>
        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Estratégia<i class="fa fa-angle-down "></i></a>
            <ul class="nav flex-column nav-second-level ">
                
            </ul>
        </li>
        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Execução<i class="fa fa-angle-down "></i></a>
            <ul class="nav flex-column nav-second-level ">
                
            </ul>
        </li>
        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Gestão<i class="fa fa-angle-down "></i></a>
            <ul class="nav flex-column nav-second-level ">
                
            </ul>
        </li>
        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Solicitações<i class="fa fa-angle-down "></i></a>
            <ul class="nav flex-column nav-second-level ">
                
            </ul>
        </li>
        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Anexos<i class="fa fa-angle-down "></i></a>
            <ul class="nav flex-column nav-second-level ">
                
            </ul>
        </li>
    </ul>
</div>
