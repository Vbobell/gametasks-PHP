<script>

/*function reloadConteudo(){
	 $.ajax({
          url: 'http://localhost/gametasks/PHP/quadroTarefa/index.php',
          cache: false,
		  //data: 
		  alert(data);
          success: function(data){
			  
          } 
        });
}*/

function preencheConteudo(){
	 $('.botoesCabecalho.mostraResultado').click(function(){
          
		  $('.modalAdicionar,#mostraConteudo,.taverna,.regras').slideUp();
		  $('body').removeAttr('style');
		  $('.botoesCabecalho.mostraResultado').removeClass('active');
		  $(this).addClass('active');
		  var elemento = $(this).attr('id');

		  //reloadConteudo();

		  switch(elemento){
		    case 'botaoUsuario':
			$('#mostraConteudo table thead').html('<tr><td>Nome</td><td>Função</td><td>Opções</td></tr>');
		  	$('#mostraConteudo table tbody').html('<?php $mostra = new QuadroTarefa();$mostra->retornaExibicao("usuario"); ?>');
			$('#mostraConteudo').slideDown();
			break;
			
			case 'botaoTarefa':
			$('#mostraConteudo table thead').html('<tr><td>Titulo</td><td>Valor XP</td><td>Status missão</td><td>Opções</td></tr>');
			$('#mostraConteudo table tbody').html('<?php $mostra = new QuadroTarefa();$mostra->retornaExibicao("tarefa"); ?>');
			 $('#mostraConteudo').slideDown();
			break;

			case 'botaoEquipe':
			$('#mostraConteudo table thead').html('<tr><td>Nome</td><td>Titulo tarefa</td>'+
			'<td>Status</td><td>Data início</td><td>Valor XP</td><td>Status missão</td><td>Opções</td></tr>');
			$('#mostraConteudo table tbody').html('<?php $mostra = new QuadroTarefa();$mostra->retornaExibicao("equipe"); ?>');
			 $('#mostraConteudo').slideDown();
			break;
                  
            case 'botaoRank':
			$('#mostraConteudo table thead').html('<tr><td>Nome</td><td>Função</td><td>Xp Mês</td></tr>');
			$('#mostraConteudo table tbody').html('<?php $mostra = new QuadroTarefa();$mostra->retornaExibicao("ranking"); ?>');
            $('#mostraConteudo').slideDown();
			break;

			case 'botaoTaverna':
			if($(window).width() > 990){
			$('body').css ({ "background":"url('../../imagens/fundoTaverna.jpg') no-repeat", "background-size":"cover"});
			}
			$('.taverna').slideDown();
			break;

			case 'botaoRegras':
			if($(window).width() > 990){
			$('body').css ({ "background":"url('../../imagens/fundoBlacksmith.png') no-repeat", "background-size":"cover"});
			}
			$('.regras').slideDown();
			break;
			
		  }
		 
	 });
 }
preencheConteudo();


 </script>