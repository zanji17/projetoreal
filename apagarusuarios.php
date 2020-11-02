<?php
    session_start();
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
    }
    if($_SESSION['tipo']!='gerente'){
        header('location:sair.php');
    }
    include("conecta.php");
    $idpessoa = $_GET['idpessoa'];
    $sql = mysqli_query($conn, "SELECT * FROM pessoas INNER JOIN usuarios on pessoas.idpessoas=usuarios.fk_idpessoas WHERE idpessoas=$idpessoa");
    $usuario = mysqli_fetch_array($sql);
    $tipo = $usuario['tipo'];
    if($tipo=="cliente"){
        $sql2=mysqli_query($conn,"SELECT * FROM clientes WHERE fk_idpessoa=$idpessoa");
        $cliente = mysqli_fetch_array($sql2);
        $idcliente = $cliente['idcliente'];
        $sql3 = mysqli_query($conn,"SELECT * FROM pedidos WHERE fk_idcliente=$idcliente");
        while($pedidos = mysqli_fetch_array($sql3)){
            $idpedido = $pedidos['idpedidos'];
            mysqli_query($conn,"DELETE FROM pedidos_produtos WHERE fk_pedidos_idpedidos=$idpedido");
        }
        mysqli_query($conn,"DELETE FROM pedidos WHERE fk_idcliente=$idcliente");
        mysqli_query($conn,"DELETE FROM clientes WHERE idcliente=$idcliente");
    }
    else{
        $sql2=mysqli_query($conn,"SELECT * FROM vendedores WHERE fk_idpessoas=$idpessoa");
        $vendedor = mysqli_fetch_array($sql2);
        $idvendedor = $vendedor['idvendedor'];
        mysqli_query($conn,"UPDATE pedidos SET fk_idvendedor = NULL WHERE fk_idvendedor=$idvendedor");
        mysqli_query($conn,"DELETE FROM vendedores WHERE idvendedor=$idvendedor");
    }
    mysqli_query($conn,"DELETE FROM usuarios WHERE fk_idpessoas=$idpessoa");
    $sql4 = "DELETE FROM pessoas WHERE idpessoas=$idpessoa";
    if(mysqli_query($conn,$sql4)){
        echo "<script type='text/javascript'>
        alert('Usuário Apagado com Sucesso!');
        location.href='usuarios.php';
        </script>";
    }
    else{
        echo "<script type='text/javascript'>
        alert('Usuário não foi Apagado com Sucesso!');
        location.href='usuarios.php';
        </script>";
    }

?>