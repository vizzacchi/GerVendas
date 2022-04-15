<?php
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

$id= $_GET['id'];

$qsql = "Select * from corretores where id_corretora= '$id'";

if($rs=mysqli_query($conn,$qsql)){
    if(mysqli_num_rows($rs)>=1){?>
        
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                  <th scope="col">Nome</th>
                  <th scope="col">CPF/CNPJ</th>                    
                  <th scope="col">Email</th>
                  <th scope="col">Telefone</th>
                  <th scope="col">Situação</th>                    
                  <th scope="col">Vendedor</th>
                  <th scope="col">Financeiro</th>
                  <th scope="col">Responsável</th>
                  <th scope="col">Perfil</th>                    
                </tr>     
            </thead>
            <tbody>
                <?php
        while ($reg =mysqli_fetch_assoc($rs)){?>
            <tr>
                <td><?php echo $reg['corretor'];?></td>
                <td><?php echo $reg['cpf'];?></td>
                <td><?php echo $reg['email'];?></td>
                <td><?php echo $reg['celular'];?></td>
                    <td align="center"><?php if($reg['ativo']==1){
                        echo "<i class='bi bi-check2-square'></i>";
                            }else{
                        echo "<i class='bi bi-x-square'></i>";
                        }   ?>
                    </td>                
                <td align="center">
                    <?php if($reg['vendedor']==1){
                            echo "Sim";}
                          else{
                            echo "Não";}?>
                </td>                
                <td align="center">
                    <?php if($reg['financeiro']==1){
                            echo "Sim";}
                          else{
                            echo "Não";}?>
                </td>               
                <td align="center">
                    <?php if($reg['responsavel']==1){
                            echo "Sim";}
                          else{
                            echo "Não";}?>
                </td>                                
                <td><?php echo $reg['id_perfil'];?></td>                                
            </tr>
       <?php }
        ?>
            </tbody>
            <?php
    }else{
         echo "Sem corretores cadastrados para essa corretora";
    }
}else{
    echo "Sem corretores cadastrados para essa corretora";
}

?>


