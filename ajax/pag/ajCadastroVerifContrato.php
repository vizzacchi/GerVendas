<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";
$contrato = $_GET['contrato'];

	 $qsql = "Select contrato, nome,vigencia from venda where contrato = '$contrato'";
         
         if ($rs=mysqli_query($conn,$qsql)){
                if(mysqli_num_rows($rs)>=1){
					$reg = mysqli_fetch_array($rs);
					echo "Contrato:".$reg['contrato']." já cadastrado
					Cliente:".$reg['nome']."
					Vigência:".$reg['vigencia'];
				}
			 	else{
					echo "Sim";
				}
         }else{
             echo "Sim";
         }
             
         ?>