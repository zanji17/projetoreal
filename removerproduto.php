<?php
    session_start();
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
    }
    include("conecta.php");
    $idpedido=$_SESSION['idpedidos'];
    $idproduto=$_GET['idprodutos'];
    $sql = "DELETE FROM pedidos_produtos WHERE fk_pedidos_idpedidos=$idpedido and fk_produtos_idprodutos=$idproduto";
    if(mysqli_query($conn, $sql)){
        echo "<script language='javascript' type='text/javascript'>
        alert('Item removido do Pedido!');
        window.location.href = 'escolhidos.php';
        </script>";
    }
    else{
        echo "<script language='javascript' type='text/javascript'>
        alert('Falha! Item não foi removido do Pedido.');
        window.location.href = 'escolhidos.php';
        </script>";
    }
    mysqli_close($conn);
?>