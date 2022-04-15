<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

if(!empty($_POST['select'])){
    if($_POST['status']=='PF'){
        $condicao = " cod_oper = '".$_POST['select']."' and tipo_plano = 'PF'";
    }
    elseif($_POST['status']=='PJ'){
        $condicao = " cod_oper = '".$_POST['select']."' and tipo_plano = 'PJ'";
    }
    else{
        $condicao = " cod_oper = '".$_POST['select']."'";
    }
}
else{
    $condicao = 1;
}

         $qsqlPlano = "select planos.id,
                              planos.plano
                              from planos where planos.situacao = 1 and $condicao order by id";
         $combo='';
         if ($rs=mysqli_query($conn,$qsqlPlano) and $condicao<>1){
             while($reg=mysqli_fetch_array($rs)){
                        $id              = $reg['id']; 
                        $plano           = $reg['plano']; 
                        
                        $combo = $combo."<option value = ".$id.">".$plano."</option>";
                     
             }
             echo $combo;
         }
         ?>