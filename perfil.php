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
        <div class="container float-left" style="width:60%;">
            <?php
            include("conecta.php");
            $idpessoa=$_GET['idpessoa'];
            $sql=mysqli_query($conn, "SELECT * FROM pessoas INNER JOIN usuarios on pessoas.idpessoas=usuarios.fk_idpessoas WHERE idpessoas=$idpessoa");
            $usuario=mysqli_fetch_array($sql);
            $tipo = $usuario['tipo'];
            if($tipo=="cliente"){
                $sql2=mysqli_query($conn, "SELECT * FROM clientes WHERE fk_idpessoa=$idpessoa");    
            }
            else{
                $sql2=mysqli_query($conn, "SELECT * FROM vendedores WHERE fk_idpessoas=$idpessoa");    
            }
            $pessoa=mysqli_fetch_array($sql2);
            echo "<div class='p-2 mb-0 bg-success text-light' style='opacity:90%;'>";
                echo "<h4 style= text-align:center;font-size:14px;'>Informações de Usuário</h4>";
            echo "</div>";
            echo "<table class='mb-0 table table-bordered table-light' style='opacity:90%;text-align:center;font-size:14px;'>";
                echo "<tr>";
                    echo "<th>Nome</th>";
                    echo "<th>CPF</th>";
                    echo "<th>Status</th>";
                    echo "<th>Tipo</th>";
                    echo "<th>Valor</th>";
                    if($_SESSION['tipo']=="gerente"){
                        echo "<th>Login</th>";
                        echo "<th>Senha</th>";
                    }
                    if($tipo=="cliente"){
                        echo "<th>Ação</th>";
                    }
                echo "</tr>";
                echo "<tr>";
                    echo "<td>".$usuario['nome']."</td>";
                    echo "<td>".$usuario['cpf']."</td>";
                    echo "<td>".$usuario['status_pessoas']."</td>";
                    echo "<td>".$usuario['tipo']."</td>";
                    if($tipo=="cliente"){
                        echo "<td>Renda:".$pessoa['renda'];
                        echo "  Credito:".$pessoa['credito']."</td>";
                    }
                    else{
                        echo "<td>Salário:".$pessoa['salario']."</td>";
                    }
                    if($_SESSION['tipo']=="gerente"){
                        echo "<td>".$usuario['login']."</td>";
                        echo "<td>".base64_decode($usuario['senha'])."</td>";
                    }
                    if($tipo=="cliente"){
                        $idcliente = $pessoa['idcliente'];
                        $_SESSION['idcliente']=$idcliente;
                        echo "<td><a href='pedidosbd.php'><button type='submit' class='btn btn-success btn-sm'>Criar Pedido</button><a></td>";
                    }
                echo "</tr>";
                echo "</table>";
                if($tipo=="cliente"){
                    $idcliente=$pessoa['idcliente'];
                    echo "<div class='p-1 mb-0 bg-dark text-light' style='opacity:90%;font-size:14px;'>";
                        echo "<form action='creditos.php?idcliente=$idcliente' method='post'><input type=decimal name='credito' value=0><input type=submit value='Atualizar Crédito'></form>";
                    echo "</div>";
                }
                echo "<br/>";
                if($tipo=="cliente"){
                    $idcliente=$pessoa['idcliente'];
                    $sql3=mysqli_query($conn, "SELECT * FROM pedidos WHERE fk_idcliente=$idcliente ORDER BY data_pedido DESC");
                }
                else{
                    $idvendedor = $pessoa['idvendedor'];
                    $sql3=mysqli_query($conn, "SELECT * FROM pedidos WHERE fk_idvendedor=$idvendedor ORDER BY data_pedido DESC");
                }
                echo "<div class='p-1 mb-0 bg-primary text-light' style='opacity:90%; text-align:center'>";
                    if($tipo=="cliente"){
                        echo "<h4 style='font-size:14px;'>Histórico de Compras</h4>";
                    }
                    else{
                        echo "<h4 style='font-size:14px;'>Histórico de Vendas</h4>";
                    }
                echo "</div>";
                echo "<table class='table table-bordered table-light' style='opacity:90%;font-size:14px;text-align:center';>";
                    echo "<tr>";
                        echo "<th>NºPedido</th>";
                        echo "<th>Data do Pedido</th>";
                        echo "<th>Valor Total</th>";
                        echo "<th>idcliente</th>";
                        echo "<th>idvendedor</th>";
                        echo "<th>Situação</th>";
                        echo "<th>Ação</th>";
                    echo "</tr>"; 
                    while($pedido=mysqli_fetch_array($sql3)){
                        echo "<tr>";
                            $idpedido=$pedido['idpedidos'];
                            echo "<td>".$idpedido."</td>";
                            echo "<td>".$pedido['data_pedido']."</td>";
                            echo "<td>".$pedido['valor']."</td>";
                            echo "<td>".$pedido['fk_idcliente']."</td>";
                            echo "<td>".$pedido['fk_idvendedor']."</td>";
                            echo "<td>".$pedido['status_pedido']."</td>";
                            echo "<td><a href='detalhescompra.php?idpedido=$idpedido'><button type='submit' class='btn btn-primary btn-sm'>Detalhes da Compra</button></a></td>";
                        echo "</tr>";
                    }
                echo "</table>";
        echo "</div>";
        echo "<div class='container float-right' style='width:40%;'>";
                if($_SESSION['tipo']=="gerente"){
                    if($tipo=="cliente"){
                        $idcliente = $pessoa['idcliente'];
                        include("editarcliente.php");
                    }
                    else{
                        $idvendedor = $pessoa['idvendedor'];
                        include("editarvendedor.php");
                    }
                }
        echo "</div>";
        mysqli_close($conn);
            ?>
            <div class="p-2 mb-2">
            </div>
        </section>      
        <footer>
            <div style="position:fixed; left: 0; bottom: 0; width: 100%; background-color: #191970; color: white; text-align: center;">TDS03-SENAI 2020</div>
        </footer>
    </body>
</html>