<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";
$tipoPlano = $_POST['tipoPlano'];

if($tipoPlano <> '0'){
	$qsql = "SELECT DISTINCT venda.cod_operadora, operadora.nome_abrev from venda, operadora where venda.cod_operadora = operadora.id and venda.tipoPlano = '$tipoPlano' ORDER BY operadora.nome_abrev";
}else{
	$qsql = "SELECT DISTINCT venda.cod_operadora, operadora.nome_abrev from venda, operadora where venda.cod_operadora = operadora.id  ORDER BY operadora.nome_abrev";
}

if($rs=mysqli_query($conn,$qsql)){
    echo "<option value='0'>Todos</option>";
    while($reg=mysqli_fetch_array($rs)){
       echo "<option value='".$reg['vod_operadora']."'>".$reg['nome_abrev']."</option>";
    }
}

?>

