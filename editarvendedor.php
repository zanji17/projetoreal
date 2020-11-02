<?php
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
    }
    if($_SESSION['tipo']!='gerente'){
        header('location:sair.php');
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Controle de Pedidos de Vendas</title>
        <meta charset="UTF-8"/>
    </head>
    <body>
        <nav>
        </nav>
        </nav>
        <section>
            <div>
                <?php
                include("conecta.php");
                $sql = mysqli_query($conn,"SELECT * FROM vendedores WHERE idvendedor=$idvendedor");
                $vendedor = mysqli_fetch_array($sql);
                $idpessoa = $vendedor['fk_idpessoas'];
                $sql2 = mysqli_query($conn,"SELECT * FROM pessoas INNER JOIN usuarios ON pessoas.idpessoas=usuarios.fk_idpessoas WHERE idpessoas=$idpessoa");
                $usuario = mysqli_fetch_array($sql2);
                ?>
                <div class="box rounded" style="background-color:black; opacity:85%; padding:30px;">
                <div style="width:400px; color:white;">
                    <h4 style="text-align:center;">Atualizar Perfil</h4>
                <form name="usuario" id="cadvendedor" action="editarvendedorbd.php?idvendedor=<?php echo $idvendedor;?>" method="post">
                <label>Nome</label>
                <input type="text" name="nome" placeholder="Digite o nome do vendedor" value="<?php echo $usuario['nome']; ?>" class="form-control form-control-sm" required>
                <br/>
                <label>Status</label>
                <select name="status_pessoas" class="form-control form-control-sm">
                    <option value="A">Ativo</option>
                    <option value="I">Inativo</option>
                </select>
                <br/>
                <label>Salário</label>
                <input type="decimal" name="salario" placeholder="Informe o salário do vendedor" value="<?php echo $vendedor['salario']; ?>"class="form-control form-control-sm" required>
                <br/>
                <label>Login</label>
                <input type="text" name="login" placeholder="Digite seu login" value="<?php echo $usuario['login']; ?>" class="form-control form-control-sm" required>
                <br/>
                <label>Senha</label>
                <input type="password" name="senha" placeholder="Digite sua senha" value="<?php echo base64_decode($usuario['senha']); ?>" class="form-control form-control-sm" required>
                <br/>
                <label>Tipo</label>
                <select name="cargo" class="form-control form-control-sm">
                    <option value="gerente">Gerente</option>
                    <option value="vendedor">Vendedor</option>
                </select>
                <br/>
                <input type="submit" value="Atualizar" class="btn btn-outline-success">
            </div>
        </section>
    </body>
</html>