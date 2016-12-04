var altura = "";
var idBotaoAdc = "";
var idBotao = "";
var relacaoEquipe = "relacaoEquipe";
var usuario = "usuario";
var tarefa = "tarefa";

function selecionaEdicaoUsuario(id){
var idBusca = id;
$.post( "editar.php", { busca: idBusca, tabela: 'usuario', modo: 'buscaDados' })
    .done(function(data) {
        console.log(data);
        obj = JSON.parse(data);
        $('#adicionarUsuario h2').text('Editar Usuário');
        $('#adicionarUsuario form').attr('action','editar.php');
        $('#adicionarUsuario input[name="nome"]').val(obj.nome);
        $('#adicionarUsuario input[name="email"]').val(obj.email);
        $('#adicionarUsuario input[name="cpf"]').val(obj.cpf);
        $('#adicionarUsuario input[name="funcao"]').val(obj.funcao);
        $('select[name="personagem"] option[value="'+obj.personagem+'"]').attr('selected','selected');
        $('#adicionarUsuario input[name="adicionar"]').val(idBusca);
        $('#adicionarUsuario input[name="tabela"]').val('usuario');
        $('#adicionarUsuario input[name="modo"]').val('atualizaDados');
        $('section.adicionar .modalAdicionar:nth(0)').slideDown();
    });
}

function selecionaEdicaoTarefa(id){
var idBusca = id;
$.post( "editar.php", { busca: idBusca, tabela: 'tarefa', modo: 'buscaDados' })
    .done(function(data) {
        obj = JSON.parse(data);
        $('#adicionarTarefa h2').text('Editar Tarefa');
        $('#adicionarTarefa form').attr('action','editar.php');
        $('#adicionarTarefa form').append('<input type="hidden" name="mestreAnterior" value"'+obj.mestre+'"/>');
        $('#adicionarTarefa select[name="mestre"] option[value="'+obj.mestre+'"]').attr('selected','selected');
        $('#adicionarTarefa input[name="titulo"]').val(obj.titulo);
        $('#adicionarTarefa input[name="descricao"]').val(obj.descricao);
        $('#adicionarTarefa select[name="status"] option[value="'+obj.status+'"]').attr('selected','selected');
        $('#adicionarTarefa input[name="valorXP"]').val(obj.valorXP);
        $('#adicionarTarefa input[name="dataInicio"]').val(obj.dataInicio);
        $('#adicionarTarefa input[name="dataLimite"]').val(obj.dataLimite);
        $('#adicionarTarefa input[name="adicionar"]').val(idBusca);
        $('#adicionarTarefa input[name="tabela"]').val('tarefa');
        $('#adicionarTarefa input[name="modo"]').val('atualizaDados');
        $('section.adicionar .modalAdicionar:nth(1)').slideDown();

    });
} 


function alturaPagina() {
    altura = $(window).height();
    $('.menuLateral').css('height', altura);

    $('.taverna,.perfil,.regras').css('height', altura-5);
    $('.taverna,.perfil').css('height', altura-5);

    $(window).resize(function () {
        altura = $(window).height();
        $('.menuLateral,.perfil').css('height', altura);
        $('.taverna,.perfil,.regras').css('height', altura-5);
        $('.taverna,.perfil').css('height', altura-5);
    });
}
function menuLateral(){
     $("#menu-toggle").click(function (e) {
        e.preventDefault();
         
        if ($('header.menuLateral').attr('class') == 'menuLateral col-lg-2') {
            $('header.menuLateral').removeClass('col-lg-2').addClass('col-lg-1');
            $('#conteudo').removeClass('col-lg-10').addClass('col-lg-12');
            $('li.botoesMenu img').css('width','80px');
            $('li.botoesMenu p').css('display','none');
            
        } else {
            $('header.menuLateral').removeClass('col-lg-1').addClass('col-lg-2');
            $('#conteudo').removeClass('col-lg-12').addClass('col-lg-10');
            setTimeout(function() {
                 $('li.botoesMenu img,li.botoesMenu p').removeAttr('style');
            }, 600);
        }
     });
}

function botaoMenu() {
    $('.botoesMenu').click(function () {
        idBotao = $(this).attr('id');
        if ($('#' + idBotao + ' div.botoesInternosMenu').css('display') == 'none') {
            $('div.botoesInternosMenu').slideUp();
            $('#' + idBotao + ' div.botoesInternosMenu').slideDown();
        }
    });
    $('header').mouseleave(function(){
            $('div.botoesInternosMenu').slideUp();
        });
}
function adicionar(){
   $('div.botoesCabecalho.adicionar').click(function () {
        idBotaoAdc = $(this).attr('id');
        $('section.adicionar .modalAdicionar, #mostraConteudo, .taverna').slideUp();

        switch (idBotaoAdc){
            case 'botaoAdcGuerreiro':
            $('#adicionarUsuario form').attr('action','adicionar.php');
            $('#adicionarUsuario h2').text('Adicionar Usuario');
            $('#adicionarUsuario input').val('');
            $('#adicionarUsuario #inputUsuario').attr('value','usuario');
            $('#adicionarUsuario select option').removeAttr('selected');
            $('#adicionarUsuario select option:nth(0)').attr('selected','selected');
            $('section.adicionar .modalAdicionar:nth(0)').slideDown();
            break;
            
            case 'botaoAdcMissao':
            $('#adicionarTarefa form').attr('action','adicionar.php');
            $('#adicionarTarefa h2').text('Adicionar Tarefa');
            $('#adicionarTarefa input').val('');
            $('#adicionarTarefa #inputTarefa').attr('value','tarefa');
            $('#adicionarTarefa select option').removeAttr('selected');
            $('#adicionarTarefa select option:nth(0)').attr('selected','selected');
            $('section.adicionar .modalAdicionar:nth(1)').slideDown();
            break;
        }
   });
}

 function excluirRegistro(registro, id, relacao){
    $('.modalExcluir form input[name=excluir]').attr('value','');
    $('.modalExcluir form input[name=id]').attr('value', '');
    $('.modalExcluir form input[name=relacao]').attr('value', '');
    
    $('.modalExcluir form input[name=excluir]').attr('value',registro);
    $('.modalExcluir form input[name=id]').attr('value', id);
    $('.modalExcluir form input[name=relacao]').attr('value', relacao);

    if(relacao == false){
        $('.modalExcluir p').text('Deseja realmete excluir o registro?');
        $('.modalExcluir').slideDown();
    }else{
        $('.modalExcluir p').text('O registro possuí relação com outros dados, isso excluirá os dados relacionados com esse registro, deseja realmete excluir o registro?');
        $('.modalExcluir').slideDown();
    }
      
}

function fechaModal(){
    $('section.adicionar .modalAdicionar').slideUp();

    $('.modalExcluir form .cancelar.btn.btn-warning').click(function(){
        $('.modalExcluir').slideUp();
    });
}

function mostraPerfil(){
  $('.usuarioFoto').click(function () {
     $('.perfil').slideDown();
  });
  $('.infoUsuario').mouseleave(function(){
     $('.perfil').slideUp();
   });
} 

 function mostraTextoPersonagem(){
	 $('figure[data-item-elemento="personagem"]').click(function(){		 
		 var personagem = $(this).attr('data-item-personagem');
		 $('.historia p').slideUp();
		 $('.historia p:nth('+personagem+')').slideDown();
	 });
 } 
