<?php
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
    }
    if($_SESSION['tipo']=='vendedor'){
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
            <?php
                include("conecta.php");
                $sql = mysqli_query($conn, "SELECT * FROM clientes WHERE idcliente=$idcliente");
                $cliente = mysqli_fetch_array($sql);
                $fkpessoa=$cliente['fk_idpessoa'];
                $sql2 = mysqli_query($conn, "SELECT * FROM pessoas WHERE idpessoas=$fkpessoa");
                $pessoa= mysqli_fetch_array($sql2);
                $sql3 = mysqli_query($conn, "SELECT * FROM usuarios WHERE fk_idpessoas=$fkpessoa");
                $usuario = mysqli_fetch_array($sql3);
            ?>
            <div class="box rounded" style="background-color:#005000; opacity:85%; padding:30px;">
                <div style="width:400px; color:white;">
                    <h4 style="text-align:center;">Atualizar Perfil</h4>
                    <form name="editarcliente" id="editarcliente" action="editarclientebd.php?idcliente=<?php echo $cliente['idcliente']; ?>" method="post">
                    <label>Nome</label>
                    <input type="text" name="nome" placeholder="Digite seu nome" value="<?php echo $pessoa['nome']; ?>" class="form-control form-control-sm" required>
                    <br/>
                    <label>Status</label>
                    <select name="status_pessoas" class="form-control">
                        <option value="A">Ativo</option>
                        <option value="I">Inativo</option>
                    </select>
                    <br/>
                    <label>Renda</label>
                    <input type="decimal" name="renda" placeholder="Digite sua renda" value="<?php echo $cliente['renda']; ?>" class="form-control form-control-sm" required>
                    <br/>
                    <label>Login</label>
                    <input type="text" name="login" placeholder="Digite seu login" value="<?php echo $usuario['login']; ?>" class="form-control form-control-sm" required>
                    <br/>
                    <label>Senha</label>
                    <input type="password" name="senha" placeholder="Digite sua senha" value="<?php echo base64_decode($usuario['senha']); ?>" class="form-control form-control-sm" required>
                    <br/>
                    <input type="submit" value="Atualizar" class="btn btn-outline-light">
                </div>
            </div>
        </section>
    </body>
</html>