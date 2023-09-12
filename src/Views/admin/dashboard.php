<?=$this->fetch('commons/header.php', $data)?>
<section class="dashboard">
    <div class="container">
        <div class="titulo_pagina">
        <i class="fas fa-chart-area"></i> Dashboard
        </div>
        <div class="descricao">
            <p>Seja muito bem-vindo de volta <?=$_SESSION['usuario_logado']['nome']?>!</p>
            <p>Esse é o painel administrativo do seu Site. Aqui você poderá cadastrar novos Serviços, Vídeos, Notícias no Blog
             e novos comentários de clientes satisfeitos com seus serviços</p>
            <p>Todos esses itens são exebidos no site por ordem de data, então sempre que cadastrar um novo item precisará informar a data que ele seja listado
            no site da forma correta. Por exemplo: se você cadastrou uma notícia com a data de ontem, mas esqueceu de cadastrar a notícia do dia anterior, pode cadastrar normal,
            é só colocar a notícia anterior com uma data mais antiga. Sendo assim a listagem é definida como sempre exibindo primeiro as mais recentes, isso funciona para todos os itens
            que são cadastrados</p>
            <p>Tenha um execelente dia, e estamos aqui para te ajudar se necessário, equipe de desenvolvimento.</p>
        </div>
    </div>
</section>
<?=$this->fetch('commons/footer.php')?>