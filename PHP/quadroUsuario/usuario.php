<?php
require_once("../banco/retornaDados.php");
require_once("../quadroTarefa/quadroTarefasAdm.php");


class QuadroUsuario extends Usuario{

    public function retornaTarefaUsuario(){
    
    $dados = new Dados();
        
	$consulta = 'select tarefa.idTarefa,relacaoequipe.idEquipe,tarefa.titulo, tarefa.descricao, tarefa.dataInicio, tarefa.dataLimite, tarefa.valorXP, tarefa.status from tarefa '.
    'inner join relacaoequipe on tarefa.idTarefa = relacaoequipe.idTarefa '.
    'left join usuario on usuario.idUsuario = relacaoequipe.idUsuario WHERE usuario.idUsuario ='.$_SESSION['id'].' ORDER by relacaoequipe.idEquipe';
        
    $resultado = $dados->retornaQuery($consulta);
	
	$mostraTarefa = Array();
	
	if(!$resultado){
		$mostraTarefa[] = '<tr><td>Não há registros cadastrados</td></tr>';
		
		return $mostraTarefa;
	}
	
	//se houver dados inicia um array lista para associar a estrutura da consulta da tabela.
	else{		
		//laço que associa o resultado da query na variável campo.
 		while ($campo = mysqli_fetch_array($resultado)){

            $estrutura = '<tr class="usuario">'.
                    '<td>'.$campo["titulo"].'</td>'.
                    '<td style="width:250px;">'.$campo["descricao"].'</td>'.
                    '<td>'.$campo["dataInicio"].'</td>'.
                    '<td>'.$campo["dataLimite"].'</td>'.
                    '<td>'.$campo["valorXP"].'</td>'.
                    '<td>'.$campo["status"].'</td>'.
                    '<td style="width:80px;">'.'<div class="botoes"><div style="width:80%;" class="btn btn-warning btn btn-warning" onclick="adicionarStatus('.($campo["idTarefa"]).','.($campo["idEquipe"]).')">relatório de missões</div></div>'.'</td>'.
                '</tr>';
            
            $mostraTarefa[] = $estrutura; 	
        }
        return $mostraTarefa;

        }
    }
    
public function retornaExibicao($elemento){

    switch($elemento){
        case 'tarefa':
        $mostraElemento = $this->retornaTarefaUsuario();
        break;

    }
    $count = count($mostraElemento);

    foreach ($mostraElemento as $i => $count) {
        
        echo($mostraElemento[$i]); 
        
    }
 }

 public function adicionarStatus($idEquipe,$status){
      $dados = new Dados();

	  $consulta = "update relacaoequipe set statusMissao ='$status' where idEquipe = $idEquipe";

      $resultado = $dados->retornaQuery($consulta);
 }

}

class Comentario{
    public function adicionarComentario($idEquipe,$comentario){
        $dados = new Dados();
        
	    $consulta = "insert into comentario (idEquipe,textoComentario) values ($idEquipe,'$comentario')";

        $resultado = $dados->retornaQuery($consulta);
    }

    public function retornaComentario($idTarefa){
    $dados = new Dados();
        
	$consulta = "select usuario.nome, comentario.textoComentario from usuario ".
                "right join relacaoequipe on usuario.idUsuario = relacaoequipe.idUsuario ".
                "right join comentario on relacaoequipe.idEquipe = comentario.idEquipe ".
                "where relacaoequipe.idTarefa = $idTarefa";
    
    $resultado = $dados->retornaQuery($consulta);
    $mostraComentario = Array();
    if(!$resultado){
		$mostraComentario[] = 'Não há registros cadastrados';
		
		return $mostraComentario;
	}
	
	//se houver dados inicia um array lista para associar a estrutura da consulta da tabela.
	else{		
		//laço que associa o resultado da query na variável campo.
 		while ($campo = mysqli_fetch_array($resultado)){
        
            $estrutura = $campo["nome"].'|'.$campo["textoComentario"];
            
            $mostraComentario[] = $estrutura; 	
        }
        return $mostraComentario;

        }
}
}

?>