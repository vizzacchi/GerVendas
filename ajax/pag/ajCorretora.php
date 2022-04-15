<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";


if(!empty($_POST['select'])){
    $condicao = " corretora like '".$_POST['select']."%'";
}
else{
    $condicao = 1;
}

?> 

<div class="table-responsive">
    <table class="table table-striped align-middle table-sm tablesorter">
     <thead>
         <tr>
            <th scope="col">Logo</th>
            <th scope="col">CNPJ</th>
            <th scope="col">Nome</th>
            <th scope="col">Apelido</th> 
            <th scope="col">Situação</th>             
            <th scope="col">Contatos</th> 
            <th scope="col">Detalhes</th> 
            <th scope="col">Eliminar</th> 
         </tr>
     </thead>
     <tbody>
         <?php
         $qsqlCorretora = "select * from corretora where $condicao";
         
         if ($rs=mysqli_query($conn,$qsqlCorretora)){
             while($reg=mysqli_fetch_array($rs)){
                        $id         = $reg['id']; 
                        $logo       = $reg['logo']; 
                        $cnpj       = $reg['cnpj'];
                        $corretora  = $reg['corretora'];
                        $nome_abrev = $reg['nomeAbrev'];
                        $cep        = $reg['cep'];
                        $endereco   = $reg['rua'];
                        $numero     = $reg['numero'];
                        $complemento= $reg['complemento'];
                        $bairro     = $reg['bairro'];
                        $cidade     = $reg['cidade'];
                        $uf         = $reg['UF'];
                        $situacao   = $reg['situacao'];
                        $telefone   = $reg['telefone'];
                        $chave ="'". $id."','".$logo."','".$cnpj."','".$corretora."','".$nome_abrev."','".$cep."','".$endereco."','".$numero."','".$complemento."','".$bairro."','".$cidade."','".$uf."','".$situacao."','".$telefone."'";         
         ?>
                <tr>
                    <td><?php if ($logo<>''){
                            ?>
                        <figure class="figure">
                        <img src="<?php echo "../".$logo; ?>" class="figure-img img-fluid rounded" alt="..." width=50>

                            <?php	}else{
                                   
                            ?>

							<form method="post" enctype="multipart/form-data" action="../../ajax/ajEnviaCorretora.php?id=<?php echo $id; ?>" id="frmImagem" name="frmImagem">
								<input class="form-control" type="file" name ="arquivo" id="formFile">
								<button type="submit">Enviar</button>
							</form>
                    <?php
                        } ; ?></td>

                    <td><?php

                    
                        echo formatar_cpf_cnpj($cnpj);

                        ?></td>
                    <td><?php echo $corretora;?></td>
                    <td><?php echo $nome_abrev;?></td>
                    <td align="center"><?php if($situacao==1){
                        echo "<i class='bi bi-check2-square'></i>";
                            }else{
                        echo "<i class='bi bi-x-square'></i>";
                        }   ?></td>   
                    <td align="center">
                        <i class="bi bi-people-fill" type="button" data-toggle="modal" data-target="#contatosCorretora" onClick="contatoCorretora(<?php echo $id;?>)"></i>
                    </td>
                    
                    <td align="center">
                        <i class="bi bi-plus-square" type="button" data-toggle="modal" data-target="#incluirCorretora" onClick="btnAlterar(<?php echo $chave;?>)" ></i>
                    </td> 
                  <td align="center">
                        <?php 
                        $qsqlVenda = "SELECT corretores.id, venda.cod_vendedor, corretora.id FROM corretores,venda,corretora WHERE venda.cod_vendedor = corretores.id AND corretora.id = corretores.id_corretora and venda.cod_vendedor =$id";
                        
                        if($rsVenda=mysqli_query($conn,$qsqlVenda)){
                            if(mysqli_num_rows($rsVenda)>=1){   
                                echo "Com Venda";
                            }else{ ?>
                            <i class="bi bi-trash" type="button" onClick="corretoraElimina(<?php echo $id; ?>)"></i>
                                <?php
                            }
                        } ?>
                    </td>
                </tr>
             <?php    
             }
         }

     ?>
     </tbody>
     </table>      
    
 </div>