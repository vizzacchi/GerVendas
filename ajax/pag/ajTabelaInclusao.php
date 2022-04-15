<?php
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

if(isset($_POST['id'])) {
    $id = $_POST['id'];
}else{
    $id="";
}
$validade     = $_POST['txtValidade'];
$plano        = $_POST['txtPlano'];
$umTitular    = $_POST['cboUmTitular'];
$compulsorio  = $_POST['cboCompulsorio'];
$vidasIni     = $_POST['txtVidasIni'];
$vidasFim     = $_POST['txtVidasFim'];
$tabela       = $_POST['cboTabela'];
$faixa1       = str_replace(",",".",str_replace(".","",$_POST['txtFaixa1']));
$faixa2       = str_replace(",",".",str_replace(".","",$_POST['txtFaixa2']));
$faixa3       = str_replace(",",".",str_replace(".","",$_POST['txtFaixa3']));
$faixa4       = str_replace(",",".",str_replace(".","",$_POST['txtFaixa4']));
$faixa5       = str_replace(",",".",str_replace(".","",$_POST['txtFaixa5']));
$faixa6       = str_replace(",",".",str_replace(".","",$_POST['txtFaixa6']));
$faixa7       = str_replace(",",".",str_replace(".","",$_POST['txtFaixa7']));
$faixa8       = str_replace(",",".",str_replace(".","",$_POST['txtFaixa8']));
$faixa9       = str_replace(",",".",str_replace(".","",$_POST['txtFaixa9']));
$faixa10      = str_replace(",",".",str_replace(".","",$_POST['txtFaixa10']));

    if($id<>''){
        $qsql = "Update `tabela_planos` set `validade`='$validade',`plano`='$plano', `umTitular`='$umTitular', `compulsorio`='$compulsorio',`vidas_ini`='$vidasIni', `vidas_fim`='$vidasFim', `tabela`='$tabela', `faixa1`='$faixa1', `faixa2`='$faixa2', `faixa3`='$faixa3', `faixa4`='$faixa4', `faixa5`='$faixa5', `faixa6`='$faixa6', `faixa7`='$faixa7', `faixa8`='$faixa8', `faixa9`='$faixa9', `faixa10`='$faixa10' WHERE id=$id";
    }else{
        $qsql = "INSERT INTO `tabela_planos` (`id`, `validade`, `plano`, `umTitular`,`compulsorio`, `vidas_ini`, `vidas_fim`, `tabela`, `faixa1`, `faixa2`, `faixa3`, `faixa4`, `faixa5`, `faixa6`, `faixa7`, `faixa8`, `faixa9`, `faixa10`) VALUES (NULL, '$validade', '$plano', '$umTitular','$compulsorio','$vidasIni', '$vidasFim', '$tabela', '$faixa1', '$faixa2', '$faixa3', '$faixa4', '$faixa5', '$faixa6', '$faixa7', '$faixa8', '$faixa9', '$faixa10')"; 
    }
    if($rs=mysqli_query($conn,$qsql)){
        echo "<script>
                alert('Tabela incluída com sucesso.');
                pesquisar();
                $('#cancelar').trigger('click');
            </script>";         
    }else{
        echo "<script> 
                alert('Não foi possível incluir a tabela, verifique a entrada de dados.');
            </script>"; 
            
    }
?>
