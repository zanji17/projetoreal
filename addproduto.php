<?php
    session_start();
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
    }
    include("conecta.php");
    $idpedido=$_SESSION['idpedidos'];
    $idproduto=$_GET['idprodutos'];
    $quantidade = $_POST['qtde'];
    if($quantidade<=0){
        mysqli_close($conn);
        header('location:home.php');
    }
    $sql = mysqli_query($conn,"SELECT * FROM produtos WHERE idprodutos=$idproduto");
    $produto = mysqli_fetch_array($sql);
    $sql2 = mysqli_query($conn,"SELECT * FROM pedidos_produtos WHERE fk_pedidos_idpedidos=$idpedido and fk_produtos_idprodutos=$idproduto");
    if(mysqli_num_rows($sql2)>0){
        $itempedido = mysqli_fetch_array($sql2);
        $qtde = $quantidade+$itempedido['qtde'];
        $valor = $qtde*$produto['valor'];
        if($produto['estoque']<$qtde){
            echo "<script language='javascript' type='text/javascript'>
            alert('Não foi possível adicionar ao Pedido! Por ultrapassar a quantidade em estoque');
            window.location.href = 'home.php';
            </script>";
            mysqli_close($conn);
        }
        $sql3 = "UPDATE pedidos_produtos set qtde=$qtde,valor=$valor WHERE fk_pedidos_idpedidos=$idpedido and fk_produtos_idprodutos=$idproduto";
        if(mysqli_query($conn, $sql3)){
            echo "<script language='javascript' type='text/javascript'>
            alert('Item adicionado ao Pedido!');
            window.location.href = 'home.php';
            </script>";
        }
        else{
            echo "<script language='javascript' type='text/javascript'>
            alert('Falha! Item não foi adicionado ao Pedido.');
            window.location.href = 'home.php';
            </script>";
        }
        mysqli_close($conn);
    }
    else{
        $qtde2 = $quantidade;
        $valor2 = $qtde2*$produto['valor'];
        if($produto['estoque']<$qtde2){
            echo "<script language='javascript' type='text/javascript'>
            alert('Não foi possível adicionar ao Pedido! Por ultrapassar a quantidade em estoque');
            window.location.href = 'home.php';
            </script>";
            mysqli_close($conn);
        }
        $sql4 = "INSERT INTO pedidos_produtos(fk_pedidos_idpedidos,fk_produtos_idprodutos,qtde,valor) VALUES('$idpedido','$idproduto','$qtde2','$valor2')";
        if(mysqli_query($conn, $sql4)){
            echo "<script language='javascript' type='text/javascript'>
            alert('Item adicionado ao Pedido!');
            window.location.href = 'home.php';
            </script>";
        }
        else{
            echo "<script language='javascript' type='text/javascript'>
            alert('Falha! Item não foi adicionado ao Pedido.');
            window.location.href = 'home.php';
            </script>";
        }
        mysqli_close($conn);
    }
?>