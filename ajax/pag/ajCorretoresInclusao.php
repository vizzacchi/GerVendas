<?php
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

$tirar        = array("-",".","/",","," ");
$id_corretora = $_POST['id_corretora'];

if(isset($_POST['id'])) {
    $id = $_POST['id'];
}else{
    $id="";
}
$cpf          = str_replace($tirar,"",$_POST['cpf']);
$corretor     = $_POST['txtCorretor'];
$email        = $_POST['txtEmail'];
$celular      = str_replace($tirar,"",$_POST['txtCelular']);
if(isset($_POST['chkSituacao'])){
    $situacao     = $_POST['chkSituacao'];
}else{
    $situacao =0;
}
if(isset($_POST['chkVendedor'])){
    $vendedor =$_POST['chkVendedor'];
}else{
    $vendedor=0;
}
if(isset($_POST['chkFinanceiro'])){
    $financeiro = $_POST['chkFinanceiro'];
}else{
    $financeiro = 0;
}
if(isset($_POST['chkResponsavel'])){
    $responsavel = $_POST['chkResponsavel'];
}else{
    $responsavel = 0;
}
$perfil       = $_POST['cboPerfil'];
if(validaCPF($cpf)==false){
    echo "<script> 
            alert('O CPF ".$cpf." não é válido!');
            $('#cpf').focus();
        </script>"; 
    
}else{
    if($id<>''){
        $qsql = "Update `corretores` set `id_corretora`='$id_corretora', `cpf`='$cpf', `corretor`='$corretor',`email`='$email', `celular`='$celular', `ativo`='$situacao', `vendedor`='$vendedor', `financeiro`='$financeiro', `responsavel`='$responsavel', `id_perfil`=$perfil WHERE id=$id";
        echo $qsql;
        echo "<script>alert('".$qsql."')</script>";
    }else{
        $qsql = "INSERT INTO `corretores` (`id`, `id_corretora`, `cpf`, `corretor`,`email`, `senha`, `celular`, `ativo`, `vendedor`, `financeiro`,`responsavel`, `id_perfil`) VALUES (NULL, '$id_corretora', '$cpf', '$corretor','$email', '999','$celular', '$situacao', '$vendedor', '$financeiro','$responsavel', '$perfil')"; 
    }
    if($rs=mysqli_query($conn,$qsql)){
        echo "<script>
                alert('Corretor incluída com sucesso.');
                pesquisar();
                $('#cancelar').trigger('click');
            </script>";         
    }else{
        echo "<script> 
                alert('Não foi possível incluir o corretor, verifique a entrada de dados.');
            </script>"; 
            
    }
    echo $qsql;
}
?>
