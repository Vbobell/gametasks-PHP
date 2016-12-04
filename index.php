<!DOCTYPE html>
<html lang="pt">

<head>
<?php
require("PHP/links.php");

?>
<link rel="stylesheet" href="/gametasks/CSS/home.css">
</head>
<?php
	if($_SESSION != null){
		if($id != "" && $admin == true){
			header("Location: PHP/quadroTarefa/");
		}
		else if($id != "" && $admin == false){
			header("Location: PHP/quadroUsuario/");
		}
	}
	require_once("PHP/banco/retornaDados.php");
?>
<body>
<header class="col-xs-12 col-lg-4 login">
	<!--FORMULARIO DE LOGIN-->
	<form method="POST" action="PHP/banco/validacao.php" class="form-horizontal">
		<div class="form-group text-center">
		<label class="control-label col-sm-2 col-lg-12 labelForm" for="email">Pergaminho eletrônico</label>
		<div class="col-sm-10 col-lg-12">
			<input type="text" class="form-control" id="email" name="email" placeholder="e-mail" required>
		</div>
		</div>
		<div class="form-group text-center">
		<label class="control-label col-sm-2 col-lg-12 labelForm" for="pwd">Código secreto</label>
		<div class="col-sm-10 col-lg-12">
			<input type="password" class="form-control" id="pwd" name="senha" placeholder="senha" required>
		</div>
		</div>
		<div class="form-group">
		<div class="col-sm-12 text-center">
			<button type="submit" class="btn btn-default text-center">Entrar</button>
		</div>
		<!--<div class="col-sm-12 text-center">
			<button type="submit" class="btn btn-default text-center">Recuperar senha</button>
		</div>-->
		</div>
	</form>
</header>
	<!--FIM FORMULARIO DE LOGIN-->
	<?php
	require("js/quadroAdm.php");
	?>
	
	<script src="js/funcoesAdm.js">
	</script>
	<script>
	$(document).ready(function() {
		alturaPagina();
		menuLateral();
		botaoMenu();
		adicionar();
		fechaModal();
        mostraPerfil();

	});   
	</script>
</body>

</html>
