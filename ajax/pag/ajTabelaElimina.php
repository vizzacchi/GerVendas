<?php 
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

if (!empty($_GET['id'])){
    $id= $_GET['id'];
    $qsqlTabela = "delete from tabela_planos where id = $id";
    if (mysqli_query($conn, $qsqlTabela)){
        echo "OK";
    }else{
        echo "DEU RUIM";
    }
}
?>