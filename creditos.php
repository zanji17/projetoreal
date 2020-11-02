<?php
    session_start();
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
    }
    if($_SESSION['tipo']=='cliente'){
        header('location:sair.php');
    }
    include("conecta.php");
    $idcliente=$_GET['idcliente'];
    $credito=$_POST['credito'];
    $sql = mysqli_query($conn, "SELECT * FROM clientes WHERE idcliente=$idcliente");
    $cliente = mysqli_fetch_array($sql);
    $fkpessoa = $cliente['fk_idpessoa'];
    $credito_atual = $cliente['credito'];
    $novo_credito= $credito_atual+$credito;
    $sql2 = "UPDATE clientes SET credito=$novo_credito WHERE idcliente=$idcliente";
    if(mysqli_query($conn,$sql2)){
        echo "<script type='text/javascript'>
        alert('Crédito Atualizado com Sucesso!');
        location.href='perfil.php?idpessoa=$fkpessoa';
        </script>";
    }
    else{
        echo "<script type='text/javascript'>
        alert('Crédito não foi Atualizado com Sucesso!');
        location.href='perfil.php?idpessoa=$fkpessoa';
        </script>";
    }
?>