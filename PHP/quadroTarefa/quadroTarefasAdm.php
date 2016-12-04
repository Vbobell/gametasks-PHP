
<?php

//faz a importação do arquivo que retorna os dados.
require_once("../banco/retornaDados.php");

class QuadroTarefa{
	private $retorna,$resultado;
//variaveis do select.
    private $nomeTabela, $consulta;
	
//Construtor para instanciar a classe.
public function QuadroTarefa(){
}
public function adicionarQuadro($idTarefa,$idUsuario){
	$dados = new Dados();

	$consulta = "insert into relacaoequipe (idTarefa, idUsuario) values($idTarefa,$idUsuario)";
	
	$resultado = $dados->retornaQuery($consulta);
}

public function atualizarUsuarioTarefa($idTarefa,$idUsario){
		$dados = new Dados();

		$consulta = "UPDATE relacaoequipe SET idUsuario= $idUsario where idTarefa = $idTarefa";
		
		$resultado = $dados->retornaQuery($consulta);
	}

public function excluirTarefaQuadro($id){
	$dados = new Dados();
	
	$consulta = "delete from relacaoequipe where idTarefa = $id";
	
	$resultado = $dados->retornaQuery($consulta);
}

public function excluirUsuarioQuadro($id){
		$dados = new Dados();
		
		$consulta = "delete from relacaoequipe where idUsuario = $id";
		
		$resultado = $dados->retornaQuery($consulta);
}

public function excluirTarefaEquipe($id){
		$dados = new Dados();
		
		$consulta = "delete from relacaoequipe where idEquipe = $id";
		
		$resultado = $dados->retornaQuery($consulta);
}

//função com os parametros nome tabela que será utilizada na consulta, o segundo parametro consulta é a query que será executada dentro da função exibe
//está função retorna uma estrutura para ser exibida.
public function exibe($nomeTabela,$consulta){
    
	//Aqui está sendo criado o objeto dados que será utilizado na execução do parametro consulta.
	$dados = new Dados();
	
	$mostra = array();
	
	$resultado = $dados->retornaQuery($consulta);

	//Verifica verifica se o resultado do retorno da query é vazio, se for recebe a estrutura de usuário não cadastrados.
	if(!$resultado){
		$mostra[0] = '<tr><td>Não há registros cadastrados</td></tr>';
		
		return $mostra;
	}
	
	//se houver dados inicia um array lista para associar a estrutura da consulta da tabela.
	else{		
		//laço que associa o resultado da query na variável campo.
 		while ($campo = mysqli_fetch_array($resultado)){
			
			//verifica qual a tabela está sendo consultada para a montagem da estrutura.
			switch($nomeTabela){
				
				case "usuario":
				$relacao = $this->retornaRelacaoUsuarioTarefa($campo["idUsuario"]);

				$estrutura = '<tr class="linhaUsuario"><td>'.$campo["nome"].'</td>'.
				 	'<td>'.$campo["funcao"].'</td>'.
					'<td class="botoes">'.
					'<div class="btn btn-warning" onclick="selecionaEdicaoUsuario('.($campo["idUsuario"]).')">Editar</div>'.
				    '<div class="excluir btn btn-danger" onclick="excluirRegistro('.strval($nomeTabela).','.($campo["idUsuario"]).','.$relacao.')">'.
					'Excluir</div></td></tr>';
				break;
				
				case "tarefa":
				$relacao = $this->retornaRelacaoTarefaQuadro($campo["idTarefa"]);
				$estrutura = '<tr class="tarefa"><td>'.$campo["titulo"].'</td>'.
				'<td>'.$campo["valorXP"].'</td>'.
				'<td>'.$campo["statusMissao"].'</td>'.
				'<td class="botoes">'.
				'<div class="btn btn-warning" onclick="selecionaEdicaoTarefa('.($campo["idTarefa"]).')">Editar</div>'.
				'<div class="btn btn-danger" onclick="excluirRegistro('.strval($nomeTabela).','.($campo["idTarefa"]).','.$relacao.')">'.
				'Excluir</div></td></tr>';
				break;
				
				case "relacaoEquipe":
				$relacao = 'false';
				$estrutura = '<tr class="equipeDev"><td>'.$campo["nome"].'</td>'.
					'<td>'.$campo["titulo"].'</td> '.
					'<td>'.$campo["status"].'</td>'. 
					'<td>'.$campo["dataInicio"].'</td>'.
					'<td>'.$campo["valorXP"].'</td>'.
					'<td>'.$campo["statusMissao"].'</td>'.
					'<td class="botoes">'.
					'<div class="btn btn-warning" onclick="selecionaEdicaoTarefa('.($campo["idTarefa"]).')">Editar</div>'.
					'<div class="btn btn-danger" onclick="excluirRegistro('.strval($nomeTabela).','.($campo["idEquipe"]).','.$relacao.')">'.
					'Excluir</div></td></tr>';
				break;
			}
			$mostra[] = $estrutura;
 		}
		return $mostra;
	}
}
//função que recebe instancia as variaves nomeTabela e consulta com a tabela usuario e a query de busca
//e retorna o que for executado na função exibe.

public function retornaUsuario(){
	$this->nomeTabela = "usuario";
	
	$this->consulta = 'select idUsuario,nome,funcao from usuario';
	
	return $this->exibe($this->nomeTabela,$this->consulta);
}

public function retornaTarefa(){
	$this->nomeTabela = "tarefa";
	
	$this->consulta = 'select tarefa.idTarefa,tarefa.titulo,tarefa.valorXP,relacaoequipe.statusMissao from tarefa,relacaoequipe '.
	'where tarefa.idTarefa = relacaoequipe.idTarefa';
	
	return $this->exibe($this->nomeTabela,$this->consulta);
}

public function retornaEquipeDev(){
	$this->nomeTabela = "relacaoEquipe";
	
	$this->consulta = 'select relacaoequipe.idEquipe, usuario.nome,tarefa.idTarefa, tarefa.titulo, tarefa.status, tarefa.dataInicio, tarefa.valorXP,relacaoequipe.statusMissao from usuario, 
	tarefa, relacaoequipe where usuario.idUsuario = relacaoEquipe.idUsuario and tarefa.idTarefa = relacaoequipe.idTarefa;';
	
	return $this->exibe($this->nomeTabela,$this->consulta);
}

public function retornaExibicao($elemento){

switch($elemento){
	case 'usuario':
	$mostraElemento = $this->retornaUsuario();
	break;

	case 'tarefa':
	$mostraElemento = $this->retornaTarefa();
	break;

	case 'equipe':
	$mostraElemento = $this->retornaEquipeDev();
	break;
        
    case 'ranking':
    $ranking = new Ranking();
	$mostraElemento = $ranking->retornaRanking();
	break;
}
$count = count($mostraElemento);

foreach ($mostraElemento as $i => $count) {
	
	echo($mostraElemento[$i]); 
	
	}
 }

