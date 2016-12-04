<?php 
    require_once("quadroTarefasAdm.php");

    $adicionar = $_POST['adicionar'];
    
    switch($adicionar){

    case "usuario":
        $usuario = new Usuario();

        $usuario->adicionarUsuario($_POST["nome"],$_POST["email"],$_POST["senha"],$_POST["cpf"],$_POST["funcao"],intval($_POST["personagem"]));
    break;
    
    case "tarefa":
        $tarefa = new Tarefa();
   
        $tarefa->adicionarTarefa($_POST["mestre"], $_POST["titulo"], $_POST["descricao"], $_POST["status"], $_POST["valorXP"], $_POST["dataInicio"],$_POST["dataLimite"]);
        
        $id = $tarefa->getIdTarefa();
        
        var_dump($id);

        $quadro = new QuadroTarefa();

        $quadro->adicionarQuadro($id,$_POST["mestre"]);
    break;
    }
    

    header('Location: index.php');
    
?>
