<div class="sidebar-left">
    <div class="user-menu-items">
        <div class="list-unstyled btn-group">
            <button class="media btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"></span> 
                <span class="media-body"> <span class="mt-0 mb-1">Aquiles Casabona</span> <small><?=$authUser['username'];?> </small> </span> 
            </button>
            <div class="dropdown-menu"> 
                <a class="dropdown-item" href="#">Profile</a> 
                <a class="dropdown-item" href="#">Redes Sociais</a> 
            </div>
        </div>
    </div>
    <br>
    <ul class="nav flex-column in" id="side-menu">
        <li class="nav-item "> <?= $this->Html->link('Dashboard', '/dashboard', ['class' => 'nav-link']); ?></li>
        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Administração<i class="fa fa-angle-down "></i></a>
            <ul class="nav flex-column nav-second-level ">
                <li class="nav-item"><a href="<?=$this->request->webroot.'groups';?>" class="nav-link"><i class="fa fa-check-square-o"></i> Grupos</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-check-square-o"></i> Usuários</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=$this->request->webroot.'cliente';?>"><i class="fa fa-check-square-o"></i> Clientes</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-check-square-o"></i> Planos</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-check-square-o"></i> Financeiro</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-check-square-o"></i> Aprovações</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-check-square-o"></i> Permissões de Acesso</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-check-square-o"></i> Conectar Midias</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-check-square-o"></i> Sincronizar Wordpress</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-check-square-o"></i> Google Analytics</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-check-square-o"></i> Lembretes</a></li>
            </ul>
        </li>
        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Estratégia de Projeto<i class="fa fa-angle-down "></i></a>
            <ul class="nav flex-column nav-second-level ">
                <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-check-square-o"></i> Canvas</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-check-square-o"></i> Check list</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-check-square-o"></i> Premissas</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-check-square-o"></i> Projeto</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-check-square-o"></i> Campanhas</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-check-square-o"></i> Palavras-chaves</a></li>
            </ul>
        </li>
    </ul>
</div>
