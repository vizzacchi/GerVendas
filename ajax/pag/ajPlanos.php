<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

if(!empty($_POST['select'])){
    if($_POST['status']==1){
        $condicao = " cod_oper = '".$_POST['select']."' and situacao = '1'";
    }
    elseif($_POST['status']==2){
        $condicao = " cod_oper = '".$_POST['select']."' and situacao = '0'";
    }
    else{
        $condicao = " cod_oper = '".$_POST['select']."'";
    }
}
else{
    $condicao = 1;
}
?> 
<div class="table-responsive">
    <table class="table table-striped align-middle table-sm tablesorter">
     <thead>
         <tr>
            <th scope="col">#</th>
            <th scope="col">Tipo Plano</th>
            <th scope="col">Plano</th>
            <th scope="col">Acomodação</th> 
            <th scope="col">Coparticipação</th>             
            <th scope="col">Situação</th> 
            <th></th>
            <th></th>
         </tr>
     </thead>
     <tbody>
         <?php
         $qsqlPlano = "select * from planos where $condicao order by id";
         if ($rs=mysqli_query($conn,$qsqlPlano) and $condicao<>1){
             while($reg=mysqli_fetch_array($rs)){
                        $id              = $reg['id']; 
                        $cod_oper        = $reg['cod_oper'];
                        $tipo_plano      = $reg['tipo_plano']; 
                        $plano           = $reg['plano'];
                        $acomodacao      = $reg['acomodacao'];
                        $coparticipacao  = $reg['coparticipacao'];
                        $situacao         = $reg['situacao'];
                        $chave ="'". $id."','".$cod_oper."','".$tipo_plano."','".$plano."','".$acomodacao."','".$coparticipacao."','".$situacao."'";         
         ?>
                <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo $tipo_plano;?></td>
                    <td><?php echo $plano;?></td>
                    <td><?php 
                        if ($acomodacao=="ENF"){
                            echo "Enfermaria";
                        }else{
                            echo "Apartamento";
                        }
                    ?></td>
                    <td><?php 
                        if($coparticipacao==1){
                            echo "com Coparticipação";
                        }else{
                            echo "sem Coparticipação";
                        }
                 ?></td>
                    <?php
                    if($situacao=='1'){?>
                        <td align="center"><i class='bi bi-check2-square'></i></td><?php
                    }
                    else{?>
                        <td align="center"><i class='bi bi-x-square'></i></td><?php
                        
                    }
                    ?>
                    <td align="center">
                        <i class="bi bi-plus-square" type="button" data-toggle="modal" data-target="#incluirPlano" onClick="btnAlterar(<?php echo $chave;?>)" ></i>
                    </td> 
                  <td align="center">
                      <?php
                        $qsqlVenda = "Select cod_plano from venda where cod_plano = $id";
                        if($rsVenda=mysqli_query($conn,$qsqlVenda)){
                            if(mysqli_num_rows($rsVenda)>=1){
                                echo "com Venda";
                            }else{
                        ?>
                                <i class="bi bi-trash" type="button" onClick="planoElimina(<?php echo $id; ?>)"></i>                                
                            <?php }
                        }else{ ?>
                            <i class="bi bi-trash" type="button" onClick="planoElimina(<?php echo $id; ?>)"></i>
                    <?php    }
                      
                      
                      ?>

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