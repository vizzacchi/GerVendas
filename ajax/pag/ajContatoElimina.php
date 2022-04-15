<?php 
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

if (!empty($_GET['id'])){
    $id= $_GET['id'];
    $qsqlContato = "delete from contato_oper where id = $id";
    if (mysqli_query($conn, $qsqlContato)){
        echo "OK";
    }else{
        echo "DEU RUIM";
    }
}
?>