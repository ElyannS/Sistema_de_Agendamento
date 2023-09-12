<?=$this->fetch('../commons/header.php', $data)?>
<section class="dashboard">
    <div class="container">
        <div class="titulo_pagina">
        <i class="fa-solid fa-user"></i> Barbeiros - Editar 
        </div>
        <div class="form">
            <form action="<?=URL_BASE?>admin/barbeiros_update" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="row">
                        <label>
                            Nome
                            <input type="text" name="nome" required value="<?=$data['informacoes']['barbeiro']['nome']?>">
                        </label>
                    </div>
                    <div class="row">
                    <label>
                            Cargo
                            <input type="text" name="cargo" required value="<?=$data['informacoes']['barbeiro']['cargo']?>">
                        </label>
                    </div>
                </div>
                
                <div class="row">
                    <label>
                        Imagem Pricipal
                        <input type="file" name="imagem_principal" accept="image/*">
                    </label>
                    <div class="img">
                        <img src="<?=URL_BASE.$data['informacoes']['barbeiro']['imagem_principal']?>">
                        <label>
                            <input type="checkbox" name="excluir_imagem_principal">
                            Excluir imagem
                        </label>
                    </div>
                </div>
                <div class="row">
                    <label>
                        Ativo
                        <select name="ativo" required>
                            <option value="s" <?php if($data['informacoes']['barbeiro']['status'] === 's') echo 'selected'?>>Sim</option>
                            <option value="n" <?php if($data['informacoes']['barbeiro']['status'] === 'n') echo 'selected'?>>Não</option>
                        </select>
                    </label>
                </div>
                <div class="row">
                    <button type="submit">Salvar</button>
                </div>   
                <input type="hidden" name="id" value="<?=$data['informacoes']['barbeiro']['id']?>">
                <input type="hidden" name="nome_imagem_atual" value="<?=$data['informacoes']['barbeiro']['imagem_principal']?>">
            </form>  
        </div>
</section>
<?=$this->fetch('../commons/footer.php')?>