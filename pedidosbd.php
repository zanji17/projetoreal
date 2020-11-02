<?php
    session_start();
    include("conecta.php");
    $idcliente= $_SESSION["idcliente"];
    $teste = mysqli_query($conn, "SELECT * FROM pedidos where status_pedido='EE' and fk_idcliente=$idcliente") or die(mysqli_connect_error());
    if(mysqli_num_rows($teste)>0){
        $idpedido = mysqli_fetch_array($teste);
        $_SESSION["idpedidos"] = $idpedido['idpedidos'];
        mysqli_close($conn);
        header('location:home.php');
    }
    else{
        $sql = "INSERT INTO pedidos(valor,status_pedido,fk_idcliente) VALUES(0,'EE','$idcliente')";
        if(mysqli_query($conn, $sql)){
        }
        else{
            echo "<script language='javascript' type='text/javascript'>
            window.location.href = 'index.php';
            </script>";
        }
        $pedido = mysqli_query($conn, "SELECT * FROM pedidos where status_pedido='EE' and fk_idcliente=$idcliente") or die(mysqli_connect_error());
        $idpedido = mysqli_fetch_array($pedido);
        $_SESSION["idpedidos"] = $idpedido['idpedidos'];
        mysqli_close($conn);
        header('location:home.php');
    }
?>