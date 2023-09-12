<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;
use App\Model\Agendamento;
use App\Model\Barbeiro;
use App\Model\Servico;
use App\Model\Configuracao;
use App\Model\Usuario;

final class AgendamentoController 
{
     
    public function agendamentos (
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        Usuario::verificarLogin();

        $agendamentos = new Agendamento();

        $consultaAgendamentos  = $agendamentos->selectAgendamento('*', array('*'));

        $barbeiros = new Barbeiro();

        $resultado = $barbeiros->selectBarbeiro('*', array('*'));

        $config = new Configuracao();
        $nome_logo_site = $config->getConfig('logo_site');
        

        $data['informacoes'] = array(
            'menu_active' => 'agendamentos',
            'agendamento' => $consultaAgendamentos,
            'barbeiro' => $resultado,
            'nome_logo' => $nome_logo_site
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN."/agendamento");
        return $renderer->render($response, "agendamentos.php", $data);
    }
    public function atualizar_horarios(
        ServerRequestInterface $request,
        ResponseInterface $response
    ) {
        $data = '';
        $tempoServico = '';
        $horarios = [];
    
        if ($request->getMethod() === 'POST') {
            $params = $request->getParsedBody();
            if (isset($params['data']) && isset($params['tempoServico'])) {
                $data = $params['data'];
                $tempoServico = $params['tempoServico'];
    
                // Verificar se a data é domingo ou segunda-feira
                $diaSemana = date('w', strtotime($data));
                if ($diaSemana == 0 || $diaSemana == 1) {
                    $responseData =  ['horarios' => 'fechada'];
                    $response = $response->withHeader('Content-Type', 'application/json');
                    $response->getBody()->write(json_encode($responseData));
                    return $response;
                }

                // Definir os horários de trabalho para terça a sexta-feira e sábado
                $horariosTrabalho = [];
                if ($diaSemana == 6) { // Sábado
                    $horariosTrabalho = [
                        '09:00', '09:30', '10:00', '10:30', '11:00',
                        '11:30', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00'
                    ];
                } elseif ($diaSemana >= 2 && $diaSemana <= 4) { // Terça a Quinta
                    $horariosTrabalho = [
                        '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30'
                    ];
                } elseif ($diaSemana == 5) { // Sexta
                    $horariosTrabalho = [
                        '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '13:30', '14:00',
                        '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30'
                    ];
                }
                $agendamentos = new Agendamento();
                $consultaAgendamentos = $agendamentos->selectAgendamentoData($data);

                $horariosIndisponiveis = [];
                foreach ($consultaAgendamentos as $agendamento) {
                    $horariosIndisponiveis[] = date('H:i', strtotime($agendamento['data_agendamento']));
                    $horarioAtual = $agendamento['servico_id'];

                    // Verificar se o agendamento é de "Corte e barba" (id 2)
                    if ($horarioAtual == 2) {
                        $proximoHorario = date('H:i', strtotime($agendamento['data_agendamento']) + 1800);
                        $horariosIndisponiveis[] = $proximoHorario;
                    }
                }
 
                // Se não há horários indisponíveis, todos os horários de trabalho são considerados disponíveis
                if (empty($horariosIndisponiveis)) {
                    $horarios = $horariosTrabalho;
                } else {
                    $horarios = [];
                    foreach ($horariosTrabalho as $horario) { 
                        // Verificar se o horário está indisponível 
                        if (in_array($horario, $horariosIndisponiveis)) {
                            continue; 
                        } 
                
                        // Verificar se o horário é válido para o tempo de serviço selecionado
                        if ($tempoServico == 30) {
                            // Verificar se o próximo horário também está disponível
                            $proximoHorario = date('H:i', strtotime($horario));
                            if (!in_array($proximoHorario, $horariosIndisponiveis)) {
                                $horarios[] = $horario;
                            }
                        } elseif ($tempoServico == 60) {
                            // Verificar se o horário e o próximo horário estão disponíveis
                            $proximoHorario = date('H:i', strtotime($horario));
                            $horarioFinal = date('H:i', strtotime($horario) + 1800);
                
                            // Verificar se o horário e o próximo horário estão disponíveis e se não estão ocupados por um agendamento de "Corte e barba"
                            if (!in_array($proximoHorario, $horariosIndisponiveis) && !in_array($horarioFinal, $horariosIndisponiveis)) {
                                // Verificar se o horário ou o próximo horário estão ocupados por um agendamento de "Corte e barba"
                                $horarioOcupado = false;
                                foreach ($horariosIndisponiveis as $horarioIndisponivel) {
                                    if ($horarioIndisponivel == $horario || $horarioIndisponivel == $proximoHorario) {
                                        $horarioOcupado = true;
                                        break;
                                    }
                                }
                
                                if (!$horarioOcupado) {
                                    $horarios[] = $horario;
                                }
                            }
                        }
                    }
                }                
            }
        }
    
        $responseData = ['horarios' => $horarios];
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($responseData));
        return $response;
    }
    
    public function atualizar_data(
        ServerRequestInterface $request, 
        ResponseInterface $response
        )
    {
        $data = '';
        $horarios = [];

        if ($request->getMethod() === 'POST') {
            $params = $request->getParsedBody();
            if (isset($params['data'])) {
                $data = $params['data'];

                // Verificar se a data é domingo ou segunda-feira
                $diaSemana = date('w', strtotime($data));
                if ($diaSemana == 0 || $diaSemana == 1) {
                    $responseData =  ['horarios' => 'fechada'];
                    $response = $response->withHeader('Content-Type', 'application/json');
                    $response->getBody()->write(json_encode($responseData));
                    return $response;
                }

                // Definir os horários de trabalho para terça a sexta-feira e sábado
                $horariosTrabalho = [];
                if ($diaSemana == 6) { // Sábado
                    $horariosTrabalho = [
                        '09:00', '09:30', '10:00', '10:30', '11:00',
                        '11:30', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00'
                    ];
                } elseif ($diaSemana >= 2 && $diaSemana <= 4) { // Terça a Quinta
                    $horariosTrabalho = [
                        '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30'
                    ];
                } elseif ($diaSemana == 5) { // Sexta
                    $horariosTrabalho = [
                        '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '13:30', '14:00', 
                        '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30'
                    ];
                }

                $agendamentos = new Agendamento();
                $consultaAgendamentos = $agendamentos->selectAgendamentoData($data);

                $horariosIndisponiveis = [];
                foreach ($consultaAgendamentos as $agendamento) {
                    $horariosIndisponiveis[] = date('H:i', strtotime($agendamento['data_agendamento']));
                }

                // Função para obter os horários disponíveis, levando em consideração o tempo de serviço selecionado
                foreach ($horariosTrabalho as $horario) {
                    $agendamentoEncontrado = false;
                    $agendamentoNome = '';
                    $nomeServico = '';
                    $idAgendamento = '';
                    
                    // Verificar se o horário está indisponível
                    if (in_array($horario, $horariosIndisponiveis)) {
                        foreach ($consultaAgendamentos as $agendamento) {
                            if (date('H:i', strtotime($agendamento['data_agendamento'])) === $horario) {
                                $agendamentoEncontrado = true;
                                $agendamentoNome = $agendamento['nome_cliente'].' - '.$agendamento['nome_servico'].' - '.$agendamento['telefone_cliente'];
                                $nomeServico = $agendamento['nome_servico'];
                                $idAgendamento = $agendamento['id'];
                                break;
                            }
                        }
                    }

                    if ($agendamentoEncontrado) {
                        $horarios[] = ['horario' => $horario, 'nome' => $agendamentoNome, 'servico' => $nomeServico, 'idAgendamento' => $idAgendamento];
                    } else {
                        $horarios[] = ['horario' => $horario, 'nome' => ''];
                    }
                }
            }
        }

    $responseData = ['horarios' => $horarios];
    $response = $response->withHeader('Content-Type', 'application/json');
    $response->getBody()->write(json_encode($responseData));
    return $response;
}

    public function agendamentos_create(
        ServerRequestInterface $request,
        ResponseInterface $response)
    {
        Usuario::verificarLogin();

        $barbeiros = new Barbeiro();

        $resultado = $barbeiros->selectBarbeiro('*', array('*'));

        $servicos = new Servico();

        $infoServicos = $servicos->selectServico('*', array('1' => 1));

        $config = new Configuracao();
        $nome_logo_site = $config->getConfig('logo_site');
        
        $data['informacoes'] = array(
            'menu_active' => 'agendamentos',
            'barbeiro' => $resultado,
            'servico' => $infoServicos,
            'nome_logo' => $nome_logo_site
            );

        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN . "/agendamento");
        return $renderer->render($response, "create.php", $data);
    }
        

    public function agendamentos_edit(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        Usuario::verificarLogin();
        
        $id = $args['id'];
        $agendamentos = new Agendamento();

        $resultado = $agendamentos->selectAgendament('*', array('id' => $id))[0];


        $config = new Configuracao();
        $nome_logo_site = $config->getConfig('logo_site');
        $data['informacoes'] = array(
            'menu_active' => 'agendamentos',
            'agendamento' => $resultado,
            'nome_logo' => $nome_logo_site
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN."/agendamento");
        return $renderer->render($response, "edit.php", $data);
    }
    public function agendamentos_insert(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    )  {
        $nome_cliente = $request->getParsedBody()['nome_cliente'];
        $telefone_cliente = $request->getParsedBody()['telefone_cliente'];
        $data = date('Y-m-d', strtotime($request->getParsedBody()['data']));
        $time = date('H:i', strtotime($request->getParsedBody()['time']));
        $select_barbeiro = $request->getParsedBody()['select_barbeiro'];
        $selectServico = $request->getParsedBody()['select_servico'];
        $valores = explode(';', $selectServico);
        $idServico = $valores[1];
        $datetime = $data . ' ' . $time;
        
        


        $campos = array(
            'nome_cliente' => $nome_cliente,
            'telefone_cliente' => $telefone_cliente,
            'data_agendamento' => $datetime,
            'servico_id' => $idServico,
            'barbeiro_id' => $select_barbeiro
        );
        
        $agendamentos = new Agendamento();
        
        $agendamentos->insertAgendamento($campos);

        header('Location: '.URL_BASE.'admin/agendamentos');
        exit();
    }


//UPDATE SERVIÇOS

    public function agendamentos_update(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $id = $request->getParsedBody()['id'];
        $nome_cliente = $request->getParsedBody()['nome_cliente'];
        $telefone_cliente = $request->getParsedBody()['telefone_cliente'];
       

        $campos = array(
            'id' => $id,
            'nome_cliente' => $nome_cliente,
            'telefone_cliente' => $telefone_cliente,
        );
        
        $agendamentos = new Agendamento();
        
        $agendamentos->updateAgendamento($campos, array('id' => $id));
        
        header('Location: '.URL_BASE.'admin/agendamentos');
        exit();
    }

    public function agendamentos_delete(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
       $id = $request->getParsedBody()['id'];

       $agendamentos = new Agendamento();

       $agendamentos->deleteAgendamento('id', $id);

       header('Location: '.URL_BASE.'admin/agendamentos');
       exit();
    }
} 