 public function retornaRelacaoUsuarioTarefa($idUsuario){
	 $dados = new Dados();
	 
	 $selecionaTarefa = "select count(tarefa.mestre) as id from tarefa where tarefa.mestre = $idUsuario";

	 $resultado = $dados->retornaQuery($selecionaTarefa)->fetch_assoc();

	 $id = intval($resultado['id']);

		if($id < 1){
			return 'false';
		}
		else{
			return 'true';
		}
	}

public function retornaRelacaoTarefaQuadro($idTarefa){
	 $dados = new Dados();
	 
	 $selecionaTarefa = "select count(relacaoequipe.idTarefa) as id from relacaoequipe where relacaoequipe.idTarefa = $idTarefa";

	 $resultado = $dados->retornaQuery($selecionaTarefa)->fetch_assoc();

	 $id = intval($resultado['id']);

		if($id < 1){
			return 'false';
		}
		else{
			return 'true';
		}
	}
}
//Classe com funções de adicionar, selecionar e excluir usuário.
class Usuario{


public function getDadosUsuario($id){
	  $dados = new Dados();
	  
	  $editar = array();

	  $consulta = "select * from usuario where idUsuario = $id";
		
	  $resultado = $dados->retornaQuery($consulta);

	  $editar = mysqli_fetch_array($resultado);

	  return $editar;
}

public function getUsuarios(){
		$dados = new Dados();
		
		$consulta = "select idUsuario,nome from usuario";
		
		$resultado = $dados->retornaQuery($consulta);
		
		$mostraUsuario = array();

	if(!$resultado){
		$mostraUsuario[] = '<option>Não há registros cadastrados</option>';
		
		return $mostraUsuario;
	}
	else{		
 		while ($campo = mysqli_fetch_array($resultado)){
          $mostraUsuario[] = '<option value="'.$campo["idUsuario"].'">'.$campo['nome'].'</option>';		  
	   }
	   	return $mostraUsuario;
   } 
}

public function getUsuarioRelacao($usuario){
	    $dados = new Dados();
		
		$consulta = "select usuario.idEquipe from usuario,relacaoequipe ".
		"where usuario.idUsuario = relacaoequipe.idUsuario and usuario.idUsuario = $usuario";
		
		$resultado = $dados->retornaQuery($consulta);
		
		$mostraUsuario = array();

	if(!$resultado){
		$mostraUsuario[] = '-1';
		
		return $mostraUsuario;
	}
	else{		
 		while ($campo = mysqli_fetch_array($resultado)){
          $mostraUsuario[] = $campo["idEquipe"];		  
	   }
	   	return $mostraUsuario;
   } 
}
public function adicionarUsuario($nome, $email, $senha, $cpf, $funcao, $id){
		$dados = new Dados();

		$consulta = "insert into usuario (nome, email, senha, CPF, funcao, personagem) values('$nome','$email','$senha','$cpf','$funcao','$id')";
		
		$resultado = $dados->retornaQuery($consulta);
	}

public function atualizarUsuario($id,$nome, $email, $senha, $cpf, $funcao, $personagem){
		$dados = new Dados();

		$consulta = "UPDATE usuario SET nome='$nome', email='$email', senha='$senha', cpf='$cpf', funcao = '$funcao', foto='$personagem' where idUsuario = $id";
		
		$resultado = $dados->retornaQuery($consulta);
}
public function excluirUsuario($id){
		$dados = new Dados();
		
		$consulta = "delete from usuario where idUsuario = $id";
		
		$resultado = $dados->retornaQuery($consulta);
	}
    
public function retornaImagem($idUsuario){
	$dados = new Dados();
    
    $consulta = "select personagens.caminhoFoto from usuario,personagens where usuario.personagem = personagens.idPersonagem and idUsuario = $idUsuario";
	
    $resultado = $dados->retornaQuery($consulta);
    
    $foto=$resultado->fetch_assoc();
    
	return $foto['caminhoFoto'];
}

public function retornaBanner($idUsuario){
	$dados = new Dados();
    
    $consulta = "select personagens.caminhoBanner from usuario,personagens where usuario.personagem = personagens.idPersonagem and idUsuario = $idUsuario";
	
    $resultado = $dados->retornaQuery($consulta);
    
    $foto=$resultado->fetch_assoc();
    
	return "background: url('".$foto['caminhoBanner']."') no-repeat;";
}
}

