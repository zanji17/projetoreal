<?php
    session_start();
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
    }
    if($_SESSION['tipo']=='cliente'){
        header('location:sair.php');
    }
    include("conecta.php");
    $descricao = $_POST['descricao'];
    $estoque = $_POST['estoque'];
    $status_produto = $_POST['status_produto'];
    $valor = $_POST['valor'];
    $produto = mysqli_query($conn, "SELECT * FROM produtos WHERE descricao='".$descricao."'");
    if(mysqli_num_rows($produto)>0){
        echo "<script language='javascript' type='text/javascript'>
        alert('Produto já cadastrada!');
        window.location.href = 'cadproduto.php';
        </script>";
        mysqli_close($conn);
    }
    if($valor<=0){
        $status_produto="I";
    }
    $sql = "INSERT INTO produtos(descricao,estoque,valor,status_produto) VALUES('$descricao','$estoque','$valor','$status_produto')";
    if(mysqli_query($conn, $sql)){
        echo "<script language='javascript' type='text/javascript'>
        alert('Produto cadastrado com sucesso!');
        window.location.href = 'cadproduto.php';
        </script>";
    }
    else{
        echo "<script language='javascript' type='text/javascript'>
        alert('Produto não foi cadastrado com sucesso!');
        window.location.href = 'cadproduto.php';
        </script>";
    }
    mysqli_close($conn);
?>