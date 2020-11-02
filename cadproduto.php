<?php
    session_start();
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
    }
    if($_SESSION['tipo']=='cliente'){
        header('location:sair.php');
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Controle de Pedidos de Vendas</title>
        <meta charset="UTF-8"/>
        <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body style="background-image:url('img/background.jpg');">
        <header><div class="p-1 mb-0 bg-dark text-light "><div class="col-md-4 col-md-offset-4">Controle de Pedidos de Vendas 1.0</div></div></header>
        <div class="container;">
        <nav>
                <div class="p-4 mb-2" style="background-color:seagreen;color:black; opacity:0.75">
                        <div class="box float-left" style="width:50%;">
                            <div class="form-group"> 
                            <h2><img src="img/logo.jpg" width=8% height=8%>
                            Loja Improvisada</h2>
                            </div>
                        </div>
                        <div class="float-right" style="color:white;">
                        <?php
                            echo "<div class='float-right'>";
                                echo "Vendedor:";
                                echo " ";
                                echo $_SESSION["user"];
                                echo " ";
                                echo "<a href='sair.php' style='color:silver'>Sair</a>";
                            echo "</div>";
                            echo "<br/>";
                            include("menu.php");
                        ?>
                        </div>
                        <div class="p-4 mb-2">
                        </div>
                </div>
        </nav>
        <section>
            <div class="counteiner" style="width: 100vw,100px; height: 100vh; display: flex; flex-direction: row; justify-content: center; align-items: center;">
                <div class="box border border-primary rounded" style="background-color:orange; opacity:85%; padding:30px;">
                    <div style="width:400px; color:white;">
                        <h4 style="text-align:center; color:black">Cadastro de Produto</h4>
                        <form name="produto" id="cadproduto" action="cadastraproduto.php" method="post">
                            <div class="form-group row"> 
                                <label class="col-sm-2 col-form-label">Descrição</label>
                                <div class="col-sm-10">
                                    <input type="text" name="descricao" placeholder="Digite as informações do produto" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Estoque</label>
                                <div class="col-sm-10">
                                    <input type="number" name="estoque" value=0 class="form-control form-control-sm">
                                </div>
                            </div>
                            <br/>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="status_produto" class="form-control form-control-sm">
                                        <option value="A">Ativo</option>
                                        <option value="I">Inativo</option>
                                    </select>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Preço</label>
                                <div class="col-sm-10">
                                    <input type="decimal" name="valor" value=0  class="form-control form-control-sm">
                                </div>
                            </div>
                            <br/>
                            <input type="submit" value="Cadastrar" class="btn btn-outline-dark">
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <div class="p-2 mb-2">    
        </div>
        <footer>
            <div style="position:fixed; left: 0; bottom: 0; width: 100%; background-color: #191970; color: white; text-align: center;">TDS03-SENAI 2020</div>
        </footer>
    </body>
</html>