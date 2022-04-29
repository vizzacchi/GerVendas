<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

$corretora = $_POST['corretora'];
if ($corretora=='0'){
    $condicao = " where 1";
}else{
    $condicao = " where id_corretora = $corretora ";
}

$qsql = "SELECT id, corretor from corretores $condicao ORDER BY corretor";

    if($_SESSION['perfil']<=1){

        if($rs=mysqli_query($conn,$qsql)){
            echo "<option value='0'>Todos</option>";
            while($reg=mysqli_fetch_array($rs)){
               echo "<option value='".$reg['id']."'>".$reg['corretor']."</option>";
            }
        }
    }else{
		$cpf = $_SESSION['cpf'];
		$qsql = "SELECT id, corretor from corretores where cpf = $cpf ";
		if($rs=mysqli_query($conn,$qsql)){
			$reg=mysqli_fetch_array($rs);
			echo "<option value='".$reg['id']."'>".$reg['corretor']."</option>";
		}
        
    }

?>

