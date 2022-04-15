<?php
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

$id= $_GET['id'];

$qsql = "Select * from contato_oper where cod_oper= '$id'";

if($rs=mysqli_query($conn,$qsql)){
    if(mysqli_num_rows($rs)>=1){?>
        
        <table class="table">
            <thead>
                <tr>
                  <th scope="col">Nome</th>
                  <th scope="col">Setor</th>
                  <th scope="col">Email</th>
                  <th scope="col">Telefone</th>
                  <th scope="col">Celular</th>                    
                </tr>     
            </thead>
            <tbody>
                <?php
        while ($reg =mysqli_fetch_assoc($rs)){?>
            <tr>
                <td><?php echo $reg['nome'];?></td>
                <td><?php echo $reg['setor'];?></td>
                <td><?php echo $reg['email'];?></td>
                <td><?php echo $reg['telefone'];?></td>
                <td><?php echo $reg['celular'];?></td>                
            </tr>
       <?php }
        ?>
            </tbody>
            <?php
    }else{
         echo "Sem contatos cadastrados para essa operadora";
    }
}else{
    echo "Sem contatos cadastrados para essa operadora";
}

?>


