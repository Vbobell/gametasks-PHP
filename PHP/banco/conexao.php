<?php 

class MySQL{
    
	//Variaveis que servem como parametros de conexão com o banco de dados.
    var $servidor = "localhost";
    var $usuario = "root";
    var $senha = "";
    var $base = "gameTasks";
    var $tipo = "mysql";
    var $link = "";
    
//Construtor para instanciar a classe.
public function MySQL(){
    
}
//Função que faz o acesso a base de dados e retorna o resultado.
public function conexao(){
    $link = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->base);

    mysqli_set_charset($link,"utf8");
	
	//verifica se a base está 100%.
    if (!$link) {
        $link = 'Não há conexão!';
        exit;
        }
        
    return $link;
}
//Fecha a conexão com o banco.
public function desconectar(){
    mysqli_close($this->link);
}
}
?>