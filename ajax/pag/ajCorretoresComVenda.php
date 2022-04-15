<?php 
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

if (!empty($_GET['id'])){
    $id=$_GET['id'];
    $qsqlID = "select cod_vendedor from venda where cod_vendedor = '$id'";
    
    if ($rs=mysqli_query($conn, $qsqlID)){
        if(mysqli_num_rows($rs)>=1){
            echo "Com venda";
        }else{
            echo "ok";
        }
    }else{
      echo "ok";  
    }  
}///
?>