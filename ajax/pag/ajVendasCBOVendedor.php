<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

$qsql = "SELECT DISTINCT cod_vendedor, corretor from venda, corretores where venda.cod_vendedor = id.corretores ORDER BY corretor";

    if($_SESSION['perfil']<=1){
        if($rs=mysqli_query($conn,$qsql)){
            echo "<option value='0'>Todos</option>";
            while($reg=mysqli_fetch_array($rs)){
               echo "<option value='".$reg['cod_vendedor']."'>".$reg['corretor']."</option>";
            }
        }
    }else{
        echo "<option value='".$_SESSION['cpf']."'>".$_SESSION['UsuarioNome']."</option>";
    }
?>

