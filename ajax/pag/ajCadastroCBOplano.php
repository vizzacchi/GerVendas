<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

$operadora = $_POST['operadora'];
$tipoPlano = $_POST['tipoPlano'];

if ($operadora=='0'){
    $operadora = "";
}else{
    $condicao = "where cod_oper = '$operadora' and tipo_plano = '$tipoPlano' and situacao = 1";
}

$qsql = "SELECT id, plano from planos $condicao ORDER BY plano";

if($rs=mysqli_query($conn,$qsql)){
    echo "<option></option>";
    while($reg=mysqli_fetch_array($rs)){
       echo "<option value='".$reg['id']."'>".$reg['plano']."</option>";
    }
}

?>

