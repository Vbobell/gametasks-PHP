<!DOCTYPE html>
<html lang="pt">

<head>
<?php
require("../links.php");
?>
</head>

<body>
<?php
//faz a importação do arquivo que controla a busca dos dados.
require_once("../verificaSessao.php");
require_once("quadroTarefasAdm.php");
require_once("../regraNegocio/usuarioExperiencia.php");

//Classe que será instanciada no script.
?>
<!--Estrutura HTML-->
	<header class="menuLateral col-xs-12 col-lg-2">
		<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">
		<div class="botaoMenu">
			Game Tasks
			<div>seja bem vindo <?php echo $user; ?></div> 
		</div>
		</a>
		<ul class="sidebar-nav mostra">          
			<li id="dashTarefa" class="col-xs-12 col-md-12 col-lg-12 botoesMenu">
				  
				<a href="#"><img src="/gametasks/imagens/pergaminho.png"/><p>Quadro de missões</p></a>
				<div class="col-xs-12 col-lg-12 botoesInternosMenu">
				<div id="botaoTarefa" class="col-xs-12 col-lg-12 botoesCabecalho mostraResultado">Missões</div>
				<div id="botaoAdcMissao" class="col-xs-12 col-lg-12 botoesCabecalho adicionar">Nova Missão</div>
				<div id="botaoEquipe" class="col-xs-12 col-md-12 col-lg-12 botoesCabecalho mostraResultado">Equipes em combate</div>
				</div>
			</li>
			<li id="dashQuadro" class="col-xs-12 col-md-12 col-lg-12 botoesMenu">
				<a href="#"><img src="/gametasks/imagens/capacete.png"/><p>Guerreiros</p></a>
				<div class="col-xs-12 botoesInternosMenu">
				<div id="botaoUsuario" class="col-xs-12 col-md-12 col-lg-12 botoesCabecalho mostraResultado">Lista guerreiros</div>
				<div id="botaoAdcGuerreiro" class="col-xs-12 col-md-12 col-lg-12 botoesCabecalho adicionar">Adicionar guerreiros</div>
				</div>
			</li>
            <li id="dash" class="col-xs-12 col-md-12 col-lg-12 botoesMenu">
				<div id="botaoRank" class="col-xs-12 col-md-12 col-lg-12 botoesCabecalho mostraResultado">
				<a href="#"><img src="/gametasks/imagens/trofeu.png"/><p>Ranking</p></a>
				</div>
            </li>
			<li id="dashTaverna" class="col-xs-12 col-md-12 col-lg-12 botoesMenu">
				<div id="botaoTaverna" class="col-xs-12 col-md-12 col-lg-12 botoesCabecalho mostraResultado">
				<a href="#"><img src="/gametasks/imagens/taverna.png"/><p>Taverna</p></a>
				</div>
            </li>    
			<li id="dashRegras" class="col-xs-12 col-md-12 col-lg-12 botoesMenu">
				<div id="botaoRegras" class="col-xs-12 col-md-12 col-lg-12 botoesCabecalho mostraResultado">
				<a href="#"><img src="/gametasks/imagens/blacksmith.png"/><p>Regras</p></a>
				</div>
            </li> 
		</ul>
	</header>
	
	<section class="col-xs-12 col-lg-7 adicionar">
	<!--FORMULÀRIO DE ADICIONAR USUARIO-->
		<div id="adicionarUsuario" class="col-xs-12 col-lg-10 modalAdicionar">
			<div><h2>Adicionar guerreiro </h2><figure class="fechar" onClick="fechaModal()"><img src="../../imagens/close.png"></figure></div>
			<form method="POST" action="adicionar.php" class="form-horizontal">
				<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 col-lg-3 labelForm" for="nome">Nome:</label>
				<div class="col-xs-12 col-sm-10 col-lg-7 pull-right">
					<input type="text" class="form-control" id="nome" name="nome" placeholder="nome" required>
				</div>
				</div>
				<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 col-lg-4 labelForm" for="email">Pergaminho eletrônico:</label>
				<div class="col-xs-12 col-sm-10 col-lg-7 pull-right">
					<input type="text" class="form-control" id="email" name="email" placeholder="e-mail" required>
				</div>
				</div>
				<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 col-lg-3 labelForm" for="pwd">Código secreto:</label>
				<div class="col-xs-12 col-sm-10 col-lg-7 pull-right">
					<input type="password" class="form-control" id="pwd" name="senha" placeholder="senha" required>
				</div>
				</div>
				<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 col-lg-3 labelForm" for="cpf">CPF:</label>
				<div class="col-xs-12 col-sm-10 col-lg-7 pull-right">
					<input type="text" class="form-control" id="email" name="cpf" placeholder="cpf" required>
				</div>
				</div>
				<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 col-lg-3 labelForm" for="funcao">Função:</label>
				<div class="col-xs-12 col-sm-10 col-lg-7 pull-right">
					<input type="text" class="form-control" id="funcao" name="funcao" placeholder="função" required>
				</div>
				</div>
				<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 col-lg-3 labelForm" for="personagem">Personagem:</label>
				<div class="col-xs-12 col-sm-10 col-lg-7 pull-right">
					<select class="form-control" name="personagem" id="personagem" required>
						<option value="">Personagem</option>
						<option value="5">Goblim</option>
						<option value="3">Guerreiro</option>
						<option value="2">Arqueira</option>
                        <option value="4">Mago</option>                        
						<option value="1">Mestre</option>
					</select>
				</div>
				</div>
				<div class="form-group">
				<div class="col-xs-12 col-sm-10 col-lg-7 pull-right">
					<input type="hidden" class="form-control" id="inputUsuario" value="usuario" name="adicionar">
					<input type="hidden" class="form-control" id="usuarioTabela" value="" name="tabela">
					<input type="hidden" class="form-control" id="usuarioModo" value="" name="modo">
				</div>
				</div>
				<div class="form-group">
				<div class="col-xs-12 col-sm-12 text-center">
					<button type="submit" class="btn btn-default text-center">Salvar</button>
				</div>
				</div>
			</form>
		</div>
        
		<!--FIM FORMULÀRIO DE ADICIONAR USUARIO-->
		<!--FORMULÀRIO DE ADICIONAR TAREFA-->
		
        <div id="adicionarTarefa" class="col-xs-12 col-lg-10 modalAdicionar">
			<div><h2>Adicionar missão</h2> <figure class="fechar" onClick="fechaModal()"><img src="../../imagens/close.png"></figure></div>
			<form method="POST" action="adicionar.php" class="form-horizontal">
				<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 col-lg-3 labelForm" for="mestre">Mestre:</label>
				<div class="col-xs-12 col-sm-10 col-lg-7 pull-right">
					<select class="form-control" name="mestre" id="mestre" required>
					<option>Mestre</option>
					<?php 
						$nomeUsuario = new Usuario();
						$mostraNome = $nomeUsuario->getUsuarios();
							foreach ($mostraNome as $i => $count) {
								echo($mostraNome[$i]);
							}		
					?>
					</select>
				</div>
				</div>
				<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 col-lg-4 labelForm" for="titulo">Titulo:</label>
				<div class="col-xs-12 col-sm-10 col-lg-7 pull-right">
					<input type="text" class="form-control" id="titulo" name="titulo" placeholder="titulo" required>
				</div>
				</div>
				<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 col-lg-4 labelForm" for="descricao">Descrição:</label>
				<div class="col-xs-12 col-sm-10 col-lg-7 pull-right">
					<input type="text" class="form-control" id="descricao" name="descricao" placeholder="descrição" required>
				</div>
				</div>
				<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 col-lg-3 labelForm" for="status">Status:</label>
				<div class="col-xs-12 col-sm-10 col-lg-7 pull-right">
					<select class="form-control" name="status" id="status" required>
						<option>status</option>
						<option value="aberta">aberta</option>
						<option value="aguardando">aguardando</option>
						<option value="fechada">fechada</option>
					</select>
				</div>
				</div>
				<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 col-lg-3 labelForm" for="valorXP">Valor XP:</label>
				<div class="col-xs-12 col-sm-10 col-lg-7 pull-right">
					<input type="text" class="form-control" id="valorXP" name="valorXP" placeholder="valor XP" required>
				</div>
				</div>
				<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 col-lg-3 labelForm" for="dataInicio">Data início:</label>
				<div class="col-xs-12 col-sm-10 col-lg-7 pull-right">
					<input type="date" class="form-control" id="dataInicio" name="dataInicio" required>
				</div>
				</div>
				<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 col-lg-3 labelForm" for="dataLimite">Data limite:</label>
				<div class="col-xs-12 col-sm-10 col-lg-7 pull-right">
					<input type="date" class="form-control" id="dataLimite" name="dataLimite" required>
				</div>
				</div>
				<div class="form-group">
				<div class="col-xs-12 col-sm-10 col-lg-7 pull-right">
					<input type="hidden" class="form-control" id="inputTarefa" value="tarefa" name="adicionar">
					<input type="hidden" class="form-control" id="tarefaTabela" value="" name="tabela">
					<input type="hidden" class="form-control" id="tarefaModo" value="" name="modo">
				</div>
				</div>
				<div class="form-group">
				<div class="col-xs-12 col-sm-12 text-center">
					<button type="submit" class="btn btn-default text-center">Salvar</button>
				</div>
				</div>
			</form>
		</div>
		<!--FIM FORMULÀRIO DE ADICIONAR TAREFA-->
	</section>

	<section class="col-xs-12 col-lg-10 conteudo">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-lg-12">
					<div id="conteudo" class="col-xs-12 col-md-10 col-lg-10">
						<div id="mostraConteudo" class="col-xs-12 col-md-12">
						<table class="table table-hover table-striped">
							<thead class="cabecalhoTabela">
								<tr>
								</tr>
							</thead>
						<tbody>
						</tbody>
						</table>
						</div>
					</div>
					<div class="usuario">
						<figure class="usuarioFoto">
							<img src="<?php $usuario = new Usuario(); echo $usuario->retornaImagem($id)?>">
						</figure>
						<div class="infoUsuario" style="<?php echo $usuario->retornaBanner($id)?>">
							<div class="perfil">
                               <?php
                                    $informacao = new Usuario();
                                    $usuario = array();
                                    $usuario = $informacao->getDadosUsuario($id);
                                    $xp = new BalanceamentoXp();
                                    $xp->selecionaXpTotal($id);
                                    $maxU = $xp->calculaExperiencia();
                                ?>
                                <p> <span>Nome</span> <br><?php echo $usuario[1]; ?></p>
                                <p> <span>Classe</span> <br><?php echo $usuario[5]; ?></p>
                                <p> <span>XP Mês</span><br> <?php echo $usuario[7]; ?></p>
                                <p> <span>Nível</span><br> <?php echo $xp->calculaNivel(); ?></p>
                                <progress value="<?php 
                                if ($usuario[8] < 200) {
                                	echo $usuario[8];
                                }
                                else {
                                	echo ($usuario[8]-($maxU/2))*2;
                                }                                
                                ?>" 
                                max="<?php echo $maxU;?>"></progress>
                                <p><?php echo $usuario[8]?>/<?php echo $maxU;?></p>
								<a href="../../logout.php">Sair</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section>
	 <section class="col-xs-12 col-lg-9 taverna">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-lg-12">
				<h2>Personagens</h2>
					<figure class="col-xs-12 col-lg-3" data-item-elemento="personagem" data-item-personagem="0"><img src="../../imagens/goblim.png" class="col-lg-10"/><p><span>Goblin</span> <br> Estagiário</p></figure>
					<figure class="col-xs-12 col-lg-3" data-item-elemento="personagem" data-item-personagem="1"><img src="../../imagens/guerreiro.png" class="col-lg-10"/><p><span>Guerreiro</span> <br> Desenvolvedor</p></figure>
					<figure class="col-xs-12 col-lg-3" data-item-elemento="personagem" data-item-personagem="2"><img src="../../imagens/arqueira.png" class="col-lg-10"/><p><span>Arqueiro</span> <br> Tester</p></figure>
					<figure class="col-xs-12 col-lg-3" data-item-elemento="personagem" data-item-personagem="3"><img src="../../imagens/mago.png" class="col-lg-10"/><p><span>Mago</span> <br> DBA</p></figure>
					<figure class="col-xs-12 col-lg-3" data-item-elemento="personagem" data-item-personagem="4"><img src="../../imagens/mestre.png" class="col-lg-10"/><p><span>Mestre</span> <br> Gerente</p></figure>
				</div>
			</div>
			<div class="row">
				<article class="col-xs-12 col-lg-12 historia">
				<p>Goblins, em sua maioria, criaturas atrapalhadas e problemáticas. O mestre, com sua grande sabedoria, descobriu um comportamento interessante, quando um goblin passa algum tempo aprendendo com companheiro como guerreiros, mago, arqueiros, etc, ele tem a chance de se tornar tão grande quanto o companheiro que ele segue. E foi assim que o mestre começou a distribuí-los entre seus subordinados, dando objetivo a ele e observadores para impedir que eles destruíssem o reino.</p>
				<p>Reino do Grande Sistema, um lugar cheio de problemas causados pelos bugs que o assombram, O mestre com sua luta contínua contra os problemas que são gerados por estas assombrações, contratou estes guerreiros, determinados e resistentes, que iram até as profundezas dos códigos para achar os malditos Bugs que deixa inutilizadas as terras do Reino do Grande Sistema. Dizem que estes guerreiros vivem treinando a ponto de quase não dormirem, e que bebem uma poção, que alguns dizem ser magia negra, é um líquido preto e que os deixam mais atentos e frenéticos em suas batalhas.</p>
				<p>  O mestre em meio às confusões e erros que ocorriam no reino, convocou uma ordem a muito isolada, e a ela, requisitou que fizessem a patrulha de seu reino. Estes arqueiros formidáveis, tinham seus olhos atentos a tudo que ocorria. Sempre que alguém faltava com seu dever, era dever dos arqueiros relatarem o ocorrido e ajudar com a solução do problema.</p>
				<p>Diante de todas as pessoas do Reino do Grande Sistema, o Mestre, escolheu os magos como os responsáveis por guardar a história do reino, estes sábios em dados, juntaram-se e criaram uma dimensão, que daria a possibilidade de manipular estes dados, e foi nesse lugar de grande magia, os magos criam colunas e linhas, que se transformaram em tabelas e mais tabelas e entre elas, eles criaram suas relações. Porém para ter acesso apenas os escolhidos ganham um pergaminho com códigos estranhos para que fossem feitas as consultas, porém ainda era necessária uma chave, para que fosse possível as consultas, esta seria chamada de Primary key.</p>
				<p>Mestre, o senhor do reino, com sua grande sabedoria em gerenciamento, é aquele que comanda todos os outros, é aquele que administra as falhas e novos projetos do reino. Este é quem tem o vínculo com todas as partes do reino e até mesmo com outros reinos. Em meio a dúvidas muitos vão a sua procura por respostas de como administrar suas próximas horas, dias ou até mes. Mas cuidado, apesar de ser generoso, não teste sua paciência em ficar errando muito perante ele. 
				</p>
				</article>
			</div>
		</div>
	</section>

	<section class="col-xs-12 col-lg-9 regras">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-lg-12">
				<article class="col-xs-12 col-lg-12">
					<h2>Olá nobre colaborador.</h2>
					<p>
					Gametasks é um meio de gerenciar suas próximas horas de aventura(trabalho) de maneira mais divertida e simples. Nele você receberá suas tarefas diárias, semanais ou até mesmo mensais, recebendo xp(experiência) como forma de feedback do seu progresso na empresa para futuras novas aventuras(promoções) e a partir dele, você terá a chance de competir com todos os outros colaboradores, para o posto de campeão do mês.
					</p>
					<h2>Como funciona?</h2>
					<p>
					Cada colaborador, será destinado para o seu reino(equipe ou projeto), a partir de sua função no reino, será atribuído a este colaborador uma classe, como por exemplo; um dba, receberá o título de mago, um desenvolvedor, recebe de guerrero e até mesmo um estagiário, receberá o de...goblin. Cada classe com sua história em meio a toda essa aventura.
					</p>
					<p>
					O mestre(gerente), criara as missões(tarefas) e irá atribuir elas a partir de sua classe, incluindo a quantidade de xp da tarefa. Nelas serão dados status e será visto como está o seu progresso.
					</p>
					<h2>O que é xp(experiência) e como funciona isso?</h2>
					<p>
					Experiência de carreira, é o quanto já foi trabalhado na empresa, com ela o colaborador terá um meio de feedback sobre como está a sua evolução no trabalho e ao mesmo tempo a empresa saberá quais são seus colaboradores mais experientes, podendo assim vinculá-los a tarefas de seu devido nível.
					</p>
					<p>
					Experiência mensal, é utilizada para uma competição saudável entre os colaboradores da empresa. Todo mês este xp é zerado, dando a oportunidade para todos entrarem na competição e por fim ter uma boa colocação no rank. Este xp, após o final do mês é convertido de acordo com o nível do colaborador, para uma nova quantia de xp e acrescentado no xp carreira, assim não ficando muito angustiante a evolução dos colaboradores caso seu nível seja muito alto.
					</p>
				</article>
				</div>
			</div>
		</div>
	</section>		

	<section class="col-xs-12 col-lg-10 modalExcluir">
    	<form action="excluir.php"> 
			<p></p>
			<input type="hidden" name="excluir" value="" required/>
			<input type="hidden" name="id" value="" required/>
			<input type="hidden" name="relacao" value="" required/>
			<input type="submit" class="btn btn-danger" value="Excluir"/>
			<div class="cancelar btn btn-warning"> Cancelar</div>
    	</form>
	</section>

	<?php
	require("../../js/quadroAdm.php");
	?>
	
	<script src="/gametasks/js/funcoesAdm.js">
	</script>
	<script>
	$(document).ready(function() {
		if($(window).width() > 990){
			alturaPagina();
			mostraPerfil();
		}else{
			$('header').prepend($('.usuario'));
		}
		menuLateral();
		botaoMenu();
		adicionar();
		fechaModal();
		mostraTextoPersonagem();
	});   
	</script>
</body>

</html>
