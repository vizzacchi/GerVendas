<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

$base = $_POST['base'];
if ($base=='0'){
    $condicao = "";
}else{
    $condicao = "where base = '$base' ";
}

$qsql = "SELECT DISTINCT operadora from vendasantigas $condicao ORDER BY operadora";

if($rs=mysqli_query($conn,$qsql)){
    echo "<option value='0'>Todos</option>";
    while($reg=mysqli_fetch_array($rs)){
       echo "<option value='".$reg['operadora']."'>".$reg['operadora']."</option>";
    }
}

?>

