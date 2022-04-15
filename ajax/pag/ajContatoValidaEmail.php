<?php 
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

if (!empty($_GET['email'])){
    $email= $_GET['email'];
    $qsqlEmail = "select email from contato_oper where email = '$email'";
    
    if ($rs=mysqli_query($conn, $qsqlEmail)){
        if(mysqli_num_rows($rs)>=1){
            echo "Email já existe";
        }else{
            echo "ok";
        }
    }else{
      echo "ok";  
    }  
}///
?>