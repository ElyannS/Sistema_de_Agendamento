<?php
use Slim\App;
return function (App $app) {
    //CONTROLADOR ADMIN
    $app->get('/admin-login', '\App\Controller\AdminController:login');
    $app->get('/dashboard', '\App\Controller\AdminController:dashboard');
    $app->get('/admin/perfil', '\App\Controller\AdminController:perfil');
    $app->get('/admin/site', '\App\Controller\AdminController:site');
    $app->get('/admin/logout', '\App\Controller\AdminController:logout');
    $app->post('/admin/perfil_update', '\App\Controller\AdminController:perfil_update');
    $app->post('/admin/login', '\App\Controller\AdminController:verificar_login');
    $app->post('/admin/site_update', '\App\Controller\AdminController:site_update');

     //CONTROLADOR SERVIÇOS
     $app->get('/admin/servicos', '\App\Controller\ServicoController:servicos');
     $app->get('/admin/servicos-create', '\App\Controller\ServicoController:servicos_create');
     $app->get('/admin/servicos-edit/{id}', '\App\Controller\ServicoController:servicos_edit');
     $app->post('/admin/servicos_insert', '\App\Controller\ServicoController:servicos_insert');
     $app->post('/admin/servicos_update', '\App\Controller\ServicoController:servicos_update');
     $app->post('/admin/servicos_delete', '\App\Controller\ServicoController:servicos_delete');
 
    //CONTROLADOR BARBEIROS
    $app->get('/admin/barbeiros', '\App\Controller\BarbeiroController:barbeiros');
    $app->get('/admin/barbeiros-create', '\App\Controller\BarbeiroController:barbeiros_create');
    $app->get('/admin/barbeiros-edit/{id}', '\App\Controller\BarbeiroController:barbeiros_edit');
    $app->post('/admin/barbeiros_insert', '\App\Controller\BarbeiroController:barbeiros_insert');
    $app->post('/admin/barbeiros_update', '\App\Controller\BarbeiroController:barbeiros_update');
    $app->post('/admin/barbeiros_delete', '\App\Controller\BarbeiroController:barbeiros_delete');

     //CONTROLADOR AGENDAMENTO
     $app->get('/admin/agendamentos', '\App\Controller\AgendamentoController:agendamentos');
     $app->get('/admin/agendamentos-create', '\App\Controller\AgendamentoController:agendamentos_create');
     $app->get('/admin/agendamentos-edit/{id}', '\App\Controller\AgendamentoController:agendamentos_edit');
     $app->post('/admin/atualizar_horarios', '\App\Controller\AgendamentoController:atualizar_horarios');
     $app->post('/admin/atualizar_data', '\App\Controller\AgendamentoController:atualizar_data');
     $app->post('/admin/agendamentos_insert', '\App\Controller\AgendamentoController:agendamentos_insert');
     $app->post('/admin/agendamentos_update', '\App\Controller\AgendamentoController:agendamentos_update');
     $app->post('/admin/agendamentos_delete', '\App\Controller\AgendamentoController:agendamentos_delete');

   
};
