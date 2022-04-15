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
            <th scope="col">Nome</th>
            <th scope="col">Setor</th>
            <th scope="col">Email</th> 
            <th scope="col">Telefone</th>             
            <th scope="col">Ramal</th> 
            <th scope="col">Celular</th> 
            <th scope="col">Situação</th> 
            <th></th>
            <th></th>
         </tr>
     </thead>
     <tbody>
         <?php
         $qsqlContato = "select * from contato_oper where $condicao order by nome";
         if ($rs=mysqli_query($conn,$qsqlContato) and $condicao<>1){
             while($reg=mysqli_fetch_array($rs)){
                        $id       = $reg['id']; 
                        $cod_oper = $reg['cod_oper'];
                        $nome     = $reg['nome']; 
                        $setor    = $reg['setor'];
                        $email    = $reg['email'];
                        $telefone = $reg['telefone'];
                        $ramal    = $reg['ramal'];
                        $celular  = $reg['celular'];
                        $situacao = $reg['situacao'];
                 
                        $chave ="'". $id."','".$cod_oper."','".$nome."','".$setor."','".$email."','".$telefone."','".$ramal."','".$celular."','".$situacao."'";         
         ?>
                <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo $nome;?></td>
                    <td><?php echo $setor;?></td>
                    <td><?php echo $email;?></td>
                    <td><?php echo $telefone;?></td>
                    <td><?php echo $ramal;?></td>
                    <td><?php echo $celular;?></td>
                    <?php
                    if($situacao=='1'){?>
                        <td align="center"><i class='bi bi-check2-square'></i></td><?php
                    }
                    else{?>
                        <td align="center"><i class='bi bi-x-square'></i></td><?php
                        
                    }
                    ?>
                    <td align="center">
                        <i class="bi bi-plus-square" type="button" data-toggle="modal" data-target="#incluirContato" onClick="btnAlterar(<?php echo $chave;?>)" ></i>
                    </td> 
                  <td align="center">
                      <i class="bi bi-trash" type="button" onClick="contatoElimina(<?php echo $id; ?>)"></i>
                    </td>
                </tr> 
             <?php    
             }?>
                <div class="col-md-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="botoes" data-toggle="modal" data-target="#incluirContato" onClick="btnIncluir()">
                      Incluir
                    </button>  
                 </div> <?php
         }else{?>
             <tr>
                 <td colspan="9">Escolha a operadora para visualizar os contatos</td>
             </tr>
        <?php }

     ?>
     </tbody>
     </table>      
    
 </div>