<?php
	
	session_start();

	$user = $_SESSION['email'];
	$id = $_SESSION['id'];
	$admin = $_SESSION['admin'];

	if (is_null($user)) {
	    session_destroy();
	    header ("Location: ../../index.php");
	}

	echo "<h2>Olá $user - $id</h2>";
	echo "<a href='../logout.php'><input type='button' value='Sair'></a>";
	echo "<hr>";
?>