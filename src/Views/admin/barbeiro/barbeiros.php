<?=$this->fetch('../commons/header.php', $data)?>
<section class="dashboard">
    <div class="container">
        <div class="titulo_pagina">
        <i class="fa-solid fa-user"></i> Barbeiros
        </div>

        <div class="topo">
            <div class="btn">
                <a href="<?=URL_BASE?>admin/barbeiros-create">Cadastrar novo</a>
            </div>
            <div class="form_pesquisa">
                <form action="<?=URL_BASE?>admin/barbeiro" method="GET">
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
                        <td class="titulo_item">NOME</td>
                        <td class="data">CARGO</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                        foreach($data['informacoes']['lista'] as $barbeiros) {?>
                    <tr>
                        <td class="id"><?=$barbeiros['id']?></td>
                        <td class="acao">
                            <a href="<?=URL_BASE?>admin/barbeiros-edit/<?=$barbeiros['id']?>"><i class="far fa-edit"></i></a>

                            <form action="<?=URL_BASE?>admin/barbeiros_delete" method="post">
                                <input type="hidden" name="id" value="<?=$barbeiros['id']?>">
                                <button type="submit"><i class="fa-solid fa-trash"></i></i></button>
                            </form>
                        </td>
                        <td class="titulo_item"><?=$barbeiros['nome']?></td>
                        <td class="data"><?=$barbeiros['cargo']?></td>
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