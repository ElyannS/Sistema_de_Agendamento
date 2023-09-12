<?php

namespace App\Controller;

use App\Model\Barbeiro;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;
use App\Model\Servico;

final class HomeController
{
    public function home(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $servicos = new Servico();
        $data['servicos'] = $servicos->selectServico('*', array(1 => '1'));

        $data['informacoes'] = array(
            'pagina' => "Home"

        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "home.php", $data);
    }
    public function minha_barbearia(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $data['informacoes'] = array(
            'pagina' => "Minha Barbearia"
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "minha_barbearia.php", $data);
    }

    public function servicos(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) { 
        $servicos = new Servico();
        $data['servicos'] = $servicos->selectServico('*', array(1 => '1'));

        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);

        $data['informacoes'] = array(
            'pagina' => 'Nossos Serviços',
            'descricao' => 'Aqui vem a descricao da página servicos'
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "servicos.php", $data);
    }
    public function barbeiros(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) { 
        $barbeiros = new Barbeiro();
        $data['barbeiros'] = $barbeiros->selectServico('*', array('status' => 's'));

        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);

        $data['informacoes'] = array(
            'pagina' => 'barbeiros',
            'descricao' => 'Aqui vem a descricao da página servicos'
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "servicos.php", $data);
    }
    public function blog(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $data['informacoes'] = array(
            'pagina' => "Blog",
            'descricao' => 'Aqui vem a descricao da página blog',
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "blog.php", $data);
    }
    public function fale_conosco(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $data['informacoes'] = array(
            'pagina' => "Fale Conosco",
            'descricao' => 'Aqui vem a descricao da página fale Conosco'
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "fale_conosco.php", $data);
    }
    public function page(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        $data['informacoes'] = array(
        'pagina' =>  "Como fazer a barba em casa",
        'descricao' => "Aqui vem a descrição"
        );
        
        return $renderer->render($response, "blog_detalhe.php", $data);
    }
    public function agenda(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
       
        $data['informacoes'] = array(
        'pagina' =>  "Agendamento",
        'descricao' => "Aqui vem a descrição"
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "agenda.php", $data);
    }
};
