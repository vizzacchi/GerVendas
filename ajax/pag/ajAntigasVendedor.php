<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

$corretora = $_POST['corretora'];
if ($corretora=='0'){
    $condicao = "";
}else{
    $condicao = "where corretora = $corretora ";
}

$qsql = "SELECT DISTINCT Vendedor, nomeVendedor from vendasantigas $condicao ORDER BY nomeVendedor";

    if($_SESSION['perfil']<=1){

        if($rs=mysqli_query($conn,$qsql)){
            echo "<option value='0'>Todos</option>";
            while($reg=mysqli_fetch_array($rs)){
               echo "<option value='".$reg['Vendedor']."'>".$reg['nomeVendedor']."</option>";
            }
        }
    }else{
        echo "<option value='".$_SESSION['cpf']."'>".$_SESSION['UsuarioNome']."</option>";
    }

?>

