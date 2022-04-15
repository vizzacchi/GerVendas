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
?> 
<div class="table-responsive-sm">
    <table class="table table-striped align-middle table-sm tablesorter">
     <thead>
         <tr>
            <th scope="col" style="font-size: small" align="center">#</th>
            <th scope="col" style="font-size: small" align="center">Validade</th>
            <th scope="col" style="font-size: small" align="center">Plano</th>
            <th scope="col" style="font-size: small" align="center">Um Titular</th> 
            <th scope="col" style="font-size: small" align="center">Tipo</th>             
            <th scope="col" style="font-size: small" align="center">Vidas de</th>
            <th scope="col" style="font-size: small" align="center">Vidas até</th>     
            <th scope="col" style="font-size: small" align="center">Tabela</th> 
            <th scope="col" style="font-size: small" align="center">0 a 18</th> 
            <th scope="col" style="font-size: small" align="center">19 a 23</th> 
            <th scope="col" style="font-size: small" align="center">24 a 28</th> 
            <th scope="col" style="font-size: small" align="center">29 a 33</th> 
            <th scope="col" style="font-size: small" align="center">34 a 38</th> 
            <th scope="col" style="font-size: small" align="center">39 a 43</th> 
            <th scope="col" style="font-size: small" align="center">44 a 48</th> 
            <th scope="col" style="font-size: small" align="center">49 a 53</th> 
            <th scope="col" style="font-size: small" align="center">54 a 58</th> 
            <th scope="col" style="font-size: small" align="center">59 ou +</th> 
            <th></th>
            <th></th>
         </tr>
     </thead>
     <tbody>
         <?php
         $qsqlPlano = "select tabela_planos.id,
                              tabela_planos.validade,
                              tabela_planos.plano as codPlano,
                              planos.plano,
                              tabela_planos.umTitular,
                              tabela_planos.compulsorio,
                              tabela_planos.vidas_ini,
                              tabela_planos.vidas_fim,
                              tabela_planos.tabela,
                              tabela_planos.faixa1,
                              tabela_planos.faixa2,
                              tabela_planos.faixa3,
                              tabela_planos.faixa4,
                              tabela_planos.faixa5,
                              tabela_planos.faixa6,
                              tabela_planos.faixa7,
                              tabela_planos.faixa8,
                              tabela_planos.faixa9,
                              tabela_planos.faixa10
                              from tabela_planos, planos where tabela_planos.plano = planos.id and $condicao order by id";
         
         if ($rs=mysqli_query($conn,$qsqlPlano) and $condicao<>1){
             while($reg=mysqli_fetch_array($rs)){
                        $id              = $reg['id']; 
                        $validade        = $reg['validade'];
                        $codPlano        = $reg['codPlano'];
                        $plano           = $reg['plano']; 
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
                 
                        $chave ="'". $id."','".$validade."','".$codPlano."','".$umTitular."','".$compulsorio."','".$vidas_ini."','".$vidas_fim."','".$tabela."','".
                        number_format($faixa1,2,',','.')."','".
                        number_format($faixa2,2,',','.')."','".
                        number_format($faixa3,2,',','.')."','".
                        number_format($faixa4,2,',','.')."','".
                        number_format($faixa5,2,',','.')."','".
                        number_format($faixa6,2,',','.')."','".
                        number_format($faixa7,2,',','.')."','".
                        number_format($faixa8,2,',','.')."','".
                        number_format($faixa9,2,',','.')."','".
                        number_format($faixa10,2,',','.')."'";         
         ?>
                <tr>
                    <td style="font-size: 0.5rem" align="center"><?php echo $id;?></td>
                    <td style="font-size: 0.7rem" align="center"><?php 
                            echo date("d/m/Y", strtotime($validade));
                     ?></td>
                    <td style="font-size: 0.7rem" ><?php echo ucfirst($plano);?></td>
                    <td style="font-size: 0.7rem" align="center"><?php 
                        if($umTitular==''){
                            echo "";
                        }elseif($umTitular==1){
                            echo "Um titular";
                        }else{
                            echo "+ de 1 titular";
                        }?></td>      
                    <td style="font-size: 0.7rem" align="center"><?php 
                        if($compulsorio==''){
                            echo "";
                        }elseif($compulsorio==1){
                            echo "Compulsório";
                        }elseif($compulsorio==0){
                            echo "Opcional";
                        }
                    ?></td>
                    <td style="font-size: 0.7rem" align="center"><?php echo $vidas_ini      ;?></td>
                    <td style="font-size: 0.7rem" align="center"><?php echo $vidas_fim      ;?></td>
                    <td style="font-size: 0.7rem" align="center"><?php echo $tabela         ;?></td>
                    
                    <td style="font-size: 0.7rem" align="center"><?php echo number_format($faixa1,2,",",".");         ;?></td>
                    <td style="font-size: 0.7rem" align="center"><?php echo number_format($faixa2,2,",",".");         ;?></td>
                    <td style="font-size: 0.7rem" align="center"><?php echo number_format($faixa3,2,",",".");         ;?></td>
                    <td style="font-size: 0.7rem" align="center"><?php echo number_format($faixa4,2,",",".");         ;?></td>
                    <td style="font-size: 0.7rem" align="center"><?php echo number_format($faixa5,2,",",".");         ;?></td>
                    <td style="font-size: 0.7rem" align="center"><?php echo number_format($faixa6,2,",",".");         ;?></td>
                    <td style="font-size: 0.7rem" align="center"><?php echo number_format($faixa7,2,",",".");         ;?></td>
                    <td style="font-size: 0.7rem" align="center"><?php echo number_format($faixa8,2,",",".");         ;?></td>
                    <td style="font-size: 0.7rem" align="center"><?php echo number_format($faixa9,2,",",".");         ;?></td>
                    <td style="font-size: 0.7rem" align="center"><?php echo number_format($faixa10,2,",",".");        ;?></td>
                    <td align="center">
                        <i class="bi bi-plus-square" type="button" data-toggle="modal" data-target="#incluirPlano" onClick="btnAlterar(<?php echo $chave;?>)" ></i>
                    </td> 
                  <td align="center">
                      <i class="bi bi-trash" type="button" onClick="tabelaElimina(<?php echo $id; ?>)"></i>                                
                  </td>
                </tr> 
             <?php    
             }?>
                <div class="col-md-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="botoes" data-toggle="modal" data-target="#incluirPlano" onClick="btnIncluir()">
                      Incluir
                    </button>  
                 </div> <?php
         }else{?>
             <tr>
                 <td colspan="9">Escolha a operadora para visualizar os planos</td>
             </tr>
        <?php }

     ?>
     </tbody>
     </table>      
    
 </div>