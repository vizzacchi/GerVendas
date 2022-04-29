<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";
$id = $_GET['id'];

	 $qsql = "UPDATE `venda` SET `situacao` = '3' WHERE `venda`.`id` = $id";
         
         if ($rs=mysqli_query($conn,$qsql)){
                echo "Sim";
         }else{
             echo "Não";
         }
             
         ?>