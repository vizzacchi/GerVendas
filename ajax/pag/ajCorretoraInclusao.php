<?php
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

$tirar        = array("-",".","/",","," ");
$id         = $_POST['id'];
$cnpj       = str_replace($tirar,"",$_POST['cpf']);
$corretora  = $_POST['txtCorretora'];
$nomeAbrev  = $_POST['txtNomeAbrev'];
$cep        = str_replace($tirar,"",$_POST['cep']);
$endereco   = $_POST['txtEndereco'];
$numero     = $_POST['txtNumero'];
$complemento= $_POST['txtComplemento'];
$bairro     = $_POST['txtBairro'];
$cidade     = $_POST['txtCidade'];
$UF         = $_POST['txtUF'];
$telefone = $_POST['txtTelefone'];
$situacao   = $_POST['chkSituacao'];?>

<?php
if(validar_cnpj($cnpj)==""){
    echo "<script> 
            alert('O CNPJ ".$cnpj." não é válido!');
            $('#cpf').focus();
        </script>"; 
    
}else{
    if($id<>''){
        $qsql = "Update `corretora` set `cnpj`='$cnpj', `corretora`='$corretora', `nomeAbrev`='$nomeAbrev', `rua`='$endereco', `numero`='$numero', `complemento`='$complemento', `bairro`='$bairro', `cidade`='$cidade', `cep`='$cep', `UF`='$UF', `situacao`='$situacao', `telefone`='$telefone' WHERE id=$id";
        
    }else{
        $qsql = "INSERT INTO `corretora` (`id`, `logo`, `cnpj`, `corretora`, `nomeAbrev`, `rua`, `numero`, `complemento`, `bairro`, `cidade`, `cep`, `UF`, `situacao`, `telefone`) VALUES (NULL, '', '$cnpj', '$corretora', '$nomeAbrev','$endereco', '$numero', '$complemento', '$bairro', '$cidade', '$cep','$UF', '$situacao', '$telefone')";
    }
    if($rs=mysqli_query($conn,$qsql)){
        echo "<script> 
                alert('Corretora incluída com sucesso.');
                limpaFormIncluir();
                pesquisar();
                $('#cancelar').trigger('click');
            </script>";         
    }else{
        echo "<script> 
                alert('Não foi possível incluir a corretora, verifique a entrada de dados.');
            </script>"; 
    }
}
?>


