<?php
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
    </head>
    <body>
        <nav>
        </nav>
        <section>
            <?php
            include("conecta.php");
            $sql = mysqli_query($conn,"SELECT * FROM produtos WHERE idprodutos=$idproduto");
            $produto = mysqli_fetch_array($sql);
            ?>
            <div>
            <div class="box border border-primary rounded" style="background-color:orange; opacity:85%; padding:30px;">
                    <div style="width:400px; color:white;">
                        <h4 style="text-align:center; color:black">Atualizar Produto</h4>
                <form name="produto" id="cadproduto" action="editarprodutobd.php?idproduto=<?php echo $idproduto; ?>" method="post">
                    <div class="form-group row"> 
                        <label class="col-sm-2 col-form-label">Descrição</label>
                        <div class="col-sm-10">
                            <input type="text" name="descricao" placeholder="Digite as informações do produto" value="<?php echo $produto['descricao']; ?>" class="form-control form-control-sm" style="width:70%" required>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Preço</label>
                        <div class="col-sm-10">
                            <input type="decimal" name="valor" value="<?php echo $produto['valor']; ?>" class="form-control form-control-sm" style="width:70%">
                        </div>
                    </div>
                    <br/>
                    <input type="submit" value="Atualizar" class="btn btn-outline-dark">
                </form>
            </div>
        </section>
    </body>
</html>