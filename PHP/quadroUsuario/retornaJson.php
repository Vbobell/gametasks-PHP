<?php 
require_once("usuario.php");

    $resultado = new Comentario();
    $converteJson = Array();
    $data = Array();
    $converteJson = $resultado->retornaComentario($_POST['tarefa']);
    for($i = 0 ; $i < sizeof($converteJson); $i++){
            $quebra = explode("|",$converteJson[$i]);
            $dataC = array(
            'nome' => $quebra[0],
            'comentario' => $quebra[1]
            );
            $data[] = $dataC; 
     }
    echo json_encode($data);
?>