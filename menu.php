<?php
    $tipo =  $_SESSION["tipo"];
    if($tipo === "gerente"){
        echo "<ul class='nav nav-pills'>";
            echo "<li role='presentation'><a href='home2.php' class='btn btn-outline-light btn-sm'>HOME</a></li>";
            echo "<li role='presentation'><a href='produtos.php' class='btn btn-outline-light btn-sm'>PRODUTOS</a></li>";
            echo "<li role='presentation'><a href='usuarios.php' class='btn btn-outline-light btn-sm'>USUÁRIOS</a></li>";
            echo "<li role='presentation'><a href='allpedidos.php' class='btn btn-outline-light btn-sm'>RELATÓRIO DE PEDIDOS</a></li>";
            echo "<li role='presentation'><a href='home.php' class='btn btn-outline-light btn-sm'>HOME CLIENTE</a></li>";
            echo "<li role='presentation'><a href='escolhidos.php' class='btn btn-outline-light btn-sm'>ESCOLHIDOS</a></li>";
        echo "</ul>";
    }
    if($tipo === "vendedor"){
        echo "<ul class='nav nav-pills'>";
            echo "<li role='presentation'><a href='home2.php' class='btn btn-outline-light btn-sm'>HOME</a></li>";
            echo "<li role='presentation'><a href='produtos.php' class='btn btn-outline-light btn-sm'>PRODUTOS</a></li>";
            echo "<li role='presentation'><a href='usuarios.php' class='btn btn-outline-light btn-sm'>USUÁRIOS</a></li>";
            echo "<li role='presentation'><a href='home.php' class='btn btn-outline-light btn-sm'>HOME CLIENTE</a></li>";
            echo "<li role='presentation'><a href='escolhidos.php' class='btn btn-outline-light btn-sm'>ESCOLHIDOS</a></li>";
        echo "</ul>";
    }
    if($tipo === "cliente"){
        echo "<ul class='nav nav-pills'>";
            echo "<li role='presentation'><a href='home.php' class='btn btn-outline-light btn-sm'>HOME</a></li>";
            echo "<li role='presentation'><a href='escolhidos.php' class='btn btn-outline-light btn-sm'>ESCOLHIDOS</a></li>";
            echo "<li role='presentation'><a href='perfilcliente.php' class='btn btn-outline-light btn-sm'>PERFIL</a></li>";
        echo "</ul>";
    }
?>