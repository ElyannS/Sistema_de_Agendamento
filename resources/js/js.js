$(document).ready(function(){

    const $deleteButton = $('#deleteButton');
    const $confirmationDialog = $('#confirmationDialog');
    const $confirmDeleteButton = $('#confirmDeleteButton');
    const $cancelDeleteButton = $('#cancelDeleteButton');

    function showConfirmationDialog() {
      $confirmationDialog.show();
    }

    function hideConfirmationDialog() {
      $confirmationDialog.hide();
    }

    // Adicionar um ouvinte de evento ao botão de delete para mostrar o diálogo de confirmação
    $deleteButton.on('click', showConfirmationDialog);

    // Adicionar um ouvinte de evento ao botão "Sim" do diálogo de confirmação
    $confirmDeleteButton.on('click', function() {
      deleteAction();
      $deleteForm.submit(); 
      hideConfirmationDialog();
    });

    // Adicionar um ouvinte de evento ao botão "Cancelar" do diálogo de confirmação
    $cancelDeleteButton.on('click', hideConfirmationDialog);
  
  var dataAtual = new Date().toISOString().split('T')[0];

  // Define o valor do campo de entrada com a data atual
  $('#dataMarcada').val(dataAtual);
    atualizarData(dataAtual);
 
   // Captura o evento de clique no botão "Voltar"
   $('#btnVoltar').click(function() {
    manipularData(-1); // Chama a função para manipular a data, passando -1 para voltar um dia
  });

  // Captura o evento de clique no botão "Próximo"
  $('#btnProximo').click(function() {
    manipularData(1); // Chama a função para manipular a data, passando 1 para avançar um dia
  });

  function manipularData(dias) {
    // Obtém o valor atual da data selecionada no campo
    var dataSelecionada = $('#dataMarcada').val();

    // Cria um objeto Date com a data selecionada
    var data = new Date(dataSelecionada);

    // Adiciona o número de dias desejado à data
    data.setDate(data.getDate() + dias);

    // Converte a nova data para o formato "YYYY-MM-DD"
    var novaData = data.toISOString().split('T')[0];

    // Define o valor do campo de entrada com a nova data
    $('#dataMarcada').val(novaData);
    atualizarData(novaData);
 
  }

  function atualizarHorarios(data, selectServico) {
    var tempoServico = '';
    var idServico = '';
  
    if (selectServico) {
      var valores = selectServico.split(';');
      tempoServico = valores[0];
    }
    $.ajax({
      url: '/admin/atualizar_horarios',
      type: 'POST',
      data: {
        data: data,
        tempoServico: tempoServico
      },
      dataType: 'json',
      success: function(response) {
        if (response && response.horarios) {
          $('#horariosDisponiveis').empty();
          for (var i = 0; i < response.horarios.length; i++) {
            var horario = response.horarios[i];
            $('#horariosDisponiveis').append('<option>' + horario + '</option>');
          }
        }
      },
      error: function(xhr, status, error) {
        if (xhr.responseText) {
          try {
            var response = JSON.parse(xhr.responseText);
            if (response.hasOwnProperty('error')) {
              alert('Erro: ' + response.error);
            } else {
              alert('Ocorreu um erro na requisição.');
            }
          } catch (e) {
            alert('Ocorreu um erro na requisição: ' + error);
          }
        } else {
          alert('Ocorreu um erro na requisição: ' + error);
        }
      }
    });
  }
  
  $('#data').change(function() {
    var data = $('#data').val();
    var selectServico = $('#tempo').val();
  
    atualizarHorarios(data, selectServico);
   
  });
  
  
  function atualizarData(data) {
    $.ajax({
      url: '/admin/atualizar_data',
      type: 'POST',
      data: {
        data: data,
      },
      dataType: 'json',
      success: function(response) {
        var horarios = response.horarios;
        if (horarios === 'fechada' ) {
          for (var i = 0; i < horarios.length; i++) {
              var td = $('.td')
              td.empty();
              td.addClass('fechada')             
              td.removeClass('marcado');
              td.removeClass('marcado-corte-barba');
              celula.empty();
          }
        } else {
          //Percorra os horários
          for (var i = 0; i < horarios.length; i++) {
            var horario = horarios[i].horario;
            var nomeAgendamento = horarios[i].nome;
            var idAgendamento = horarios[i].idAgendamento; // Assumindo que o ID do agendamento está disponível no array
            var servico = horarios[i].servico;

            // Encontre a célula correspondente ao horário
            var celula = $('#horario-' + horario.replace(':', '-').replace(' ', '-'));
           
            var ultimoHorario = horarios[horarios.length - 1].horario;
            if (ultimoHorario === '16:00') {
                var celula1 = $('#horario-16-30');
                var celula2 = $('#horario-17-00');
                var celula3 = $('#horario-17-30');
                var celula4 = $('#horario-18-00');
                var celula5 = $('#horario-18-30');
                celula1.addClass('fechada');
                celula2.addClass('fechada');
                celula3.addClass('fechada');
                celula4.addClass('fechada');
                celula5.addClass('fechada');

                celula1.empty();
                celula2.empty();
                celula3.empty();
                celula4.empty();
                celula5.empty();

                celula1.removeClass('marcado-corte-barba');
                celula2.removeClass('marcado-corte-barba');
                celula3.removeClass('marcado-corte-barba');
                celula4.removeClass('marcado-corte-barba');
                celula5.removeClass('marcado-corte-barba');
            } else{
              var celula6 = $('#horario-08-00');
              var celula7 = $('#horario-08-30');

              celula6.empty();
              celula7.empty();

              celula6.addClass('fechada');
              celula7.addClass('fechada');

            }
            celula.removeClass('fechada');
        
          
            if (nomeAgendamento) {
              celula.addClass('marcado');
              if(servico == 'Corte e barba') {
                celula.addClass('marcado-corte-barba');
                celula.removeClass('marcado');
                
              }else{
                celula.empty();
                celula.removeClass('marcado-corte-barba');
          
              }
            } else {
              celula.empty();
              celula.removeClass('marcado');
              celula.removeClass('marcado-corte-barba');
            }

            // Criar o elemento <a> (link) dentro da célula
            var linkAgendamento = $('<a></a>');
            linkAgendamento.attr('href', 'agendamentos-edit/' + idAgendamento); // Adicione o ID do agendamento ao href
            linkAgendamento.text(nomeAgendamento);

            // Limpe o conteúdo da célula antes de adicionar o link
            celula.empty();
            
            // Adicionar o link do agendamento à célula
            celula.append(linkAgendamento);
          }
        } 
      },
      
      error: function(xhr, status, error) {
        if (xhr.responseText) {
          try {
            var response = JSON.parse(xhr.responseText);
            if (response.hasOwnProperty('error')) {
              alert('Erro: ' + response.error);
            } else {
              alert('Ocorreu um erro na requisição.');
            }
          } catch (e) {
           
            alert('Ocorreu um erro na requisição: ' + error);
          }
        } else {
        
          alert('Ocorreu um erro na requisição: ' + error);
         
        }
      }
    });
  }
  
  $('#dataMarcada').change(function() {
    var data = $('#dataMarcada').val();
  
    atualizarData(data);
  });
  
    $("body header .container .left a").on('click', function(){
      $('.menu_lateral').toggleClass('active');
      $('body.admin').toggleClass('menu_active');
      
    });
    
    $("body .menu_lateral .close").on('click', function(){
      $('.menu_lateral').toggleClass('active');
      $('body.admin').toggleClass('menu_active');
    });
    $("header .container .bar").on('click', function(){
        $(this).next().toggleClass('active');
        $(this).children().toggleClass('<fa-solid fa-xmark');
        $('body').toggleClass('menu-active')
    });
    if ($('form.form_ajax').length) {
      if (!jQuery().ajaxForm)
        return;
      $('form.form_ajax').on("submit", function(e) {
        e.preventDefault();
        var form = $(this);
        var alerta = form.children('.alerta');
        form.ajaxSubmit({
          dataType:'json'
          ,success: function(response) {
            if (response.msg){
              alerta.html(response.msg);
            }
            if (response.status != '0') {
              alerta.addClass('sucesso');
            } else {
              alerta.addClass('erro');
            }
            if (response.redirecionar_pagina){
              window.location = response.redirecionar_pagina;
            }
            if (response.resetar_form){
              form[0].reset();
            }
            setTimeout(
              function(){ 
                alerta.html("");
                alerta.removeClass('sucesso');
                alerta.removeClass('erro');
              }, 
            4000);
          }
        });
        return false;
      });
    }
  
  
});