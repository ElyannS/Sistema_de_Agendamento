<?=$this->fetch('../commons/header.php', $data)?>
<section class="dashboard">
    <div class="container">
        <div class="titulo_pagina">
        <i class="fas fa-wrench"></i> Serviços
        </div>

        <div class="topo">
            <div class="btn">
                <a href="<?=URL_BASE?>admin/servicos-create">Cadastrar novo</a>
            </div>
            <div class="form_pesquisa">
                <form action="<?=URL_BASE?>admin/servicos" method="GET">
                    <input type="text" name="pesquisa" placeholder="Titulo do item...">
                    <button type="submit">Pesquisar</button>
                </form>
            </div>
        </div> 
        <div class="lista">
            <table>
                <thead>
                    <tr>
                        <td class="id">ID</td>
                        <td class="acao">AÇÕES</td>
                        <td class="titulo_item">TÍTULO</td>
                        <td class="data">DATA DE CADASTRO</td>
                    </tr>
                </thead>
                <tbody> 
                    <?php
                        foreach($data['informacoes']['lista'] as $servico) {?>
                    <tr>
                        <td class="id"><?=$servico['id']?></td>
                        <td class="acao">
                            <a href="<?=URL_BASE?>admin/servicos-edit/<?=$servico['id']?>"><i class="far fa-edit"></i></a>

                            <form action="<?=URL_BASE?>admin/servicos_delete" method="post">
                                <input type="hidden" name="id" value="<?=$servico['id']?>">
                                <button type="submit"><i class="fa-solid fa-trash"></i></i></button>
                            </form>
                        </td>
                        <td class="titulo_item"><?=$servico['titulo']?></td>
                        <td class="data"><?=date("d/m/Y", strtotime($servico['data_cadastro']))?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="paginacao">
                <?php if(isset($data['informacoes']['paginaAnterior']) && $data['informacoes']['paginaAnterior'] !== false){?>
                    <a href="<?=$data['informacoes']['paginaAnterior'] ?>"><i class="fas fa-arrow-circle-left"></i></a>
                <?php }?>
                
                <span><?=$data['informacoes']['paginaAtual']?></span>

                <?php if(isset($data['informacoes']['proximaPagina']) && $data['informacoes']['proximaPagina'] !== false){?>
                    <a href="<?=$data['informacoes']['proximaPagina'] ?>"> <i class="fas fa-arrow-circle-right"></i></a>
                <?php }?>
            </div>
        </div>
    </div>
</section>
<?=$this->fetch('../commons/footer.php')?>