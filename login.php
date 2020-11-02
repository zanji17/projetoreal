<?php
    //Iniciar uma sessão
    session_start();
    include("conecta.php");
    $login = $_POST['login'];
    $senha = base64_encode($_POST['senha']);
    $logar = mysqli_query($conn, "SELECT * FROM usuarios inner join pessoas on usuarios.fk_idpessoas=pessoas.idpessoas WHERE login = '$login' AND senha = '$senha'") or die(mysqli_connect_error()); 
    if(mysqli_num_rows($logar)>0){
        $usuario = mysqli_fetch_array($logar);
        $tipo = $usuario['tipo'];
        $idpessoa=$usuario['idpessoas'];
        if($tipo == "cliente"){
            $sql = mysqli_query($conn,"SELECT * FROM clientes WHERE fk_idpessoa=$idpessoa");
            $cliente = mysqli_fetch_array($sql);
            $_SESSION["idcliente"] = $cliente['idcliente'];
        }
        else{
            $sql2 = mysqli_query($conn,"SELECT * FROM vendedores WHERE fk_idpessoas=$idpessoa");
            $vendedor = mysqli_fetch_array($sql2);
            $_SESSION["idvendedor"] = $vendedor['idvendedor'];
        }
        $_SESSION["user"] = $usuario['nome'];
        $_SESSION["status"] = "OK";
        $_SESSION["tipo"] = $usuario['tipo'];
        echo "<script type='text/javascript'>
        location.href='verificar.php';
        </script>";
    }
    else {
        echo "<script type='text/javascript'>
        alert('Login ou senha incorretos! Tente novamente!');
        location.href='index.php';
        </script>";
    }

    mysqli_close($conn);
?>