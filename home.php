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
                        <div class="p-0 mb-0">
                        <?php
                            include("conecta.php");
                        ?>
                        <div>
                            <div>
                                <form class="form" action="home.php" method="post">
                                <input class="form-control input-lg" type="text" name="procura" placeholder="digite a descrição do produto">
                                <input type="submit" name="Procurar" value="Buscar" class="btn btn-outline-warning">
                            </div>
                        </div>
                    </div>
                </div>
        </nav>
        <section>
           <div class="container">
           <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
               <div class="btn-group mr-2" role="group" aria-label="First group">
                   <?php
                       $letra = mysqli_query($conn, "SELECT DISTINCT LEFT(descricao, 1) AS letra from produtos ORDER BY letra");
                       while($letras = mysqli_fetch_array($letra)){
                           $inicial = strtoupper($letras['letra']);
                           echo '<button type="submit" value="'.$inicial.'" name="letra" class="btn btn-dark"><b>'.$inicial.'</b></button>';
                       }
                   ?>
               </div>
           </div>
               <div class='p-1 mb-0 bg-secondary text-light'>
                   <label>Ordenar Por:</label>
                   <button type=submit name="descricao" class="btn btn-dark btn-sm">Descrição</button>
                   <button type=submit name="valor" class="btn btn-dark btn-sm">Valor</button>
               </div>
               </form>
           <?php
               //verifica a página atual, caso seja informada na URL, senão atribui como 1º página
               $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
               //seleciona todos os registros da tabela
               if(!isset($_POST['descricao']) and !isset($_POST['valor']) and !isset($_POST['letra']) and (!isset($_POST['procura']) or $_POST['procura']==null)){
                   $sql = mysqli_query($conn, "SELECT * FROM produtos WHERE status_produto='A' ORDER BY idprodutos");
               }
               if(isset($_POST['descricao'])){
                   $sql = mysqli_query($conn, "SELECT * FROM produtos WHERE status_produto='A' ORDER BY descricao");
               }
               if(isset($_POST['valor'])){
                   $sql = mysqli_query($conn, "SELECT * FROM produtos WHERE status_produto='A' ORDER BY valor DESC");
               }
               if(isset($_POST['letra'])){
                   $letra = $_POST['letra'];
                   $sql = mysqli_query($conn, "SELECT * FROM produtos WHERE status_produto='A' and descricao LIKE '".$letra."%' ORDER BY descricao");
               }
               if(isset($_POST['procura'])){
                   if($_POST['procura']!=null){
                       $procura = $_POST['procura'];
                       $sql = mysqli_query($conn, "SELECT * FROM produtos WHERE status_produto='A' and descricao LIKE '".$procura."%' ORDER BY descricao");
                   }
               }
               //conta o total de registros
               $total = mysqli_num_rows($sql);
               //seta a quantidade de registros por página
               $registros = 5;
               //calculo do número de páginas, arredondando para cimna
               $numpaginas = ceil($total / $registros);
               //calculo para início da visualização com base na página atual
               $inicial = ($registros * $pagina) - $registros;
               if(!isset($_POST['descricao']) and !isset($_POST['valor']) and !isset($_POST['letra']) and (!isset($_POST['procura']) or $_POST['procura']==null)){
                   $sql = mysqli_query($conn, "SELECT * FROM produtos WHERE status_produto='A' ORDER BY idprodutos LIMIT $inicial,$registros");
               }
               if(isset($_POST['descricao'])){
                   $sql = mysqli_query($conn, "SELECT * FROM produtos WHERE status_produto='A' ORDER BY descricao LIMIT $inicial,$registros");
               }
               if(isset($_POST['valor'])){
                   $sql = mysqli_query($conn, "SELECT * FROM produtos WHERE status_produto='A' ORDER BY valor DESC LIMIT $inicial,$registros");
               }
               if(isset($_POST['letra'])){
                   $letra = $_POST['letra'];
                   $sql = mysqli_query($conn, "SELECT * FROM produtos WHERE status_produto='A' and descricao LIKE '".$letra."%' ORDER BY descricao LIMIT $inicial,$registros");
               }
               if(isset($_POST['procura'])){
                   if($_POST['procura']!=null){
                       $procura = $_POST['procura'];
                       $sql = mysqli_query($conn, "SELECT * FROM produtos WHERE status_produto='A' and descricao LIKE '".$procura."%' ORDER BY descricao LIMIT $inicial,$registros");
                   }
               }
               echo "<div>";
                   echo "<div class='p-2 mb-0 bg-dark text-light'>";
                       echo "<h4 style='text-align:center;'>Produtos à venda</h4>";
                   echo "</div>";
                   echo "<table class='table table-striped table-dark' style='text-align:center;'>";
                        echo "<tr>";
                            echo "<th>Descrição</th>";
                            echo "<th>Quantidade</th>";
                            echo "<th>Valor</th>";
                            echo "<th>Ações</th>";
                        echo "</tr>";
                        while($produto = mysqli_fetch_array($sql)){
                            echo "<tr>";
                                $idproduto = $produto['idprodutos'];
                                echo "<td>".$produto['descricao']."</td>";
                                echo "<td>".$produto['estoque']."</td>";
                                echo "<td>".$produto['valor']."</td>";
                                echo "<td><form name=idpedido id=idpedido action='addproduto.php?idprodutos=$idproduto' method='post' class='form-inline'>
                                <div class='form-group mx-sm-2 mb-1'>
                                <input type=number name='qtde' placeholder=0 value=0 class='form-control form-control-sm'>
                                </div>
                                <input type='submit' value='Adicionar ao Pedido' class='btn btn-light btn-sm mb-1'></td></form>";
                            echo "</tr>";
                        }
                    echo "</table>";
                    echo "<div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>";
                        echo "<div class='btn-group mr-0' role='group' aria-label='First group'>";
                        //exibe a paginação
                        echo "<table>";
                            for($i = 1; $i <  $numpaginas + 1; $i++){
                                echo "<td><form action='index.php?pagina=$i' method='post'>";
                                    if(isset($_POST['valor'])){
                                        echo "<button type=submit name='valor' class='btn btn-dark'>$i</button>";
                                    }
                                    if(isset($_POST['descricao'])){
                                        echo "<button type=submit name='descricao' class='btn btn-dark'>$i</button>";
                                    }
                                    if(isset($_POST['letra'])){
                                        $letra=$_POST['letra'];
                                        echo "<button type=submit name='letra' value=$letra class='btn btn-dark'>$i</button>";
                                    }
                                    if(isset($_POST['procura'])){
                                        if($_POST['procura']!=null){
                                            $procura=$_POST['procura'];
                                            echo "<button type=submit name='procura' value='$procura' class='btn btn-dark'>$i</button>";
                                        }
                                    }
                                    if(!isset($_POST['valor']) and !isset($_POST['descricao']) and !isset($_POST['letra']) and (!isset($_POST['procura']) or $_POST['procura']==null)){
                                        echo "<button type=submit class='btn btn-secondary'>$i</button>";
                                    }
                                echo "</form></td>";
                            }
                        echo "</table>"; 
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            mysqli_close($conn);
            ?>
            </div>
            <div class="p-2 mb-2">
            </div>      
        </section>
        <footer>
        <div style="position:fixed; left: 0; bottom: 0; width: 100%; background-color: #191970; color: white; text-align: center;">TDS03-SENAI 2020</div>
        </footer>
    </body>
</html>