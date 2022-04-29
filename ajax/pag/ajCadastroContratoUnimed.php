<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

$operadora = $_POST['operadora'];
$tipoPlano = $_POST['tipoPlano'];

$qsql = "select contrato from venda where tipoPlano = '$tipoPlano' and cod_operadora = $operadora order by contrato desc";

if($rs=mysqli_query($conn,$qsql)){
	if(mysqli_num_rows($rs)>=1){
		$reg = mysqli_fetch_array($rs);
		$contrato = substr($reg['contrato'],-3)+1;
		if(strlen($contrato)==1){
			echo "uni".$tipoPlano."00".$contrato;
		}elseif(strlen($contrato)==2){
			echo "uni".$tipoPlano."0".$contrato;
		}else{
			echo "uni".$tipoPlano.$contrato;
		}
	}else{
		echo "uni".$tipoPlano."001";
	}
}

?>

