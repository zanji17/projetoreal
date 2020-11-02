<?php
    session_start();
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
    }
    if(!isset($_SESSION['idpedidos'])){
        header('location:home2.php');
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
                            if($_SESSION['tipo']=='cliente'){
                                echo "Cliente:";
                                echo $_SESSION["user"];
                                echo " ";
                                echo "NºPedido:";
                                echo $_SESSION["idpedidos"];
                                echo " ";
                                echo "<a href='sair.php' style='color:silver'>Sair</a>";
                            }
                            else{
                                echo "Vendedor:";
                                echo $_SESSION["user"];
                                echo " ";
                                echo "idcliente:";
                                echo $_SESSION["idcliente"];
                                echo " ";
                                echo "NºPedido:";
                                echo $_SESSION["idpedidos"];
                                echo " ";
                                echo "<a href='sair.php' style='color:silver'>Sair</a>";
                            }
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
            <div>
            <?php
            include("conecta.php");
            $idpedidos=$_SESSION["idpedidos"];
            $sql = mysqli_query($conn, "SELECT * FROM pedidos_produtos WHERE fk_pedidos_idpedidos=$idpedidos");
            echo "<div class='container'>";
                    echo "<div class='p-2 mb-0 bg-primary text-light' style='opacity:90%;'>";
                        echo "<h4 style='text-align:center;'>Lista do Pedido</h4>";
                    echo "</div>";
                    echo "<table class='mb-0 table table-bordered table-light' style='opacity:90%;'>";
                        echo "<tr>";
                            echo "<th>Descricao</th>";
                            echo "<th>Quantidade</th>";
                            echo "<th>Valor</th>";
                            echo "<th>Ações</th>";
                        echo "</tr>";
                        while($itenspedidos = mysqli_fetch_array($sql)){
                            echo "<tr>";
                                $fkpedidos = $itenspedidos['fk_pedidos_idpedidos'];
                                $fkprodutos = $itenspedidos['fk_produtos_idprodutos'];
                                $sql2 = mysqli_query($conn,"SELECT * FROM produtos WHERE idprodutos=$fkprodutos");
                                $produto=mysqli_fetch_array($sql2);
                                echo "<td>".$produto['descricao']."</td>";
                                echo "<td>".$itenspedidos['qtde']."</td>";
                                echo "<td>".$itenspedidos['valor']."</td>";
                                echo "<td><a href='removerproduto.php?idprodutos=$fkprodutos'><button type='submit' class='btn btn-dark btn-sm'>Remover da Lista</button></a>";
                            echo "</tr>";
                        }
                    echo "</table>";
                mysqli_close($conn);
                ?>
                <div class="p-1 mb-0 bg-dark text-light" style="opacity:90%;">
                    <a href='confirmarpedido.php?status_pedido=CO'><button type='submit' class="btn btn-outline-success">Confirmar Pedido</button></a><a href='confirmarpedido.php?status_pedido=CA'><button type='submit' class="btn btn-outline-danger">Cancelar Pedido</button></a>
                </div>
            </div>
            <div class="p-2 mb-2">
            </div>      
        </section>
        <footer>
            <div style="position:fixed; left: 0; bottom: 0; width: 100%; background-color: #191970; color: white; text-align: center;">TDS03-SENAI 2020</div>
        </footer>
    </body>
</html>