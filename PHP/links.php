<!DOCTYPE html>
<html lang="pt-br">
<meta charset="UTF-8"/>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
    <link href="/gametasks/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/gametasks/css/simple-sidebar.css" rel="stylesheet">
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
    <script src="/gametasks/js/jquery.js"></script>
    <link rel="stylesheet" href="/gametasks/CSS/geral.css">
    <?php
        session_start();
        if($_SESSION != null){
            $id = $_SESSION['id'];
            $user = $_SESSION['nome'];
            $admin = $_SESSION['admin'];
        }
    ?>
</head>
<body>
</body>
</html>