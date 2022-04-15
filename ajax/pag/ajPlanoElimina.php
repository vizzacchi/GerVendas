<?php 
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

if (!empty($_GET['id'])){
    $id= $_GET['id'];
    $qsqlPlano = "delete from planos where id = $id";
    if (mysqli_query($conn, $qsqlPlano)){
        $qsqlTabela = "delete from tabela_planos where plano = $id";
        if (mysqli_query($conn, $qsqlTabela)){
            echo "OK";
        }
    }else{
        echo "DEU RUIM";
    }
}
?>