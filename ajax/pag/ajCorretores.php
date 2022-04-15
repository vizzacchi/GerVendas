<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";


if(!empty($_POST['select'])){
    if($_POST['status']==1){
        $condicao = " id_corretora = '".$_POST['select']."' and ativo = '1'";
    }
    elseif($_POST['status']==2){
        $condicao = " id_corretora = '".$_POST['select']."' and ativo = '0'";
    }
    else{
        $condicao = " id_corretora = '".$_POST['select']."'";
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
            <th scope="col">Corretor</th>
            <th scope="col">CPF</th>
            <th scope="col">E-mail</th>
            <th scope="col">Celular</th> 
            <th scope="col">Situação</th>             
            <th scope="col">Vendedor</th> 
            <th scope="col">Financeiro</th> 
            <th scope="col">Responsável</th> 
            <th scope="col">Perfil</th> 
            <th></th>
            <th></th>
         </tr>
     </thead>
     <tbody>
         <?php
         $qsqlCorretores = "select * from corretores where $condicao order by corretor";
         
         if ($rs=mysqli_query($conn,$qsqlCorretores) and $condicao<>1){
             while($reg=mysqli_fetch_array($rs)){
                        $id         = $reg['id']; 
                        $corretor   = $reg['corretor']; 
                        $cpf        = $reg['cpf'];
                        $email      = $reg['email'];
                        $celular    = $reg['celular'];
                        $situacao   = $reg['ativo'];
                        $vendedor   = $reg['vendedor'];
                        $financeiro = $reg['financeiro'];
                        $responsavel= $reg['responsavel'];
                        $perfil     = $reg['id_perfil'];
                 
                        $chave ="'". $id."','".$corretor."','".$cpf."','".$email."','".$celular."','".$situacao."','".$vendedor."','".$financeiro."','".$responsavel."','".$perfil."'";         
         ?>
                <tr>
                    <td><?php echo $corretor;?></td>
                    <td><?php echo formatar_cpf_cnpj($cpf);?></td>
                    <td><?php echo $email;?></td>
                    <td><?php echo $celular;?></td><?php
                    if($situacao=='1'){?>
                        <td align="center"><i class='bi bi-check2-square'></i></td><?php
                    }
                    else{?>
                        <td align="center"><i class='bi bi-x-square'></i></td><?php
                        
                    }
                    if($vendedor=='1'){?>
                        <td align="center">Sim</td><?php
                    }
                    else{?>
                        <td align="center">Não</td><?php
                        
                    }                
                    if($financeiro=='1'){?>
                        <td align="center">Sim</td><?php
                    }
                    else{?>
                        <td align="center">Não</td><?php
                        
                    }
                    if($responsavel=='1'){?>
                        <td align="center">Sim</td><?php
                    }
                    else{?>
                        <td align="center">Não</td><?php
                        
                    }
                    ?>
                    <td align="center"><?php echo $constPerfil[$perfil];?></td>
                    <td align="center">
                        <i class="bi bi-plus-square" type="button" data-toggle="modal" data-target="#incluirCorretores" onClick="btnAlterar(<?php echo $chave;?>)" ></i>
                    </td> 
                  <td align="center">
                      <?php
                        $qsqlVendas = "Select cod_vendedor from venda where cod_vendedor =               '$id'";
                        if($rsVendas=mysqli_query($conn,$qsqlVendas)){
                            if(mysqli_num_rows($rsVendas)>=1){
                                echo "Venda";
                            }
                            else{?>
                               <i class="bi bi-trash" type="button" onClick="corretorElimina(<?php echo $id; ?>)"></i>
                            <?php 
                                
                            }
                        }
                     ?>
                    </td>
                </tr> 
             <?php    
             }?>
                <div class="col-md-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="botoes" data-toggle="modal" data-target="#incluirCorretores" onClick="btnIncluir()">
                      Incluir
                    </button>  
                 </div> <?php
         }else{?>
             <tr>
                 <td colspan="9">Escolha a corretora para visualizar os corretores</td>
             </tr>
        <?php }

     ?>
     </tbody>
     </table>      
    
 </div>