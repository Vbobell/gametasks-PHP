<?php
//faz a importação do arquivo que de conexão.
require_once("conexao.php");


class Dados{

//Construtor para instanciar a classe.
public function Dados(){
}

//função genérica que retorna qualquer query que for executada no banco retorna o resultado e desconecta da base.

public function retornaQuery($executaQuery){
		
	$mySQL = new MySQL();
	
	$con = $mySQL->conexao();

	$result = $con->query($executaQuery);
	
	return $result;

	$desconectar = $mySQL->desconectar();
	
	}
		
}
?>

