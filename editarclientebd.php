<?php
    session_start();
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
    }
    if($_SESSION['tipo']=='vendedor'){
        header('location:sair.php');
    }
    include("conecta.php");
    $cargo=$_SESSION['tipo'];
    $nome = $_POST['nome'];
    $status_pessoas = $_POST['status_pessoas'];
    $login = $_POST['login'];
    $senha = base64_encode($_POST['senha']);
    $idcliente=$_GET['idcliente'];
    $sql = mysqli_query($conn,"SELECT * FROM clientes WHERE idcliente=$idcliente");
    $cliente = mysqli_fetch_array($sql);
    $fkpessoa=$cliente['fk_idpessoa'];
    $sql2 = mysqli_query($conn,"SELECT * FROM usuarios WHERE fk_idpessoas=$fkpessoa");
    $usuario = mysqli_fetch_array($sql2);
    $sql3 = mysqli_query($conn, "SELECT * FROM usuarios WHERE login='".$login."' and senha='".$senha."'");
    if(mysqli_num_rows($sql3)>0){
        $teste=mysqli_fetch_array($sql3);
        $fkpessoa2=$teste['fk_idpessoas'];
        if($fkpessoa2<>$fkpessoa){
            echo "<script language='javascript' type='text/javascript'>
            alert('Perfil não atualizado com sucesso!');
            </script>";
            if($cargo=="cliente"){
                echo "<script language='javascript' type='text/javascript'>
                window.location.href = 'perfilcliente.php';
                </script>";
            }
            else{
                echo "<script language='javascript' type='text/javascript'>
                window.location.href = 'perfil.php?idpessoa=$fkpessoa';
                </script>";
            }
            mysqli_close($conn);
        }   
    }
    $sql4 = "UPDATE pessoas SET nome='$nome',status_pessoas='$status_pessoas' WHERE idpessoas=$fkpessoa";
    if(mysqli_query($conn,$sql4)){
    }
    else{
        echo "<script language='javascript' type='text/javascript'>
        alert('Perfil não atualizado com sucesso!');
        </script>";
        if($cargo=="cliente"){
            echo "<script language='javascript' type='text/javascript'>
            window.location.href = 'perfilcliente.php';
            </script>";
        }
        else{
            echo "<script language='javascript' type='text/javascript'>
            window.location.href = 'perfil.php?idpessoa=$fkpessoa';
            </script>";
        }
        mysqli_close($conn);
    }
    $renda = $_POST['renda'];
    $sql5 = "UPDATE clientes SET renda=$renda WHERE idcliente=$idcliente";
    if(mysqli_query($conn,$sql5)){
    }
    else{
        echo "<script language='javascript' type='text/javascript'>
        alert('Perfil não atualizado com sucesso!');
        </script>";
        if($cargo=="cliente"){
            echo "<script language='javascript' type='text/javascript'>
            window.location.href = 'perfilcliente.php';
            </script>";
        }
        else{
            echo "<script language='javascript' type='text/javascript'>
            window.location.href = 'perfil.php?idpessoa=$fkpessoa';
            </script>";
        }
        mysqli_close($conn);
    }
    //cadastro de dados na tabela usuarios
    $sql6 = "UPDATE usuarios SET login='$login', senha='$senha' WHERE fk_idpessoas=$fkpessoa";
    if(mysqli_query($conn,$sql6)){
        echo "<script language='javascript' type='text/javascript'>
        alert('Perfil atualizado com sucesso!');
        </script>";
        if($cargo=="cliente"){
            echo "<script language='javascript' type='text/javascript'>
            window.location.href = 'perfilcliente.php';
            </script>";
        }
        else{
            echo "<script language='javascript' type='text/javascript'>
            window.location.href = 'perfil.php?idpessoa=$fkpessoa';
            </script>";
        }
    }
    else{
        echo "<script language='javascript' type='text/javascript'>
        alert('Perfil não atualizado com sucesso!');
        </script>";
        if($cargo=="cliente"){
            echo "<script language='javascript' type='text/javascript'>
            window.location.href = 'perfilcliente.php';
            </script>";
        }
        else{
            echo "<script language='javascript' type='text/javascript'>
            window.location.href = 'perfil.php?idpessoa=$fkpessoa';
            </script>";
        }
    }
    mysqli_close($conn);
?>