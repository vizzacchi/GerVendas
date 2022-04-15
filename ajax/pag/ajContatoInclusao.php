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
$nome         = $_POST['txtNome'];
$setor        = $_POST['txtSetor'];
$email        = $_POST['txtEmail'];
$telefone     = str_replace($tirar,"",$_POST['txtTelefone']);
$ramal        = $_POST['txtRamal'];
$celular      = str_replace($tirar,"",$_POST['txtCelular']);
if(isset($_POST['chkSituacao'])){
    $situacao     = $_POST['chkSituacao'];
}else{
    $situacao =0;
}
    if($id<>''){
        $qsql = "Update `contato_oper` set `cod_oper`='$cod_oper', `nome`='$nome', `setor`='$setor',`email`='$email', `telefone`='$telefone', `ramal`='$ramal', `celular`='$celular', `situacao`='$situacao' WHERE id=$id";
    }else{
        $qsql = "INSERT INTO `contato_oper` (`id`, `cod_oper`, `nome`, `setor`,`email`, `telefone`, `ramal`, `celular`, `situacao`) VALUES (NULL, '$cod_oper', '$nome', '$setor','$email','$telefone', '$ramal', '$celular', '$situacao')"; 
    }
    if($rs=mysqli_query($conn,$qsql)){
        echo "<script>
                alert('Contato incluído com sucesso.');
                pesquisar();
                $('#cancelar').trigger('click');
            </script>";         
    }else{
        echo "<script> 
                alert('Não foi possível incluir o contato, verifique a entrada de dados.');
            </script>"; 
            
    }
?>
