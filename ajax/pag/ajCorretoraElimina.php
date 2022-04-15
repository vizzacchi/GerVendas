<?php 
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

if (!empty($_GET['id'])){
    $id= $_GET['id'];
    mysqli_autocommit($conn, FALSE);
    $erro = 0;
    $qsqlCorretora = "delete from corretora where id = $id";
    $qsqlCorretores = "delete from corretores where id_corretora = $id";
    
    if (mysqli_query($conn, $qsqlCorretora)){
        //echo "Operadora OK";
    }else{
      $erro++;  
    }  
    if (mysqli_query($conn, $qsqlCorretores)){
        //echo "Contato OK";
    }else{
        $erro++;
    }
    if ($erro == 0){
        mysqli_commit($conn);
        echo "ok";
    } else {
        mysqli_rollback($conn); 
        echo "DEU RUIM";
    }    
}else{
    echo "DEU RUIM";
}
?>