<?php 
    require_once("quadroTarefasAdm.php");

    $excluir = $_GET['excluir'];
    $relacao = $_GET['relacao'];

    switch($excluir){

    case "usuario":
    if($relacao == 'true'){
        $quadro = new QuadroTarefa();
        $quadro->excluirUsuarioQuadro($_GET["id"]);

        $tarefa = new Tarefa();
        $tarefa->excluirTarefaUsuario($_GET["id"]);

        $usuario = new Usuario();
        $usuario->excluirUsuario($_GET["id"]);
    }
    else{
        $usuario = new Usuario();
        $usuario->excluirUsuario($_GET["id"]);
    }
    break;
    
    case "tarefa":
     if($relacao == 'true'){
        $quadro = new QuadroTarefa();
        $quadro->excluirTarefaQuadro($_GET["id"]);

        $tarefa = new Tarefa();
        $tarefa->excluirTarefa($_GET["id"]);
    }
    else{
        $tarefa = new Tarefa();
        $tarefa->excluirTarefa($_GET["id"]);
    }
    break;

    case "relacaoEquipe":
        $quadro = new QuadroTarefa();
        $quadro->excluirTarefaEquipe($_GET["id"]);
    break;
    }
    

    header('Location: index.php');
    
?>
