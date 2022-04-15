<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

if (!empty($_GET['id'])){
    $id= $_GET['id'];
    mysqli_autocommit($conn, FALSE);
    $erro = 0;
    $qsqlOperadora = "delete from operadora where id = $id";
    $qsqlContato = "delete from contato_oper where cod_oper = $id";
    $qsqlRegiao = "delete regiao.*, cidade_regiao.* from regiao, cidade_regiao where regiao.cod_oper = $id and cidade_regiao.cod_regiao = regiao.id";
    $qsqlPlanos = "DELETE tabela_planos.*, planos.* FROM `tabela_planos`, `planos` WHERE planos.cod_oper = $id and tabela_planos.plano = planos.id";
    
    if (mysqli_query($conn, $qsqlOperadora)){
        //echo "Operadora OK";
    }else{
      $erro++;  
    }  
    if (mysqli_query($conn, $qsqlContato)){
        //echo "Contato OK";
    }else{
        $erro++;
    }
    if (mysqli_query($conn, $qsqlRegiao)){
        //echo "Região OK";
    }else{ 
        $erro++;
    }

    if (mysqli_query($conn, $qsqlPlanos)){
        //echo "Planos OK";
    }else{
        $erro++; 
    }
    if ($erro == 0){
        mysqli_commit($conn);
        echo "ok";
    } else {
        mysqli_rollback($conn); 
        echo "DEU RUIM";
    }
}else{
    echo "DEU RUIM";
}
?>