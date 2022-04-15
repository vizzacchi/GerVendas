<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

$corretora = $_POST['corretora'];
if ($corretora=='0'){
    $condicao = "";
}else{
    $condicao = "where id_corretora = $corretora and ativo = 1";
}

$qsql = "SELECT id,corretor from corretores $condicao ORDER BY corretor";

if($rs=mysqli_query($conn,$qsql)){
    echo "<option></option>";
    while($reg=mysqli_fetch_array($rs)){
       echo "<option value='".$reg['id']."'>".$reg['corretor']."</option>";
    }
}

?>