//Classe com funções de adicionar, selecionar e excluir tarefa.

class Tarefa{
	
	public function getIdTarefa(){
		$dados = new Dados();
		
		$consulta = "select max(idTarefa) as id from tarefa";
		
		$resultado = $dados->retornaQuery($consulta);
		
		$id=$resultado->fetch_assoc();

		return intval($id['id']);
	}

	public function getDadosTarefa($id){
	  $dados = new Dados();
	  
	  $editar = array();

	  $consulta = "select * from tarefa where idTarefa = $id";
		
	  $resultado = $dados->retornaQuery($consulta);

	  $editar = mysqli_fetch_array($resultado);

	  return $editar;
}
public function adicionarTarefa($mestre, $titulo, $descricao, $status, $valorXP, $dataInicio,$dataLimite){
		$dados = new Dados();
		
		$consulta = "insert into tarefa (mestre, titulo, descricao, status, valorXP, dataInicio, dataLimite) values ($mestre, '$titulo', '$descricao', '$status', $valorXP, '$dataInicio','$dataLimite')";
		
		$resultado = $dados->retornaQuery($consulta);
	}
public function atualizarTarefa($id,$mestre,$titulo, $descricao, $status, $valorXP, $dataInicio, $dataLimite){
		$dados = new Dados();

		$consulta = "UPDATE tarefa SET mestre='$mestre', titulo='$titulo', descricao='$descricao', status='$status', valorXP = '$valorXP', dataInicio='$dataInicio', datalimite='$dataLimite' where idTarefa = $id";
		
		$resultado = $dados->retornaQuery($consulta);
	}
	public function excluirTarefa($id){
		$dados = new Dados();
		
		$consulta = "delete from tarefa where idTarefa = $id";
		
		$resultado = $dados->retornaQuery($consulta);
	}

	public function excluirTarefaUsuario($id){
		$dados = new Dados();
		
		$consulta = "delete from tarefa where mestre = $id";
		
		$resultado = $dados->retornaQuery($consulta);
	}
}

class Ranking{
    public function retornaRanking(){
	$dados = new Dados();
        
	$consulta = "select nome, funcao, xpMes from usuario where funcao != 'mestre' order by xpMes desc";
        
    $resultado = $dados->retornaQuery($consulta);
	
	$mostraRank = Array();
	
	if(!$resultado){
		$mostraRank[0] = '<tr><td>Não há registros cadastrados</td></tr>';
		
		return $mostra;
	}
	
	//se houver dados inicia um array lista para associar a estrutura da consulta da tabela.
	else{		
		//laço que associa o resultado da query na variável campo.
 		while ($campo = mysqli_fetch_array($resultado)){
			
			//verifica qual a tabela está sendo consultada para a montagem da estrutura.

            $estrutura = '<tr class="linhaUsuario"><td>'.$campo["nome"].'</td>'.
                '<td>'.$campo["funcao"].'</td>'.
                '<td>'.$campo["xpMes"].'</td>'.
                '</td></tr>';
            
            $mostraRank[] = $estrutura; 	
    }
        return $mostraRank;

    }
    }
}
?>

