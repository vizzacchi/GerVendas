<?php 
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

if (!empty($_GET['id'])){
    $id= $_GET['id'];
    $qsqlCorretores = "delete from corretores where id = $id";
    if (mysqli_query($conn, $qsqlCorretores)){
        echo "OK";
    }else{
        echo "DEU RUIM";
    }
}
?>