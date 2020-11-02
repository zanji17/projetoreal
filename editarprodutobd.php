<?php
    session_start();
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
    }
    if($_SESSION['tipo']=='cliente'){
        header('location:sair.php');
    }
    include("conecta.php");
    $idproduto=$_GET['idproduto'];
    $descricao=$_POST['descricao'];
    $valor=$_POST['valor'];
    if($valor<=0){
        $status_produto = "I";
    }
    $sql = mysqli_query($conn,"SELECT * FROM produtos WHERE descricao='$descricao'");
    if(mysqli_num_rows($sql)>0){
        $produto = mysqli_fetch_array($sql);
        $teste_id = $produto['idprodutos'];
        if($teste_id==$idproduto){
        }
        else{
            echo "<script language='javascript' type='text/javascript'>
            alert('Produto já Cadastrado!');
            window.location.href = 'produtos.php';
            </script>";
            mysqli_close($conn);
        }
    }
    $status_produto=$produto['status_produto'];
    $sql2 = "UPDATE produtos SET descricao='$descricao',valor=$valor,status_produto='$status_produto' WHERE idprodutos=$idproduto";
    if(mysqli_query($conn,$sql2)){
        echo "<script language='javascript' type='text/javascript'>
            alert('Produto Atualizado com Sucesso!');
            window.location.href = 'produtos.php';
            </script>";
    }
    else{
        echo "<script language='javascript' type='text/javascript'>
            alert('Produto não foi Atualizado com Sucesso!');
            window.location.href = 'produtos.php';
            </script>";
    }
    mysqli_close($conn);
?>