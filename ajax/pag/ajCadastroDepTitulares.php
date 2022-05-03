<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

if(!empty($_POST['id'])){
	$id = $_POST['id'];
	$condicao = " idVenda = $id and tipoBeneficiario = 0";
}else{
    $condicao = 1;
}

$qsql = "Select idVenda, id, nome from vendabeneficiario where $condicao";
if($rs=mysqli_query($conn,$qsql) and mysqli_num_rows($rs)>=1){
	while($reg=mysqli_fetch_array($rs)){
		$titular = $reg['id'];
		$nome    = $reg['nome'];
		echo "<option value='$titular'>".$nome."</option>";
	}
	echo "<option value='Novo'>Novo titular</option>";
}else{
	echo "<option value='Novo'>Novo titular</option>";
}

?> 
