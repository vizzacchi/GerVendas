<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";
$plano = $_GET['plano'];

         $qsqlPlano = "select * from tabela_planos where tabela_planos.plano = $plano";
         
         if ($rs=mysqli_query($conn,$qsqlPlano) and mysqli_num_rows($rs)>=1){
                $reg = mysqli_fetch_array($rs);
                        $id              = $reg['id']; 
                        $validade        = $reg['validade'];
                        $codPlano        = $reg['plano'];
                        $umTitular       = $reg['umTitular'];
                        $compulsorio     = $reg['compulsorio'];
                        $vidas_ini       = $reg['vidas_ini'];
                        $vidas_fim       = $reg['vidas_fim'];
                        $tabela          = $reg['tabela'];
                        $faixa1          = $reg['faixa1'];
                        $faixa2          = $reg['faixa2'];
                        $faixa3          = $reg['faixa3'];
                        $faixa4          = $reg['faixa4'];
                        $faixa5          = $reg['faixa5'];
                        $faixa6          = $reg['faixa6'];
                        $faixa7          = $reg['faixa7'];
                        $faixa8          = $reg['faixa8'];
                        $faixa9          = $reg['faixa9'];
                        $faixa10         = $reg['faixa10'];
                 
                        echo  $id.";".$validade.";".$codPlano.";".$umTitular.";".$compulsorio.";".$vidas_ini.";".$vidas_fim.";".$tabela.";".
                        number_format($faixa1,2,',','.').";".
                        number_format($faixa2,2,',','.').";".
                        number_format($faixa3,2,',','.').";".
                        number_format($faixa4,2,',','.').";".
                        number_format($faixa5,2,',','.').";".
                        number_format($faixa6,2,',','.').";".
                        number_format($faixa7,2,',','.').";".
                        number_format($faixa8,2,',','.').";".
                        number_format($faixa9,2,',','.').";".
                        number_format($faixa10,2,',','.'); 
                        
         }else{
             echo "Não";
         }
             
         ?>