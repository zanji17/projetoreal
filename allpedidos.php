<?php
    session_start();
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
        <div>
            <?php
            include("conecta.php");
            //verifica a página atual, caso seja informada na URL, senão atribui como 1º página
            $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
            //seleciona todos os registros da tabela
            if(isset($_POST['valor_max'])){
                $sql=mysqli_query($conn, "SELECT * FROM pedidos ORDER BY valor DESC");
            }
            if(isset($_POST['data'])){
                $sql=mysqli_query($conn, "SELECT * FROM pedidos ORDER BY data_pedido DESC");
            }
            if(isset($_POST['status_pedido'])){
                $status_pedido=$_POST['status_pedido'];
                $sql=mysqli_query($conn, "SELECT * FROM pedidos WHERE status_pedido='$status_pedido'");
            }
            if((!isset($_POST['valor_max']) and !isset($_POST['data']) and !isset($_POST['status_pedido'])) or isset($_POST['id'])){
                $sql=mysqli_query($conn, "SELECT * FROM pedidos");
            }
            //conta o total de registros
            $total = mysqli_num_rows($sql);
            //seta a quantidade de registros por página
            $registros = 5;
            //calculo do número de páginas, arredondando para cimna
            $numpaginas = ceil($total / $registros);
            //calculo para início da visualização com base na página atual
            $inicial = ($registros * $pagina) - $registros;
            ?>
            <div class="container">
                <div class='p-1 mb-0 text-light' style='opacity:90%; background-color: green'>
                    <form action="allpedidos.php" method="post">
                    <label>Ordenar Por:</label>
                    <button type=submit name="id" class="btn btn-secondary btn-sm">Nº do Pedido</button>
                    <button type=submit name="valor_max" class="btn btn-secondary btn-sm">Valor</button>
                    <button type=submit name="data" class="btn btn-secondary btn-sm">Data</button>
                    <button type=submit value="CA" name="status_pedido" class="btn btn-secondary btn-sm">Apenas Cancelados</button>
                    <button type=submit value="CO" name="status_pedido" class="btn btn-secondary btn-sm">Apenas Confirmados</button>
                    <button type=submit value="EE" name="status_pedido" class="btn btn-secondary btn-sm">Apenas Em Espera</button>
                    <button type=submit value="OK" name="status_pedido" class="btn btn-secondary btn-sm">Apenas Aceitos</button>
                </div>
                </form>
                <?php
                if(isset($_POST['valor_max'])){
                    $sql=mysqli_query($conn, "SELECT * FROM pedidos ORDER BY valor DESC LIMIT $inicial,$registros");
                }
                if(isset($_POST['data'])){
                    $sql=mysqli_query($conn, "SELECT * FROM pedidos ORDER BY data_pedido DESC LIMIT $inicial,$registros");
                }
                if(isset($_POST['status_pedido'])){
                    $status_pedido=$_POST['status_pedido'];
                    $sql=mysqli_query($conn, "SELECT * FROM pedidos WHERE status_pedido='$status_pedido' LIMIT $inicial,$registros");
                }
                if((!isset($_POST['valor_max']) and !isset($_POST['data']) and !isset($_POST['status_pedido'])) or isset($_POST['id'])){
                    $sql=mysqli_query($conn, "SELECT * FROM pedidos LIMIT $inicial, $registros");
                }
                    echo "<div class='p-2 mb-0 bg-success text-light' style='opacity:90%;'>";
                        echo "<h4 style='text-align:center;'>Relatório de Pedidos</h4>";
                    echo "</div>";
                    echo "<table class='table table-bordered' style='opacity:90%;background-color: lightgray'>";
                        echo "<tr>";
                            echo "<th>NºPedido</th>";
                            echo "<th>Cliente</th>";
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
                                echo "<td>".$pedido['fk_idcliente']."</td>";
                                echo "<td>".$pedido['data_pedido']."</td>";
                                echo "<td>".$pedido['valor']."</td>";
                                echo "<td>".$pedido['status_pedido']."</td>";
                                echo "<td>".$pedido['fk_idvendedor']."</td>";
                                echo "<td><a href='detalhescompra.php?idpedido=$idpedido'><button type='submit' class='btn btn-primary btn-sm'>Ver Detalhes</button></a>  <a href='apagarpedido.php?idpedido=$idpedido'><button type='submit' class='btn btn-danger btn-sm'>Apagar Pedido</button></a></td>";
                            echo "</tr>";
                        }
                    echo "</table>";
                    echo "<div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>";
                        echo "<div class='btn-group mr-0' role='group' aria-label='First group'>";
                        //exibe a paginação
                            echo "<table>";
                                for($i = 1; $i <  $numpaginas + 1; $i++){
                                    echo "<td><form action='allpedidos.php?pagina=$i' method='post'>";
                                    if(isset($_POST['valor_max'])){
                                        echo "<button type=submit name='valor_max' class='btn btn-secondary'>$i</button>";
                                    }
                                    if(isset($_POST['data'])){
                                        echo "<button type=submit name='data' class='btn btn-secondary'>$i</button>";
                                    }
                                    if(isset($_POST['status_pedido'])){
                                        $status_pedido=$_POST['status_pedido'];
                                        echo "<button type=submit name='status_pedido' value='$status_pedido' class='btn btn-secondary'>$i</button>";
                                    }
                                    if((!isset($_POST['valor_max']) and !isset($_POST['data']) and !isset($_POST['status_pedido'])) or isset($_POST['id'])){
                                        echo "<button type=submit name='id' class='btn btn-secondary'>$i</button>";
                                    }
                                    echo "</form></td>";
                                }
                            echo "</table>";
                        echo "</div>";
                    echo "</div>";
                mysqli_close($conn);
                ?>
            </div>
            <div class="p-2 mb-2">
            </div>      
        </section>
        <footer>
            <div style="position:fixed; left: 0; bottom: 0; width: 100%; background-color: darkgreen; color: white; text-align: center;">TDS03-SENAI 2020</div>
        </footer>
    </body>
</html>