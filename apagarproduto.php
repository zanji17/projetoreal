<?php
    session_start();
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
    }
    if($_SESSION['tipo']!='gerente'){
        header('location:sair.php');
    }
    include("conecta.php");
    $idproduto=$_GET['idproduto'];
    mysqli_query($conn,"DELETE FROM pedidos_produtos WHERE fk_produtos_idprodutos=$idproduto");
    $sql = "DELETE FROM produtos WHERE idprodutos=$idproduto";
    if(mysqli_query($conn,$sql)){
        echo "<script language='javascript' type='text/javascript'>
            alert('Produto Apagado com Sucesso!');
            window.location.href = 'produtos.php';
            </script>";
    }
    else{
        echo "<script language='javascript' type='text/javascript'>
            alert('Produto não foi Apagado com Sucesso!');
            window.location.href = 'produtos.php';
            </script>";
    }
    mysqli_close($conn);
?>