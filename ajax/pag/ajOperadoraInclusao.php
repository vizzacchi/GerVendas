<?php
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

$tirar        = array("-",".","/",","," ");
$id         = $_POST['id'];
$cnpj       = str_replace($tirar,"",$_POST['cpf']);
$operadora  = $_POST['txtOperadora'];
$nomeAbrev  = $_POST['txtNomeAbrev'];
$cep        = str_replace($tirar,"",$_POST['cep']);
$endereco   = $_POST['txtEndereco'];
$numero     = $_POST['txtNumero'];
$complemento= $_POST['txtComplemento'];
$bairro     = $_POST['txtBairro'];
$cidade     = $_POST['txtCidade'];
$UF         = $_POST['txtUF'];
$observacao = $_POST['txtObservacao'];
$situacao   = $_POST['chkSituacao'];?>

<?php
if(validar_cnpj($cnpj)==""){
    echo "<script> 
            alert('O CNPJ ".$cnpj." não é válido!');
            $('#cpf').focus();
        </script>"; 
    
}else{
    if($id<>''){
        $qsql = "Update `operadora` set `cnpj`='$cnpj', `operadora`='$operadora', `nome_abrev`='$nomeAbrev', `endereco`='$endereco', `numero`='$numero', `complemento`='$complemento', `bairro`='$bairro', `cidade`='$cidade', `cep`='$cep', `UF`='$UF', `situacao`='$situacao', `observacao`='$observacao' WHERE id=$id";
        
    }else{
        $qsql = "INSERT INTO `operadora` (`id`, `logo`, `cnpj`, `operadora`, `nome_abrev`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `cep`, `UF`, `situacao`, `observacao`) VALUES (NULL, '', '$cnpj', '$operadora', '$nomeAbrev','$endereco', '$numero', '$complemento', '$bairro', '$cidade', '$cep','$UF', '$situacao', '$observacao')";
    }
    if($rs=mysqli_query($conn,$qsql)){
        echo "<script> 
                alert('Operadora incluída com sucesso.');
                limpaFormIncluir();
                pesquisar();
                $('#cancelar').trigger('click');
            </script>";         
    }else{
        echo "<script> 
                alert('Não foi possível incluir a operadora, verifique a entrada de dados.');
            </script>"; 
    }
}
?>


