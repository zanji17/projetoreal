<?php
    session_start();
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
    }
    if($_SESSION['tipo']=='cliente'){
        header('location:sair.php');
    }
    include("conecta.php");
    $idproduto = $_POST['idproduto'];
    $idpedido = $_GET['idpedido'];
    $sql = mysqli_query($conn, "SELECT * FROM pedidos_produtos WHERE fk_produtos_idprodutos=$idproduto and fk_pedidos_idpedidos=$idpedido");
    $produto = mysqli_fetch_array($sql);
    $valor = $produto['valor'];
    if(isset($_POST['desconto_porcento'])){
        $porcento = $_POST['desconto_porcento'];
        $desconto= $valor*($porcento/100);
    }
    if(isset($_POST['desconto_normal'])){
        $desconto = $_POST['desconto_normal'];
    }
    $valor_final = $valor - $desconto;
    if($valor_final<0){
        $valor_final = 0;
    }
    mysqli_query($conn,"UPDATE pedidos_produtos SET valor=$valor_final WHERE fk_produtos_idprodutos=$idproduto and fk_pedidos_idpedidos=$idpedido");
    $sql2 = mysqli_query($conn, "SELECT sum(valor) as valor from pedidos_produtos WHERE fk_pedidos_idpedidos=$idpedido");
    $pedidos_produtos = mysqli_fetch_array($sql2);
    $valortotal = $pedidos_produtos['valor'];
    $sql3 = "UPDATE pedidos SET valor=$valortotal WHERE idpedidos=$idpedido";
    if(mysqli_query($conn,$sql3)){
        echo "<script language='javascript' type='text/javascript'>
           alert('Desconto Realizado com Sucesso!');
           window.location.href = 'detalhescompra.php?idpedido=$idpedido';
           </script>";
    }
    else{
        echo "<script language='javascript' type='text/javascript'>
            alert('Desconto não foi Realizado com Sucesso!');
            window.location.href = 'detalhescompra.php?idpedido=$idpedido';
            </script>";
    }
    mysqli_close($conn);
    
?>