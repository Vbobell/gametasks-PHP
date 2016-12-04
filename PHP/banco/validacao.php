<html>
    <head>
    </head>
    <body>
    
    <?php 
        require_once("retornaDados.php");

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $dados = new Dados();
                
        $consulta = 'select * from usuario where email = "'.$email.'" and senha = "'.$senha.'";';
        $resultado = $dados->retornaQuery($consulta);

        if(!$resultado){
            echo "Não há registros cadastrados!";
        }
        else{
            if (is_null(mysqli_fetch_array($resultado))) {                
                header('Location:../../index.php');
            }else{
                $resultado = $dados->retornaQuery($consulta);
                while ($campo = mysqli_fetch_array($resultado)){   
            
                    if ($campo["funcao"] == "gerente") {
                        echo "ADMIN";

                        session_start();
                        $_SESSION['email']=$_POST['email'];
                        $_SESSION['nome'] = $campo['nome'];
                        $_SESSION['id']=$campo['idUsuario'];
                        $_SESSION['admin']=true;
                        header('Location: ../quadroTarefa/index.php');
                    }else {
                        echo "NOT ADMIN";

                        session_start();
                        $_SESSION['email']=$_POST['email'];
                        $_SESSION['nome'] = $campo['nome'];
                        $_SESSION['id']=$campo['idUsuario'];
                        $_SESSION['admin']=false;
                        header('Location: ../quadroUsuario/index.php');
                    }
                }
            }
        }
    ?>
    </body>
</html>