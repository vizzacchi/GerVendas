<?php
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

$tirar        = array("-",".","/",","," ");
$cod_oper = $_POST['cod_oper'];

if(isset($_POST['id'])) {
    $id = $_POST['id'];
}else{
    $id="";
}
$tipoPlano      = $_POST['txtTipoPlano'];
$plano          = $_POST['txtPlano'];
$acomodacao     = $_POST['cboAcomodacao'];
$coparticipacao = $_POST['cboCoparticipacao'];
if(isset($_POST['chkSituacao'])){
    $situacao     = $_POST['chkSituacao'];
}else{
    $situacao =0;
}
    if($id<>''){
        $qsql = "Update `planos` set `cod_oper`='$cod_oper', `tipo_plano`='$tipoPlano', `plano`='$plano',`acomodacao`='$acomodacao', `coparticipacao`='$coparticipacao',  `situacao`='$situacao' WHERE id=$id";
    }else{
        $qsql = "INSERT INTO `planos` (`id`, `cod_oper`, `tipo_plano`, `plano`,`acomodacao`, `coparticipacao`, `situacao`) VALUES (NULL, '$cod_oper', '$tipoPlano', '$plano','$acomodacao','$coparticipacao', '$situacao')"; 
    }
    if($rs=mysqli_query($conn,$qsql)){
        echo "<script>
                alert('Plano incluído com sucesso.');
                pesquisar();
                $('#cancelar').trigger('click');
            </script>";         
    }else{
        echo "<script> 
                alert('Não foi possível incluir o plano, verifique a entrada de dados.');
            </script>"; 
            
    }
?>
