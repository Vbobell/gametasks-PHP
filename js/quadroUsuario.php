<script>

function preencheConteudo(){
	 $('.botoesCabecalho.mostraResultado').click(function(){

		  $('#conteudo,#mostraConteudo').removeAttr('style');
		  $('body').removeAttr('style');
		  $('#conteudo,#mostraConteudo,.taverna,.regras').slideUp();
		  
		  var elemento = $(this).attr('id');

		  //reloadConteudo();

		  switch(elemento){
		    case 'botaoTarefaUsuario':
			$('#mostraConteudo table thead').html('<tr><td>titulo</td><td>descricao</td><td>data inicio</td><td>data limite</td><td>pontos</td><td>status</td><td>Opções</td></tr>');
		  	$('#mostraConteudo table tbody').html('<?php $mostra = new QuadroUsuario();$mostra->retornaExibicao("tarefa"); ?>');
			$('#conteudo,#mostraConteudo').css('height','540').slideDown();
            break;

            case 'botaoRank':
			$('#mostraConteudo table thead').html('<tr><td>Nome</td><td>Função</td><td>Xp Mês</td></tr>');
			$('#mostraConteudo table tbody').html('<?php $mostra = new QuadroTarefa();$mostra->retornaExibicao("ranking"); ?>');
            $('#conteudo,#mostraConteudo').slideDown();
            break;

			case 'botaoTaverna':
			if($(window).width() > 990){
			$('body').css ({ "background":"url('../../imagens/fundoTaverna.jpg') no-repeat", "background-size":"cover"});
			}
			$('body').css ({ "background":"url('../../imagens/fundoTaverna.jpg') no-repeat", "background-size":"cover"});
			$('.taverna').slideDown();
			break;

			case 'botaoRegras':
			if($(window).width() > 990){
			$('body').css ({ "background":"url('../../imagens/fundoBlacksmith.png') no-repeat", "background-size":"cover"});
			}
			$('body').css ({ "background":"url('../../imagens/fundoBlacksmith.png') no-repeat", "background-size":"cover"});
			$('.regras').slideDown();
			break;
            }
	 });
 }
 function adicionarStatus(tarefa,equipe){
	$('.comentario table tbody').html('');
	$.post( "retornaJson.php", { tarefa: tarefa })
		.done(function(data) {
			obj = JSON.parse(data);
			for(var i = 0; i < obj.length; i++){
				$('.comentario table tbody').append('<tr data-linha-type="'+i+'"></tr>');
				$('.comentario table tbody tr[data-linha-type="'+i+'"]').append('<td>'+obj[i].nome+'</td>');
				$('.comentario table tbody tr[data-linha-type="'+i+'"]').append('<td>'+obj[i].comentario+'</td>');
			}
		});
	 $('#equipe').attr('value',equipe);
	 $('#tarefa').attr('value',tarefa);
	 $('section.adicionar .modalAdicionar:nth(0)').slideDown();
 }

 preencheConteudo();
</script>
