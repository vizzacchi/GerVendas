<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

if(!empty($_POST['select'])){
    $condicao = " and regiao.cod_oper = '".$_POST['select']."'";
}
else{
    $condicao = '';
}

?> 
<div class="table-responsive">
    <table class="table table-striped align-middle table-sm tablesorter">
     <thead>
         <tr>
            <th scope="col">Operadora</th>
            <th scope="col">Região</th>
            <th scope="col">Cidades</th> 
         </tr>
     </thead>
     <tbody>
         <?php
         $qsql = "SELECT descricao, cidades, operadora.nome_abrev  FROM `regiao`,operadora WHERE regiao.cod_oper = operadora.id and operadora.situacao = 1 $condicao ";
        if($rs=mysqli_query($conn,$qsql)){
          while($reg=mysqli_fetch_array($rs)){
                        $descricao       = $reg['descricao']; 
                        $operadora       = $reg['nome_abrev'];
                        $cidades         = $reg['cidades']; 
         ?>
                <tr>
                    <td><?php echo $operadora;?></td>
                    <td><?php echo $descricao;?></td>
                    <td><?php echo $cidades;?></td>
                </tr> 
             <?php    
             }
         }else{?>
             <tr>
                 <td colspan="9">Escolha a operadora para visualizar os planos</td>
             </tr>
        <?php }

     ?>
     </tbody>
     </table>      
    
 </div>