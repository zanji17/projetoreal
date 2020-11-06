<?php
    session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Controle de Pedidos de Vendas</title>
        <meta charset="UTF-8"/>
        <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <header><div class="p-1 mb-0 bg-dark text-light "><div class="col-md-4 col-md-offset-4">Controle de Pedidos de Vendas 1.0</div></div></header>
        <div class="container;">
        <nav style="background-image:url('img/background.jpg');">
                <div class="p-4 mb-0" style="background-color:seagreen;color:black; opacity:0.75">
                        <div class="box float-left" style="width:50%;">
                            <div class="form-group"> 
                            <h2><img src="img/logo.jpg" width=15% height=15%>
                            Loja Improvisada</h2>
                            </div>
                        </div>
                        <div class="float-right" style="color:white;">
                        <?php
                            if(isset($_SESSION['tipo'])){
                                echo "<div class='float-right'>";
                                    echo "Vendedor:";
                                    echo " ";
                                    echo $_SESSION["user"];
                                    echo " ";
                                    echo "<a href='sair.php' style='color:silver'>Sair</a>";
                                echo "</div>";
                                echo "<br/>";
                                include("menu.php");
                                }
                        ?>
                        </div>
                        <div class="p-4 mb-4">
                        </div>
                </div>
        </nav>
        </div>
        <section>
            <div class="counteiner" style="width: 100vw; height: 100vh; display: flex; flex-direction: row; justify-content: center; align-items: center;">
                <div class="box rounded" style="background-color:#005000; opacity:85%; padding:30px;">
                    <div style="width:400px; color:white;">
                        <h4 style="text-align:center;">Cadastro de Cliente</h4>
                        <form name="usuario" id="cadcliente" action="cadastracliente.php" method="post">
                            <label>Nome</label>
                            <input type="text" name="nome" placeholder="Digite seu nome" class="form-control form-control-sm" required>
                            <br/>
                            <label>CPF</label>
                            <input type="number" name="cpf" placeholder="Digite seu CPF" class="form-control form-control-sm" required>
                            <br/>
                            <label>Status</label>
                            <select name="status_pessoas" class="form-control form-control-sm">
                                <option value="A">Ativo</option>
                                <option value="I">Inativo</option>
                            </select>
                            <br/>
                            <label>Renda</label>
                            <input type="decimal" name="renda" placeholder="Digite sua renda" class="form-control form-control-sm" required>
                            <br/>
                            <label>Login</label>
                            <input type="text" name="login" placeholder="Digite seu login" class="form-control form-control-sm" required>
                            <br/>
                            <label>Senha</label>
                            <input type="password" name="senha" placeholder="Digite sua senha" class="form-control form-control-sm" required>
                            <br/>
                            <input type="submit" value="Cadastrar" class="btn btn-outline-light">
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <div class="p-2 mb-2">    
        </div>
        <footer>
            <div style="position:fixed; left: 0; bottom: 0; width: 100%; background-color: darkgreen; color: white; text-align: center;">TDS03-SENAI 2020</div>
        </footer>
    </body
</html>