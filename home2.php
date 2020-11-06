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
    <body>
        <header><div class="p-1 mb-0 bg-dark text-light "><div class="col-md-4 col-md-offset-4">Controle de Pedidos de Vendas 1.0</div></div></header>
        <div class="container;">
        <nav style="background-image:url('img/background.jpg');">
                <div class="p-4 mb-2" style="background-color:seagreen;color:black; opacity:0.75">
                        <div class="box float-left" style="width:50%;">
                            <div class="form-group"> 
                            <h2><img src="img/logo.jpg" width=15% height=15%>
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
                        <div class="p-4 mb-4">
                        </div>
                </div>
        </nav>
        <section>
        <div class="container float-left" style="width:48%">
            <?php
            include("conecta.php");
                echo "<div>";
            $sql=mysqli_query($conn, "SELECT * FROM pedidos WHERE fk_idvendedor is null and status_pedido='CO' ORDER BY data_pedido ASC");
                    echo "<div class='p-2 mb-0 bg-success text-light' style='opacity:90%;'>";
                        echo "<h4 style='text-align:center;font-size:14px;'>Pedidos Disponíveis</h4>";
                    echo "</div>";
                    echo "<table class='table table-bordered' style='opacity:90%; text-align:center; font-size:13px;background-color: lightgray'>";
                        echo "<tr>";
                            echo "<th>NºPedido</th>";
                            echo "<th>Data do Pedido</th>";
                            echo "<th>Valor Total</th>";
                            echo "<th>Situação</th>";
                            echo "<th>Vendedor</th>";
                            echo "<th>Ação</th>";
                        echo "</tr>";
                        while($pedido=mysqli_fetch_array($sql)){
                            echo "<tr>";
                                $idpedido=$pedido['idpedidos'];
                                echo "<td>".$idpedido."</td>";
                                echo "<td>".$pedido['data_pedido']."</td>";
                                echo "<td>".$pedido['valor']."</td>";
                                echo "<td>".$pedido['status_pedido']."</td>";
                                echo "<td>".$pedido['fk_idvendedor']."</td>";
                                echo "<td><a href='vendedorpedido.php?idpedido=$idpedido'><button type='submit' class='btn btn-primary btn-sm'>Aceitar Pedido</button></a></td>";
                            echo "</tr>";
                        }
                    echo "</table>";
                echo "</div>";
        echo "</div>";
        echo "<div class='container float-right' style='width:48%'>";
            $idvendedor = $_SESSION["idvendedor"];
            $sql2 = mysqli_query($conn, "SELECT * FROM pedidos WHERE fk_idvendedor=$idvendedor and data_pedido=curdate()");
            echo "<div class='p-2 mb-0 bg-success text-light' style='opacity:90%;'>";
                echo "<h4 style='text-align:center;font-size:14px;'>Pedidos Aceitos</h4>";
            echo "</div>";
            echo "<table class='table table-bordered' style='opacity:90%; text-align:center;font-size:13px;background-color: lightgray'>";
                echo "<tr>";
                    echo "<th>NºPedido</th>";
                    echo "<th>Data do Pedido</th>";
                    echo "<th>Valor Total</th>";
                    echo "<th>Situação</th>";
                    echo "<th>Vendedor</th>";
                    echo "<th>Ação</th>";
                echo "</tr>";
                while($pedido2=mysqli_fetch_array($sql2)){
                    echo "<tr>";
                        $idpedido2=$pedido2['idpedidos'];
                        echo "<td>".$idpedido2."</td>";
                        echo "<td>".$pedido2['data_pedido']."</td>";
                        echo "<td>".$pedido2['valor']."</td>";
                        echo "<td>".$pedido2['status_pedido']."</td>";
                        echo "<td>".$pedido2['fk_idvendedor']."</td>";
                        echo "<td><a href='detalhescompra.php?idpedido=$idpedido2'><button type='submit' class='btn btn-primary btn-sm'>Ver Pedido</button></a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            echo "</div>";
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