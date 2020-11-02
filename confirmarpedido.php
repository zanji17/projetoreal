<?php
    session_start();
    include("conecta.php");
    if($_SESSION["status"] !="OK"){
        header('location:index.php');
    }
    $idcliente= $_SESSION["idcliente"];
    $idpedido= $_SESSION["idpedidos"];
    if($_GET['status_pedido']=="CA"){
        echo "<script language='javascript' type='text/javascript'>
            alert('Seu Pedido Foi Cancelado com Sucesso');
            </script>";
            $sql6="UPDATE pedidos SET status_pedido='CA' WHERE idpedidos=$idpedido";
            if($_SESSION['tipo']=="cliente"){
                echo "<script language='javascript' type='text/javascript'>
                    window.location.href = 'pedidosbd.php';
                    </script>";
            }
            else{
                unset($_SESSION['idpedidos']);
                echo "<script language='javascript' type='text/javascript'>
                    window.location.href = 'home2.php';
                    </script>";
            }
        mysqli_query($conn);
    }
    else{
        $valortotal=0;
        $sql = mysqli_query($conn, "SELECT * FROM pedidos_produtos WHERE fk_pedidos_idpedidos=$idpedido");
        while($pedidos_produtos = mysqli_fetch_array($sql)){
            $idprodutos=$pedidos_produtos['fk_produtos_idprodutos'];
            $sql2 = mysqli_query($conn,"SELECT * FROM produtos WHERE idprodutos=$idprodutos");
            $produtos = mysqli_fetch_array($sql2);
            $estoque=$produtos['estoque'];
            $qtde=$pedidos_produtos['qtde'];
            $status=$produtos['status_produto'];
            $valor = $pedidos_produtos['valor'];
            $valortotal+=$valor;
            if($estoque<$qtde or $status=="I"){
                $sql6="UPDATE pedidos SET status_pedido='CA' WHERE idpedidos=$idpedido";
                if(mysqli_query($conn,$sql6)){
                echo "<script language='javascript' type='text/javascript'>
                    alert('Não foi possível confirmar seu pedido! Devido a um dos itens ultrapassar a quantidade em estoque ou estar inativo');
                    </script>";
                    if($_SESSION['tipo']=="cliente"){
                        echo "<script language='javascript' type='text/javascript'>
                            window.location.href = 'pedidosbd.php';
                            </script>";
                    }
                    else{
                        unset($_SESSION['idpedidos']);
                        echo "<script language='javascript' type='text/javascript'>
                            window.location.href = 'home2.php';
                            </script>";
                    }
                }
                else{
                    echo "<script language='javascript' type='text/javascript'>
                        alert('Falha no cancelamento de pedido!');
                        </script>";
                    if($_SESSION['tipo']=="cliente"){
                        echo "<script language='javascript' type='text/javascript'>
                            window.location.href = 'pedidosbd.php';
                            </script>";
                    }
                    else{
                        unset($_SESSION['idpedidos']);
                        echo "<script language='javascript' type='text/javascript'>
                            window.location.href = 'home2.php';
                            </script>";
                    }
                }
                mysqli_close($conn);
            }
            $att_estoque=$estoque-$qtde;
            if($att_estoque==0){
                $sql3="UPDATE produtos SET estoque=$att_estoque,status_produto='I' WHERE idprodutos=$idprodutos";
                if(mysqli_query($conn,$sql3)){
                }
                else{
                    echo "<script language='javascript' type='text/javascript'>
                    alert('Falha na atualização de estoque!');
                    </script>";
                    if($_SESSION['tipo']=="cliente"){
                        echo "<script language='javascript' type='text/javascript'>
                            window.location.href = 'pedidosbd.php';
                            </script>";
                    }
                    else{
                        unset($_SESSION['idpedidos']);
                        echo "<script language='javascript' type='text/javascript'>
                            window.location.href = 'home2.php';
                            </script>";
                    }
                    mysqli_close($conn);
                }    
            }
            else{
                $sql4="UPDATE produtos SET estoque=$att_estoque WHERE idprodutos=$idprodutos";
                if(mysqli_query($conn,$sql4)){
                }
                else{
                    echo "<script language='javascript' type='text/javascript'>
                    alert('Falha na atualização de estoque!');
                    </script>";
                    if($_SESSION['tipo']=="cliente"){
                        echo "<script language='javascript' type='text/javascript'>
                            window.location.href = 'pedidosbd.php';
                            </script>";
                    }
                    else{
                        unset($_SESSION['idpedidos']);
                        echo "<script language='javascript' type='text/javascript'>
                            window.location.href = 'home2.php';
                            </script>";
                    }
                    mysqli_close($conn);
                }
            }
        }
        $sql5="UPDATE pedidos SET data_pedido=curdate(),status_pedido='CO',valor = $valortotal WHERE idpedidos=$idpedido";
        if(mysqli_query($conn,$sql5)){
            echo "<script language='javascript' type='text/javascript'>
            alert('Seu pedido foi confirmado!');
            </script>";
            if($_SESSION['tipo']=="cliente"){
                echo "<script language='javascript' type='text/javascript'>
                    window.location.href = 'pedidosbd.php';
                    </script>";
            }
            else{
                unset($_SESSION['idpedidos']);
                echo "<script language='javascript' type='text/javascript'>
                    window.location.href = 'home2.php';
                    </script>";
            }
        }
        else{
            echo "<script language='javascript' type='text/javascript'>
            alert('Falha na confirmação de pedido!');
            </script>";
            if($_SESSION['tipo']=="cliente"){
                echo "<script language='javascript' type='text/javascript'>
                    window.location.href = 'pedidosbd.php';
                    </script>";
            }
            else{
                unset($_SESSION['idpedidos']);
                echo "<script language='javascript' type='text/javascript'>
                    window.location.href = 'home2.php';
                    </script>";
            }
        }
        mysqli_close($conn);
    }
?>