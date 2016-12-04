<?php
 require_once("usuario.php");

$equipe = $_POST["equipe"];

$comentario = new Comentario();

$comentario->adicionarComentario($equipe,$_POST["comentario"]);

$status = new QuadroUsuario();

$status->adicionarStatus($equipe,$_POST["status"]);

header('Location: index.php');
?>