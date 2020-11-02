<?php
    session_start();
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
    }
    if($_SESSION['tipo']!='gerente'){
        header('location:sair.php');
    }
    include("conecta.php");
    $idvendedor = $_GET['idvendedor'];
    $sql = mysqli_query($conn,"SELECT * FROM vendedores WHERE idvendedor=$idvendedor");
    $vendedor = mysqli_fetch_array($sql);
    $idpessoa = $vendedor['fk_idpessoas'];
    $sql2 = mysqli_query($conn,"SELECT * FROM pessoas INNER JOIN usuarios ON pessoas.idpessoas=usuarios.fk_idpessoas WHERE idpessoas=$idpessoa");
    $usuario = mysqli_fetch_array($sql2);
    $nome = $_POST['nome'];
    $status_pessoas = $_POST['status_pessoas'];
    $login = $_POST['login'];
    $senha = base64_encode($_POST['senha']);
    $tipo = $_POST['cargo'];
    $sql3 = mysqli_query($conn, "SELECT * FROM usuarios WHERE login='".$login."' and senha='".$senha."'");
    if(mysqli_num_rows($sql3)>0){
        $teste = mysqli_fetch_array($sql3);
        $teste_idpessoa = $teste['fk_idpessoas'];
        if($teste_idpessoa==$idpessoa){
        }
        else{
            echo "<script language='javascript' type='text/javascript'>
            alert('Usuário já cadastrada!');
            window.location.href = 'perfil.php?idpessoa=$idpessoa';
            </script>";
            mysqli_close($conn);
        }
    }
    //cadastro de dados na tabela pessoas
    $sql4 = "UPDATE pessoas SET nome='$nome',status_pessoas='$status_pessoas' WHERE idpessoas=$idpessoa";
    if(mysqli_query($conn, $sql4)){
    }
    else{
        echo "<script language='javascript' type='text/javascript'>
        alert('Usuário não foi Atualizado com sucesso!');
        window.location.href = 'perfil.php?idpessoa=$idpessoa';
        </script>";
    }
    //cadastro de dados na tabela vendedor
    $salario = $_POST['salario'];
    $sql5 = "UPDATE vendedores SET salario=$salario WHERE fk_idpessoas=$idpessoa";
    if(mysqli_query($conn, $sql5)){
    }
    else{
        echo "<script language='javascript' type='text/javascript'>
        alert('Usuário não foi Atualizado com sucesso!');
        window.location.href = 'perfil.php?idpessoa=$idpessoa';
        </script>";
    }
    //cadastro de dados na tabela usuarios
    $sql6 = "UPDATE usuarios SET login='$login',senha='$senha',tipo='$tipo' WHERE fk_idpessoas=$idpessoa";
    if(mysqli_query($conn, $sql6)){
        echo "<script language='javascript' type='text/javascript'>
        alert('Usuário Atualizado com sucesso!');
        window.location.href = 'perfil.php?idpessoa=$idpessoa';
        </script>";
    }
    else{
        echo "<script language='javascript' type='text/javascript'>
        alert('Usuário não foi Atualizado com sucesso!');
        window.location.href = 'perfil.php?idpessoa=$idpessoa';
        </script>";
    }
    mysqli_close($conn);
?>