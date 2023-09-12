<?=$this->fetch('../commons/header.php', $data)?>
<section class="dashboard">
    <div class="container">
        <div class="titulo_pagina">
        <i class="fa-regular fa-calendar"></i> Agendamentos
        </div>

        <div class="topo">
            <div class="btn">
                <a href="<?=URL_BASE?>admin/agendamentos-create">Agendar novo</a>
            </div>
        </div> 
        <div class="top-container">
            <div class="agenda-top"> 
                <div class="menu-agenda">
                    <div class="btn-group">
                        <button id="btnVoltar" class="btn-menu-agenda"><</button>
                        <button id="btnProximo" class="btn-menu-agenda">></button>
                    </div>
                    <div class="title-menu">
                        <input type="date" id="dataMarcada">
                    </div>
                    <a href="<?=URL_BASE?>admin/agendamentos" class="btn-menu-atualizar">Atualizar</a>
                </div>
                <table>
                    <tr>
                        <td class="td-title"></td>
                        <?php foreach ($data['informacoes']['barbeiro'] as $barbeiro) {?>
                            <td class="td-title"><?=$barbeiro['nome'] ?></td>    
                        <?php }?>
                    </tr>
                    <tr>
                        <th class="tr">07:00</th>
                        <td class="td fechada"></td>    
                    </tr>
                    <tr>
                        <th class="tr ">07:30</th>
                        <td class="td fechada"></td>
                    </tr>  <tr>
                        <th class="tr">08:00</th>
                        <td class="td fechada"></td>
                    </tr>
                    <tr>
                        <th class="tr">08:30</th>
                        <td class="td fechada"></td>
                    </tr>
                    <tr>
                        <th class="tr">09:00</th>
                        <td><div class="td" id="horario-09-00"></div></td>
                    </tr>
                    <tr>
                        <th class="tr">09:30</th>
                        <td><div class="td" id="horario-09-30"></div></td>
                    </tr>
                    <tr>
                        <th class="tr">10:00</th>
                        <td ><div class="td"  id="horario-10-00"></div></td>
                    </tr>
                    <tr>
                        <th class="tr">10:30</th>
                        <td><div class="td" id="horario-10-30"></div></td>
                    </tr>
                    <tr>
                        <th class="tr">11:00</th>
                        <td><div class="td" id="horario-11-00"></div></td>
                    </tr>
                    <tr>
                        <th class="tr">11:30</th>
                        <td><div class="td" id="horario-11-30"></div></td>
                    </tr>
                    <tr>
                        <th class="tr">12:00</th>
                        <td class="td fechada"></td>
                    </tr>
                    <tr>
                        <th class="tr">12:30</th>
                        <td class="td fechada"></td>
                    </tr>
                    <tr>
                        <th class="tr">13:00</th>
                        <td class="td fechada"></td>
                    </tr>
                    <tr>
                        <th class="tr">13:30</th>
                        <td><div class="td" id="horario-13-30"></div></td>
                    </tr>
                    <tr>
                        <th class="tr">14:00</th>
                        <td><div class="td" id="horario-14-00"></div></td>
                    </tr>
                    <tr>
                        <th class="tr">14:30</th>
                        <td><div class="td" id="horario-14-30"></div></td>
                    </tr>
                    <tr>
                        <th class="tr">15:00</th>
                        <td><div class="td" id="horario-15-00"></div></td>
                    </tr>
                    <tr>
                        <th class="tr">15:30</th>
                        <td><div class="td" id="horario-15-30"></div></td>
                    </tr>
                    <tr>
                        <th class="tr">16:00</th>
                        <td><div class="td" id="horario-16-00"></div></td>
                    </tr>
                    <tr>
                        <th class="tr">16:30</th>
                        <td><div class="td" id="horario-16-30"></div></td>
                    </tr>
                    <tr>
                        <th class="tr">17:00</th>
                        <td><div class="td" id="horario-17-00"></div></td>
                    </tr>
                    <tr>
                        <th class="tr">17:30</th>
                        <td><div class="td fechada" id="horario-17-30"></div></td>
                    </tr>
                    <tr>
                        <th class="tr">18:00</th>
                        <td><div class="td fechada" id="horario-18-00"></div></td>
                    </tr>
                    <tr>
                        <th class="tr">18:30</th>
                        <td><div class="td fechada" id="horario-18-30"></div></td>
                    </tr>
                    <tr>
                        <th class="tr">19:00</th>
                        <td class="td fechada"></td>
                    </tr>
                    <tr>
                        <th class="tr">19:30</th>
                        <td class="td fechada"></td>
                    </tr>
                    <tr>
                        <th class="tr">20:00</th>
                        <td class="td fechada"></td>
                    </tr>
                    <tr>
                        <th class="tr">20:30</th>
                        <td class="td fechada"></td>
                    </tr>
                    <tr>
                        <th class="tr">21:00</th>
                        <td class="td fechada"></td>
                    </tr>
                    <tr>
                        <th class="tr">21:30</th>
                        <td class="td fechada"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>
<?=$this->fetch('../commons/footer.php')?>