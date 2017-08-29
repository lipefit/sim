<div class="sidebar-left">
    <div class="user-menu-items">
        <div class="list-unstyled btn-group">
            <button class="media btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                <!--<span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="<?= $profile['name'] . " " . $profile['surname']; ?>"></span>--> 
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
                <?php
                if ($cliente_id_cookie == $masterClient) {
                    ?>
                    <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'cliente'; ?>"><i class="fa fa-building"></i> Clientes</a></li>
                <?php } ?>
<!--                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-list"></i> Planos</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-money"></i> Financeiro</a></li>-->
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'aprovacoes'; ?>"><i class="fa fa-check"></i> Aprovações</a></li>
                <!--<li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-unlock"></i> Permissões de Acesso</a></li>-->
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'sincronizacao'; ?>"><i class="fa fa-chain"></i> Conectar Midias</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'wordpress'; ?>"><i class="fa fa-wordpress"></i> Sincronizar Wordpress</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'google'; ?>"><i class="fa fa-google"></i> Google Analytics</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-envelope"></i> Notificações</a></li>
            </ul>
        </li>
        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Contrato<i class="fa fa-angle-down "></i></a>
            <ul class="nav flex-column nav-second-level ">
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'escopos'; ?>"><i class="fa fa-gavel"></i> Escopo</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'premissas'; ?>"><i class="fa fa-list-alt"></i> Premissas</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'acessos'; ?>"><i class="fa fa-lock"></i> Acessos</a></li>
            </ul>
        </li>
        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Briefing<i class="fa fa-angle-down "></i></a>
            <ul class="nav flex-column nav-second-level ">
                <li class="nav-item"><a href="<?= $this->request->webroot . 'canvas'; ?>" class="nav-link"><i class="fa fa-th-large"></i> Canvas</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'checklists'; ?>"><i class="fa fa-check-square-o"></i> Check list</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'identidades'; ?>"><i class="fa fa-photo"></i> Identidade Visual</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'personas'; ?>"><i class="fa fa-group"></i> Persona da Marca</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'concorrentes'; ?>"><i class="fa fa-eye"></i> Concorrentes</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'referencias'; ?>"><i class="fa fa-copy"></i> Referências</a></li>


            </ul>
        </li>
        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Planejamento<i class="fa fa-angle-down "></i></a>
            <ul class="nav flex-column nav-second-level ">
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'objetivos'; ?>"><i class="fa fa-sun-o"></i> Objetivos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'personapublicos'; ?>"><i class="fa fa-group"></i> Persona do Públ. Alvo</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'palavras'; ?>"><i class="fa fa-key"></i> Palavras-chaves</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'taticas'; ?>"><i class="fa fa-external-link"></i> Tática de Conteúdo</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'diagnosticos'; ?>"><i class="fa fa-tasks"></i> Diagnóstico</a></li>
            </ul>
        </li>
        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Estratégia<i class="fa fa-angle-down "></i></a>
            <ul class="nav flex-column nav-second-level ">
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'projetos'; ?>"><i class="fa fa-tasks"></i> Projetos</a></li>
            </ul>
        </li>
        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Execução<i class="fa fa-angle-down "></i></a>
            <ul class="nav flex-column nav-second-level ">
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'pautas'; ?>"><i class="fa fa-file-text"></i> Pautas de conteúdo</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'conteudos'; ?>"><i class="fa fa-file-text"></i> Conteúdos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'sociais'; ?>"><i class="fa fa-file-text"></i> Mídias sociais</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'quiz'; ?>"><i class="fa fa-question"></i> Quiz</a></li>
            </ul>
        </li>
        <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Gestão<i class="fa fa-angle-down "></i></a>
            <ul class="nav flex-column nav-second-level ">
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'calendario'; ?>"><i class="fa fa-calendar"></i> Calendário editorial</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'calendariototal'; ?>"><i class="fa fa-calendar"></i> Calendário total</a></li>
                <!--<li class="nav-item"><a class="nav-link" href="<?= $this->request->webroot . 'calendarioprojetos'; ?>"><i class="fa fa-calendar"></i> Calendário de projetos</a></li>-->
            </ul>
        </li>
        <li class="nav-item"> <a href="<?= $this->request->webroot . 'solicitacoes'; ?>" class="nav-link"><i class="fa fa-plus"></i>Solicitações</a></li>
        <li class="nav-item"> <a href="<?= $this->request->webroot . 'anexos'; ?>" class="nav-link"><i class="fa fa-paperclip "></i>Anexos</a></li>
    </ul>
</div>