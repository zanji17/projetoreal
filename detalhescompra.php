<?php
    session_start();
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
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
    <body>
        <header><div class="p-1 mb-0 bg-dark text-light "><div class="col-md-4 col-md-offset-4">Controle de Pedidos de Vendas 1.0</div></div></header>
        <div class="container;">
        <nav style="background-image:url('img/background.jpg');">
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
                                $cargo = $_SESSION["tipo"];
                                if($cargo=="cliente"){
                                    echo "Cliente:";
                                    echo " ";
                                    echo $_SESSION["user"];
                                    echo " ";
                                    echo "NºPedido:";
                                    echo $_SESSION["idpedidos"];
                                }
                                else{
                                    echo "Vendedor:";
                                    echo " ";
                                    echo $_SESSION["user"];
                                }
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
            <div class="container">
                <?php
                include("conecta.php");
                $idpedido=$_GET['idpedido'];
                $sql=mysqli_query($conn, "SELECT * FROM pedidos_produtos WHERE fk_pedidos_idpedidos=$idpedido");
                echo "<div>";
                    echo "<div class='p-2 mb-0 bg-success text-light' style='opacity:90%;'>";
                        echo "<h4 style='text-align:center;'>Detalhes da Compra</h4>";
                    echo "</div>";
                    echo "<table class='table table-bordered' style='opacity:90%; text-align:center;background-color: lightgray'>";
                        echo "<tr>";
                            echo "<th>Descrição</th>";
                            echo "<th>Quantidade</th>";
                            echo "<th>Valor</th>";
                        if($_SESSION['tipo']!="cliente"){
                            echo "<th>Ação</th>";
                        }
                        echo "</tr>";
                        while($pedidos_produtos=mysqli_fetch_array($sql)){
                            $fkprodutos=$pedidos_produtos['fk_produtos_idprodutos'];
                            $sql2 = mysqli_query($conn,"SELECT * FROM produtos WHERE idprodutos=$fkprodutos");
                            $produto=mysqli_fetch_array($sql2);
                            echo "<tr>";
                                $idproduto = $produto['idprodutos'];
                                echo "<td>".$produto['descricao']."</td>";
                                echo "<td>".$pedidos_produtos['qtde']."</td>";
                                echo "<td>".$pedidos_produtos['valor']."</td>";
                                if($_SESSION['tipo']!="cliente"){
                                    echo "<td><form action='desconto.php?idpedido=$idpedido' method='post' class='form-inline'>";
                                    echo "<label>%desconto</label><input type=decimal name=desconto_porcento value=0>";
                                    echo "<button type='submit' name=idproduto value='$idproduto' class='btn btn-primary btn-sm'>Dar Desconto</button></form>";
                                    echo "<form action='desconto.php?idpedido=$idpedido' method='post' class='form-inline'>";
                                    echo "<label>Valor de Desconto</label><input type=decimal name=desconto_normal value=0>";
                                    echo "<button type='submit' name=idproduto value='$idproduto' class='btn btn-primary btn-sm'>Dar Desconto</button></form></td>";
                                }
                            echo "</tr>";
                        }
                    echo "</table>";
                    echo "</div>";
                mysqli_close($conn);
                ?>
            <div class="p-2 mb-2">
            </div>      
        </section>
        <footer>
        <div style="position:fixed; left: 0; bottom: 0; width: 100%; background-color: darkgreen; color: white; text-align: center;">TDS03-SENAI 2020</div>
        </footer>
    </body>
</html>