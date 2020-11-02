<?php
    session_start();
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
    }
    if($_SESSION['tipo']=='cliente'){
        header('location:sair.php');
    }
    include("conecta.php");
    $idvendedor = $_SESSION["idvendedor"];
    $idpedido = $_GET['idpedido'];
    $sql = "UPDATE pedidos SET fk_idvendedor=$idvendedor,data_pedido=curdate(),status_pedido='OK' WHERE idpedidos=$idpedido";
    if(mysqli_query($conn,$sql)){
        echo "<script language='javascript' type='text/javascript'>
        alert('Pedido Aceito com Sucesso!');
        window.location.href = 'home2.php';
        </script>";
    }
    else{
        echo "<script language='javascript' type='text/javascript'>
        alert('Falha na tentativa de aceitar o pedido!');
        window.location.href = 'home2.php';
        </script>";
    }
?>