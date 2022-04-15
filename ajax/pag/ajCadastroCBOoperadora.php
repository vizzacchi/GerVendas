<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

$tipoPlano = $_POST['tipoPlano'];
if ($tipoPlano=='0'){
    $tipoPlano = "";
}else{
    $condicao = "where tipo_plano = '$tipoPlano' and operadora.situacao = 1 and planos.situacao=1 and operadora.id = planos.cod_oper";
}

$qsql = "SELECT distinct cod_oper,nome_abrev from planos,operadora $condicao ORDER BY operadora.nome_abrev";

if($rs=mysqli_query($conn,$qsql)){
    echo "<option></option>";
    while($reg=mysqli_fetch_array($rs)){
       echo "<option value=".$reg['cod_oper'].">".$reg['nome_abrev']."</option>";
    }
}

?>

