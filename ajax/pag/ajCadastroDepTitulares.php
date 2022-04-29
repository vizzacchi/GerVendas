<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

if(!empty($_POST['venda'])){
	$id = $_POST['venda'];
	$condicao = " idVenda = $id and tipoBeneficiario = 0";
}
else{
    $condicao = 1;
}

$qsql = "Select idVenda, id, nome from vendabeneficiario where $condicao";
if($rs=mysqli_query($conn,$qsql)){
?>
	<datalist id="titulares">
<?php
	while($reg=mysqli_fetch_array($rs)){
		$titular = $reg['id'];
		$nome    = $reg['nome'];
		echo "<option value=$titular>".$nome."</option>";
	}
	echo "</datalist>";
}

?> 
