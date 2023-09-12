<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Agenda</title>
    <link rel="icon" type="image/png" href="<?=URL_BASE?>resources/imagens/logoaba.png"/>
    <link href="<?=URL_BASE?>resources/css/css.css" rel="stylesheet"/>
    <link href="<?=URL_BASE?>resources/fonts/fontawesome/css/all.min.css" rel="stylesheet"/>
</head>
<body class="admin">
	<header>
        <div class="container">
            <div class="left">
                <a href="#">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
            <div class="right">
                <div class="menu">
                    <ul>
                        <li>
                            <?=$_SESSION['usuario_logado']['nome']?>
                            <i class="fas fa-sort-down"></i>
                            <img src="<?=URL_BASE.$_SESSION['usuario_logado']['foto_usuario']?>">

                            <ul class="dropdown"> 
                                <li><a href="<?=URL_BASE?>admin/perfil">Perfil</a></li>
                                <li><a href="<?=URL_BASE?>admin/site">Configurações</a></li>
                                <li><a href="<?=URL_BASE?>admin/logout">Sair</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="menu_lateral">
            <div class="top">
            <img src="<?=URL_BASE.$data['informacoes']['nome_logo']?>" alt="">
                <hr>
                <ul>
                    <li class="<?=($data['informacoes']['menu_active'] === 'dashboard') ? 'active' : ''?>">
                        <a href="<?=URL_BASE?>dashboard">
                            <i class="fas fa-chart-area"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nome_categoria">
                        Conteúdo
                    </li>
                    <li class="<?=($data['informacoes']['menu_active'] === 'agendamentos') ? 'active' : ''?>">
                        <a href="<?=URL_BASE?>admin/agendamentos">
                        <i class="fa-regular fa-calendar"></i>
                            Agenda
                        </a>
                    </li>
                    <li class="<?=($data['informacoes']['menu_active'] === 'servicos') ? 'active' : ''?>">
                        <a href="<?=URL_BASE?>admin/servicos">
                            <i class="fas fa-wrench"></i>
                            Serviços
                        </a>
                    </li>
                    <li class="<?=($data['informacoes']['menu_active'] === 'barbeiros') ? 'active' : ''?>">
                        <a href="<?=URL_BASE?>admin/barbeiros">
                        <i class="fa-solid fa-user"></i>
                            Barbeiros
                        </a>
                    </li>
                    <li class="nome_categoria">
                        Configurações
                    </li>
                    <li class="<?=($data['informacoes']['menu_active'] === 'perfil') ? 'active' : ''?>">
                        <a href="<?=URL_BASE?>admin/perfil">
                            <i class="fas fa-user"></i>
                            Usuário
                        </a>
                    </li>
                    <li class="<?=($data['informacoes']['menu_active'] === 'site') ? 'active' : ''?>">
                        <a href="<?=URL_BASE?>admin/site">
                            <i class="fas fa-cogs"></i>
                            Site
                        </a>
                    </li>  <li>
                        <a href="<?=URL_BASE?>admin/logout">
                            <i class="fas fa-sign-out-alt"></i>
                            Sair
                        </a>
                    </li>
                </ul>
            </div>
            <div class="bottom">
                <div class="copy">
					Todos direitos reservados &copy <?=date('Y')?>
				</div>
				<div class="dev">
					Desenvolvido por Elyann S
					<a href="https://www.instagram.com/elyann_soares/" target="_blank">
							<i class="fa-brands fa-instagram"></i>
					</a>
				</div>
            </div>
            <div class="close">
                <i class="fas fa-times"></i>
            </div>
        </div>
	</header>
    <div class="conteudo">
