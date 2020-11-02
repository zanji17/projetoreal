<?php
    session_start();
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
    }
    if($_SESSION['tipo']!='gerente'){
        header('location:sair.php');
    }
    include("conecta.php");
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $status_pessoas = $_POST['status_pessoas'];
    $login = $_POST['login'];
    $senha = base64_encode($_POST['senha']);
    $tipo = $_POST['cargo'];
    $pessoas = mysqli_query($conn, "SELECT * FROM pessoas WHERE cpf='".$cpf."'");
    if(mysqli_num_rows($pessoas)>0 or $cpf>200000000){
        echo "<script language='javascript' type='text/javascript'>
        alert('Pessoa já cadastrada!');
        window.location.href = 'cadvendedor.php';
        </script>";
        mysqli_close($conn);
    }
    $usuario = mysqli_query($conn, "SELECT * FROM usuarios WHERE login='".$login."' and senha='".$senha."'");
    if(mysqli_num_rows($usuario)>0){
        echo "<script language='javascript' type='text/javascript'>
        alert('Pessoa já cadastrada!');
        window.location.href = 'cadvendedor.php';
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
        window.location.href = 'cadvendedor.php';
        </script>";
    }
    //cadastro de dados na tabela vendedor
    $sql2 = mysqli_query($conn, "SELECT * FROM pessoas WHERE cpf='".$cpf."'");
    $vendedor=mysqli_fetch_array($sql2);
    $idpessoas=$vendedor['idpessoas'];
    $salario = $_POST['salario'];
    $sql3 = "INSERT INTO vendedores(salario,fk_idpessoas) VALUES('$salario','$idpessoas')";
    if(mysqli_query($conn, $sql3)){
    }
    else{
        echo "<script language='javascript' type='text/javascript'>
        alert('Pessoa não foi cadastrada com sucesso!');
        window.location.href = 'cadvendedor.php';
        </script>";
    }
    //cadastro de dados na tabela usuarios
    $sql4 = "INSERT INTO usuarios(login,senha,tipo,fk_idpessoas) VALUES('$login','$senha','$tipo',$idpessoas)";
    if(mysqli_query($conn, $sql4)){
        echo "<script language='javascript' type='text/javascript'>
        alert('Pessoa cadastrada com sucesso!');
        window.location.href = 'cadvendedor.php';
        </script>";
    }
    else{
        echo "<script language='javascript' type='text/javascript'>
        alert('Pessoa não foi cadastrada com sucesso!');
        window.location.href = 'cadvendedor.php';
        </script>";
    }
    mysqli_close($conn);
?>