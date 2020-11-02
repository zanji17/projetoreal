<?php
    include("conecta.php");
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $status_pessoas = $_POST['status_pessoas'];
    $login = $_POST['login'];
    $senha = base64_encode($_POST['senha']);
    $tipo = 'cliente';
    $pessoas = mysqli_query($conn, "SELECT * FROM pessoas WHERE cpf='".$cpf."'");
    if(mysqli_num_rows($pessoas)>0 or $cpf>200000000){
        echo "<script language='javascript' type='text/javascript'>
        alert('Pessoa já cadastrada!');
        window.location.href = 'cadcliente.php';
        </script>";
        mysqli_close($conn);
    }
    $usuario = mysqli_query($conn, "SELECT * FROM usuarios WHERE login='".$login."' and senha='".$senha."'");
    if(mysqli_num_rows($usuario)>0){
        echo "<script language='javascript' type='text/javascript'>
        alert('Pessoa já cadastrada!');
        window.location.href = 'cadcliente.php';
        </script>";
        mysqli_close($conn);
    }
    //cadastro de dados na tabela pessoas
    $sql = "INSERT INTO pessoas(nome,cpf,status_pessoas) VALUES('$nome','$cpf','$status_pessoas')";
    if(mysqli_query($conn, $sql)){
    }
    else{
        echo "<script language='javascript' type='text/javascript'>
        alert('Pessoa não foi cadastrada com sucesso!');
        window.location.href = 'index.php';
        </script>";
    }
    //cadastro de dados na tabela clientes
    $sql2 = mysqli_query($conn, "SELECT * FROM pessoas WHERE cpf='".$cpf."'");
    $cliente=mysqli_fetch_array($sql2);
    $idpessoas=$cliente['idpessoas'];
    $renda = $_POST['renda'];
    $credito = 0;
    $sql3 = "INSERT INTO clientes(renda,credito,fk_idpessoa) VALUES('$renda','$credito','$idpessoas')";
    if(mysqli_query($conn, $sql3)){
    }
    else{
        echo "<script language='javascript' type='text/javascript'>
        alert('Pessoa não foi cadastrada com sucesso!');
        window.location.href = 'index.php';
        </script>";
    }
    //cadastro de dados na tabela usuarios
    $sql4 = "INSERT INTO usuarios(login,senha,tipo,fk_idpessoas) VALUES('$login','$senha','$tipo',$idpessoas)";
    if(mysqli_query($conn, $sql4)){
        echo "<script language='javascript' type='text/javascript'>
        alert('Pessoa cadastrada com sucesso!');
        window.location.href = 'index.php';
        </script>";
    }
    else{
        echo "<script language='javascript' type='text/javascript'>
        alert('Pessoa não foi cadastrada com sucesso!');
        window.location.href = 'index.php';
        </script>";
    }
    mysqli_close($conn);
?>