<?php
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

echo "<script>alert('oi3')</script>";

$indicacao     = $_POST['txtNumIndicacao'];
$operadora     = $_POST['cboOperadora'];
$vendedor      = $_POST['cboCorretor'];
$corretora     = $_POST['cboCorretora'];
$nome          = $_POST['txtNome'];
$tipoPlano     = $_POST['cboTipoPlano'];
$plano         = $_POST['cboPlano'];
$dataVenda     = date();
$vigencia      = $_POST['txtVigencia'];
$mes           = $_POST['cboMes'];
$vencimento    = $_POST['txtVencimento'];
$entidade      = $_POST['txtEntidade'];
$numVidas      = $_POST['txtNumVidas'];
$valor         = $_POST['txtValor'];
$contrato      = $_POST['txtContrato'];
$situacao      = 1;
 
$qsql = "INSERT INTO `venda` ( `idIndicacao`, `cod_operadora`, `cod_vendedor`, `nome`, `cod_plano`, `dataVenda`, `vigencia`, `mes`, `vencimento`, `tipoPlano`, `entidade`, `numVidas`, `valor`, `contrato`, `corretora`, `titulo`, `situacao`, `codigo`, `char-1`, `cadastradoPor`) VALUES ( '$indicacao', '$operadora', '$vendedor', '$nome', '$plano', '$dataVenda', '$vigencia', '$mes', '$vencimento', '$tipoPlano', '$entidade', '$numVidas', '$valor', '$contrato', '$corretora', '', '$situacao', '', '', '')";
echo "<script>alert('".$qsql."')</script>";

if($rs = mysqli_query($conn,$qsql)){
    $id = mysqli_insert_id($conn);
    echo "<script>alert('".$id."')</script>";
}

?>
