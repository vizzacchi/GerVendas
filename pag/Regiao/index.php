<?php
include "../../inc/conexao.php";
include "../../inc/header.php";
?>
 <!--------------------- aqui começa a página----------------->
    <main class="container-fluid"> 

         <div class="bg-light p-5">
            <h1>Cidades por Região Operadora</h1>
<!------------------Botão Incluir e pesquisa -------------------->             
             <form> 
              <div class="form-group row">
                <select class="form-control col-sm-12" id="cboOperadora" name="cboOperadora" onChange="pesquisar()">
                    <option>Escolha a Operadora:</option>
                    <?php 
                        $comboOperadora = '';
                        $qsqlOperadora = "Select id, nome_abrev, operadora from operadora where situacao = 1 order by operadora";
                        if ($rs=mysqli_query($conn,$qsqlOperadora)){
                            while($reg=mysqli_fetch_array($rs)){
                                $comboOperadora = $comboOperadora."<option value=".$reg['id'].">".$reg['nome_abrev']." - ".$reg['operadora']."</option>";
                            }
                            echo $comboOperadora;
                        }
                    
                    ?>
                </select>   
              </div>
             </form>
             <hr>
<!-------------------Fim Botão Pesquisa----------------------------------------------->   
             <div id="listagem">
                 <?php include "../../ajax/pag/ajRegiao.php";?>
             </div>
        </div>

 </main>
     
    <?php
include "../../inc/footer.php";

?>
<script src="../../js/pag/jsRegiao.js.php"></script> 
