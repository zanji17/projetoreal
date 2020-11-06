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
        <div class="container;" style="background-image:url('img/background.jpg');">
        <nav>
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
                        <div class="p-0 mb-0">
                            <?php
                                include("conecta.php");
                            ?>
                            <div>
                                <div>
                                    <form class="form" action="produtos.php" method="post">
                                    <input class="form-control input-lg" type="text" name="procura" placeholder="digite a descrição do produto">
                                    <input type="submit" name="Procurar" value="Buscar" class="btn btn-outline-warning">
                                </div>
                            </div>
                        </div>
                </div>
        </nav>
        <section>
        <div style="width:98%">
        <div class="container float-left" style='width:65%'>
            <?php
            include("conecta.php");
            //verifica a página atual, caso seja informada na URL, senão atribui como 1º página
            $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
            //seleciona todos os registros da tabela
            if(isset($_POST['id']) or (!isset($_POST['descricao']) and !isset($_POST['valor']) and !isset($_POST['letra']) and (!isset($_POST['procura']) or $_POST['procura']==null))){
                $sql = mysqli_query($conn, "SELECT * FROM produtos ORDER BY idprodutos");
            }
            if(isset($_POST['descricao'])){
                $sql = mysqli_query($conn, "SELECT * FROM produtos ORDER BY descricao");
            }
            if(isset($_POST['valor'])){
                $sql = mysqli_query($conn, "SELECT * FROM produtos ORDER BY valor DESC");
            }
            if(isset($_POST['letra'])){
                $letra = $_POST['letra'];
                $sql = mysqli_query($conn, "SELECT * FROM produtos WHERE descricao LIKE '".$letra."%' ORDER BY descricao");
            }
            if(isset($_POST['procura'])){
                if($_POST['procura']!=null){
                $procura = $_POST['procura'];
                $sql = mysqli_query($conn, "SELECT * FROM produtos WHERE descricao LIKE '".$procura."%' ORDER BY descricao");
                }
            }
            ?>
            <p>
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                <?php
                    $letra = mysqli_query($conn, "SELECT DISTINCT LEFT(descricao, 1) AS letra from produtos ORDER BY letra");
                    while($letras = mysqli_fetch_array($letra)){
                        $inicial = strtoupper($letras['letra']);
                        echo '<button type="submit" value="'.$inicial.'" name="letra" class="btn btn-secondary"><b>'.$inicial.'</b></button>';
                    }
                ?>
                </div>
            </div>
            <div class="p-1 mb-0 text-dark" style="background-color:lightgreen">
                <label>Ordenar Por:</label>
                <button type=submit name="id" class="btn btn-secondary btn-sm">Nº do Produto</button>
                <button type=submit name="descricao" class="btn btn-secondary btn-sm">descricao</button>
                <button type=submit name="valor" class="btn btn-secondary btn-sm">Valor</button>
            </div>
            </form>
            <?php
            //conta o total de registros
            $total = mysqli_num_rows($sql);
            //seta a quantidade de registros por página
            $registros = 5;
            //calculo do número de páginas, arredondando para cimna
            $numpaginas = ceil($total / $registros);
            //calculo para início da visualização com base na página atual
            $inicial = ($registros * $pagina) - $registros;
            if(isset($_POST['id']) or (!isset($_POST['descricao']) and !isset($_POST['valor']) and !isset($_POST['letra']) and (!isset($_POST['procura']) or $_POST['procura']==null))){
                $sql = mysqli_query($conn, "SELECT * FROM produtos ORDER BY idprodutos LIMIT $inicial,$registros");
            }
            if(isset($_POST['descricao'])){
                $sql = mysqli_query($conn, "SELECT * FROM produtos ORDER BY descricao LIMIT $inicial,$registros");
            }
            if(isset($_POST['valor'])){
                $sql = mysqli_query($conn, "SELECT * FROM produtos ORDER BY valor DESC LIMIT $inicial,$registros");
            }
            if(isset($_POST['letra'])){
                $letra = $_POST['letra'];
                $sql = mysqli_query($conn, "SELECT * FROM produtos WHERE descricao LIKE '".$letra."%' ORDER BY descricao LIMIT $inicial,$registros");
            }
            if(isset($_POST['procura'])){
                if($_POST['procura']!=null){
                $procura = $_POST['procura'];
                $sql = mysqli_query($conn, "SELECT * FROM produtos WHERE descricao LIKE '".$procura."%' ORDER BY descricao LIMIT $inicial,$registros");
                }
            }
            echo "<div class='p-2 mb-0 bg-success text-light'>";
                echo "<h4 style='text-align:center; font-size:14px;'>Produtos em Estoque</h4>";
            echo "</div>";
            echo "<table class='mb-0 table table-bordered' style='text-align:center;font-size:13px;background-color:lightgray'>";
                echo "<tr>";
                    echo "<th>Nº de Registro</th>";
                    echo "<th>Descrição</th>";
                    echo "<th>Quantidade</th>";
                    echo "<th>Valor</th>";
                    echo "<th>Status</th>";
                    echo "<th colspan='2'>Ação</th>";
                    if($_SESSION['tipo']=="gerente"){
                        echo "<th>Apagar</th>"; 
                    }
                echo "</tr>";
                while($produto = mysqli_fetch_array($sql)){
                    echo "<tr>";
                        $idproduto = $produto['idprodutos'];
                        echo "<td>".$idproduto."</td>";
                        echo "<td>".$produto['descricao']."</td>";
                        echo "<td>".$produto['estoque']."</td>";
                        echo "<td>".$produto['valor']."</td>";
                        echo "<td>".$produto['status_produto']."</td>";
                        echo "<td><form action='attprodutos.php?idproduto=$idproduto' method='post' class='form-inline' style='font-size:14px;'>
                        <div class='form-group mx-sm-2 mb-1'>
                            <input type=number name=attestoque value=0 class='form-control form-control-sm' style='width:20%'>
                            <input type='submit' value='Atualizar' class='btn btn-primary btn-sm mb-0'>    
                            <button type='submit' name='status_produto' value='A' class='btn btn-warning btn-sm mb-0'>Ativar</button>
                        <button type='submit' name='status_produto' value='I' class='btn btn-warning btn-sm mb-0'>Inativar</button></td>
                        </div>
                        </form>";
                        echo "<td><a href='produtos.php?idproduto=$idproduto'><button class='btn btn-secondary btn-sm mb-1'>Editar</button></a></td>";
                        if($_SESSION['tipo']=="gerente"){
                            echo "<td><a href='apagarproduto.php?idproduto=$idproduto'><button class='btn btn-danger btn-sm mb-1' style='color:white;'>X</button></a></td>";
                        }
                    echo "</tr>";
                }   
            echo "</table>";
            echo "<div class='p-1 mb-0 bg-secondary text-light'><a href='cadproduto.php'><button class='btn btn-outline-light btn-sm'>Cadastrar Produtos</button></a></div>";
            echo "<div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>";
                echo "<div class='btn-group mr-0' role='group' aria-label='First group'>";
                //exibe a paginação
                echo "<table class='mb-4'>";
                    for($i = 1; $i <  $numpaginas + 1; $i++){
                        echo "<td><form action='produtos.php?pagina=$i' method='post'>";
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
                            if((!isset($_POST['valor']) and !isset($_POST['descricao']) and !isset($_POST['letra']) and (!isset($_POST['procura']) or $_POST['procura']==null)) or isset($_POST['id'])){
                                echo "<button type=submit name='id' class='btn btn-secondary'>$i</button>";
                            }
                        echo "</form></td>";
                     }
                echo "</table>";
                echo "</div>";
            echo "</div>"; 
        echo "</div>";
        echo "<div class='container float-right' style='width:33%'>";
            echo "<div class='box'>";
            if(isset($_GET['idproduto'])){
                $idproduto = $_GET['idproduto'];
                include("editarproduto.php");
            }
            echo "</div>";
        echo "</div>";
        mysqli_close($conn);
        ?>     
        </section>
    </div>
        <footer>
            <div style="position:fixed; left: 0; bottom: 0; width: 100%; background-color: darkgreen; color: white; text-align: center;">TDS03-SENAI 2020</div>
        </footer>
    </body>
</html>