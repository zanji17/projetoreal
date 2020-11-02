<?php
    session_start();
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
    }
    if($_SESSION['tipo']!='gerente'){
        header('location:sair.php');
    }
    include("conecta.php");
    $idpedido = $_GET['idpedido'];
    mysqli_query($conn,"DELETE FROM pedidos_produtos WHERE fk_pedidos_idpedidos=$idpedido");
    $sql="DELETE FROM pedidos WHERE idpedidos=$idpedido";
    if(mysqli_query($conn,$sql)){
        echo "<script type='text/javascript'>
        alert('Pedido Apagado com Sucesso!');
        location.href='allpedidos.php';
        </script>";
    }
    else{
        echo "<script type='text/javascript'>
        alert('Pedido não foi Apagado com Sucesso!');
        location.href='allpedidos.php';
        </script>";
    }

?>