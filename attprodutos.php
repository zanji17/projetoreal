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
    $quantidade=$_POST['attestoque'];
    if($quantidade!=0){
        $sql = mysqli_query($conn,"SELECT * FROM produtos WHERE idprodutos=$idproduto");
        $produto = mysqli_fetch_array($sql);
        $estoque=$produto['estoque'];
        $novo_estoque=$estoque+$quantidade;
        if($novo_estoque<0){
            $novo_estoque=0;    
        }
        if($novo_estoque<=0){
            $sql2 = "UPDATE produtos SET estoque=$novo_estoque,status_produto='I' WHERE idprodutos=$idproduto";
            if(mysqli_query($conn,$sql2)){
                echo "<script language='javascript' type='text/javascript'>
                    alert('Estoque Atualizado com Sucesso!');
                    window.location.href = 'produtos.php';
                    </script>";
            }
            else{
                echo "<script language='javascript' type='text/javascript'>
                    alert('Estoque não foi Atualizado com Sucesso!');
                    window.location.href = 'produtos.php';
                    </script>";
            }
        }
        else{
            $sql2 = "UPDATE produtos SET estoque=$novo_estoque WHERE idprodutos=$idproduto";
            if(mysqli_query($conn,$sql2)){
                echo "<script language='javascript' type='text/javascript'>
                    alert('Estoque Atualizado com Sucesso!');
                    window.location.href = 'produtos.php';
                    </script>";
            }
            else{
                echo "<script language='javascript' type='text/javascript'>
                alert('Estoque não foi Atualizado com Sucesso!');
                window.location.href = 'produtos.php';
                </script>";
            }
        }
        mysqli_close($conn);
    }
    else{
        if(!isset($_POST['status_produto'])){
            mysqli_close($conn);
            header('location:produtos.php');
        }
        else{
            $sql = mysqli_query($conn,"SELECT * FROM produtos WHERE idprodutos=$idproduto");
            $produto = mysqli_fetch_array($sql);
            $estoque = $produto['estoque'];
            if($estoque==0){
            }
            else{
                $status_produto=$_POST['status_produto'];
                mysqli_query($conn,"UPDATE produtos SET status_produto='$status_produto' WHERE idprodutos=$idproduto");
            }
            mysqli_close($conn);
            header('location:produtos.php');
        }
    }
?>