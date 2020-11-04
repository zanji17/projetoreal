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
                        <div class="p-0 mb-0">
                            <?php
                                include("conecta.php");
                            ?>
                            <div>
                                <div>
                                    <form class="form" action="usuarios.php" method="post">
                                    <input class="form-control input-lg" type="text" name="procura" placeholder="Digite letra, nome ou CPF">
                                    <input type="submit" name="Procurar" value="Buscar" class="btn btn-outline-warning">
                                </div>
                            </div>
                        </div>
                </div>
        </nav>
        <section>
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <?php
                    $letra = mysqli_query($conn, "SELECT DISTINCT LEFT(nome, 1) AS letra from pessoas ORDER BY letra");
                    while($letras = mysqli_fetch_array($letra)){
                        $inicial = strtoupper($letras['letra']);
                        echo '<button type="submit" value="'.$inicial.'" name="letra" class="btn btn-secondary"><b>'.$inicial.'</b></button>';
                    }
                    ?>
                </div>
            </div>
            <div class="p-1 mb-0 text-dark" style="background-color:lightgreen">
                <label>Ordenar Por:</label>
                <button type=submit name="id" class='btn btn-secondary btn-sm'>Nº de Registro</button>
                <button type=submit name="nome" class='btn btn-secondary btn-sm'>Nome</button>
                <button type=submit name="cpf" class='btn btn-secondary btn-sm'>CPF</button>
                <button type=submit name="status_pessoas" value="A" class='btn btn-secondary btn-sm'>Apenas Ativos</button>
                <button type=submit name="status_pessoas" value="I" class='btn btn-secondary btn-sm'>Apenas Inativos</button>
            </div>
            </form>
            <?php
            //verifica a página atual, caso seja informada na URL, senão atribui como 1º página
            $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
            //seleciona todos os registros da tabela
            if(isset($_POST['id']) or (!isset($_POST['nome']) and !isset($_POST['cpf']) and !isset($_POST['status_pessoas']) and !isset($_POST['letra']) and (!isset($_POST['procura']) or $_POST['procura']==null))){
                $sql=mysqli_query($conn,"SELECT * FROM pessoas INNER JOIN usuarios ON pessoas.idpessoas=usuarios.fk_idpessoas ORDER BY nome");
            }
            if(isset($_POST['nome'])){
                $sql=mysqli_query($conn,"SELECT * FROM pessoas INNER JOIN usuarios ON pessoas.idpessoas=usuarios.fk_idpessoas ORDER BY idpessoas");
            }
            if(isset($_POST['cpf'])){
                $sql=mysqli_query($conn,"SELECT * FROM pessoas INNER JOIN usuarios ON pessoas.idpessoas=usuarios.fk_idpessoas ORDER BY cpf");
            }
            if(isset($_POST['status_pessoas'])){
                $status_pessoas=$_POST['status_pessoas'];
                $sql=mysqli_query($conn,"SELECT * FROM pessoas INNER JOIN usuarios ON pessoas.idpessoas=usuarios.fk_idpessoas WHERE status_pessoas='$status_pessoas' ORDER BY nome");
            }
            if(isset($_POST['letra'])){
                $letra = $_POST['letra'];
                $sql=mysqli_query($conn,"SELECT * FROM pessoas INNER JOIN usuarios ON pessoas.idpessoas=usuarios.fk_idpessoas WHERE nome LIKE '".$letra."%' ORDER BY nome");
            }
            if(isset($_POST['procura'])){
                if($_POST['procura']!=null){
                    $procura = $_POST['procura'];
                    $sql=mysqli_query($conn,"SELECT * FROM pessoas INNER JOIN usuarios ON pessoas.idpessoas=usuarios.fk_idpessoas WHERE nome LIKE '".$procura."%' or cpf LIKE '".$procura."%' ORDER BY nome");
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
            if(isset($_POST['id']) or (!isset($_POST['nome']) and !isset($_POST['cpf']) and !isset($_POST['status_pessoas']) and !isset($_POST['letra']) and (!isset($_POST['procura']) or $_POST['procura']==null))){
                $sql=mysqli_query($conn,"SELECT * FROM pessoas INNER JOIN usuarios ON pessoas.idpessoas=usuarios.fk_idpessoas ORDER BY nome LIMIT $inicial,$registros");
            }
            if(isset($_POST['nome'])){
                $sql=mysqli_query($conn,"SELECT * FROM pessoas INNER JOIN usuarios ON pessoas.idpessoas=usuarios.fk_idpessoas ORDER BY idpessoas LIMIT $inicial,$registros");
            }
            if(isset($_POST['cpf'])){
                $sql=mysqli_query($conn,"SELECT * FROM pessoas INNER JOIN usuarios ON pessoas.idpessoas=usuarios.fk_idpessoas ORDER BY cpf LIMIT $inicial,$registros");
            }
            if(isset($_POST['status_pessoas'])){
                $status_pessoas=$_POST['status_pessoas'];
                $sql=mysqli_query($conn,"SELECT * FROM pessoas INNER JOIN usuarios ON pessoas.idpessoas=usuarios.fk_idpessoas WHERE status_pessoas='$status_pessoas' ORDER BY nome LIMIT $inicial,$registros");
            }
            if(isset($_POST['letra'])){
                $letra = $_POST['letra'];
                $sql=mysqli_query($conn,"SELECT * FROM pessoas INNER JOIN usuarios ON pessoas.idpessoas=usuarios.fk_idpessoas WHERE nome LIKE '".$letra."%' ORDER BY nome LIMIT $inicial,$registros");
            }
            if(isset($_POST['procura'])){
                if($_POST['procura']!=null){
                    $procura = $_POST['procura'];
                    $sql=mysqli_query($conn,"SELECT * FROM pessoas INNER JOIN usuarios ON pessoas.idpessoas=usuarios.fk_idpessoas WHERE nome LIKE '".$procura."%' or cpf LIKE '".$procura."%' ORDER BY nome LIMIT $inicial,$registros");
                }
            }
            echo "<div class='p-2 mb-0 bg-success text-light' style='opacity:90%;'>";
                echo "<h4 style='text-align:center;'>Registro de Usuários</h4>";
            echo "</div>";
            echo "<table class='mb-0 table table-bordered' style='opacity:90%;background-color:lightgray'>";
            echo "<tr>";
                echo "<th>NºRegistro</th>";
                echo "<th>Nome</th>";
                echo "<th>CPF</th>";
                echo "<th>Situação</th>";
                echo "<th>Tipo</th>";
                echo "<th>Ação</th>";
            echo "</tr>";
            while($pessoa=mysqli_fetch_array($sql)){
                echo "<tr>";
                    $idpessoa=$pessoa['idpessoas'];
                    echo "<td>".$idpessoa."</td>";
                    echo "<td>".$pessoa['nome']."</td>";
                    echo "<td>".$pessoa['cpf']."</td>";
                    echo "<td>".$pessoa['status_pessoas']."</td>";
                    echo "<td>".$pessoa['tipo']."</td>";
                    echo "<td><a href='perfil.php?idpessoa=$idpessoa'><button type='submit' class='btn btn-dark btn-sm'>Ver Detalhes</button></a>";
                    if($_SESSION['tipo']=='gerente'){
                        echo "  <a href='apagarusuarios.php?idpessoa=$idpessoa'><button type='submit' class='btn btn-dark btn-sm'>Apagar</button></a>";
                    }
                    "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<div class='p-1 mb-0 bg-dark text-light'>";
            if($_SESSION['tipo']=="gerente"){
                echo "<a href='cadvendedor.php'><button type='submit' class='btn btn-outline-light'>Cadastrar Vendedor</button></a>";
            }
                echo "<a href='cadcliente.php'><button type='submit' class='btn btn-outline-light'>Cadastrar Cliente</button></a>";
            echo "</div>";
            echo "<div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>";
                echo "<div class='btn-group mr-0' role='group' aria-label='First group'>";
                    //exibe a paginação
                    echo "<table>";
                        for($i = 1; $i <  $numpaginas + 1; $i++){
                            echo "<td><form action='usuarios.php?pagina=$i' method='post'>";
                                if(isset($_POST['nome'])){
                                    echo "<button type=submit name='nome' class='btn btn-secondary'>$i</button>";
                                }
                                if(isset($_POST['cpf'])){
                                    echo "<button type=submit name='cpf' class='btn btn-secondary'>$i</button>";
                                }
                                if(isset($_POST['letra'])){
                                    $letra=$_POST['letra'];
                                    echo "<button type=submit name='letra' value=$letra class='btn btn-secondary'>$i</button>";
                                }
                                if(isset($_POST['procura'])){
                                    if($_POST['procura']!=null){
                                        $procura=$_POST['procura'];
                                        echo "<button type=submit name='procura' value='$procura' class='btn btn-secondary'>$i</button>";
                                    }
                                }
                                if(isset($_POST['status_pessoas'])){
                                    $status_pedido=$_POST['status_pessoas'];
                                    echo "<button type=submit name='status_pedido' value='$status_pedido' class='btn btn-secondary'>$i</button>";
                                }
                                if((!isset($_POST['nome']) and !isset($_POST['cpf']) and !isset($_POST['status_pessoas']) and !isset($_POST['letra']) and (!isset($_POST['procura']) or $_POST['procura']==null)) or isset($_POST['id'])){
                                    echo "<button type=submit name='id' class='btn btn-secondary'>$i</button>";
                                }
                            echo "</form></td>";
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