<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";
$id = $_GET['id'];
$carteirinha = $_GET['codigo'];

//Atualizando o código na tabela de beneficiário
$qsql = "UPDATE `venda` SET `codigo` = '$carteirinha' WHERE `venda`.`id` = $id; ";
if($rs=mysqli_query($conn,$qsql)){
	$qsqlVenda = "update venda,vendabeneficiario SET venda.situacao = 2 where venda.id = vendabeneficiario.idVenda AND vendabeneficiario.id = $id";
	if($rsVenda = mysqli_query($conn,$qsqlVenda)){
		echo "Sim";
	}else{
		echo "Não";
	}
}else{
	echo "Não";
}
