<?php
include "../../inc/conexao.php";
include "../../inc/header.php";
?>
 <!--------------------- aqui começa a página----------------->
    <main class="container-fluid"> 

         <div class="bg-light p-5">
            <h1>Tabela Planos</h1>
<!------------------Botão Incluir e pesquisa -------------------->             
             <form> 
              <div class="form-group row">
                <select class="form-control col-sm-12" id="cboOperadora" name="cboOperadora" onChange="pesquisar()">
                    <option>Escolha a Operadora:</option>
                    <?php 
                        $comboOperadora = '';
                        $qsqlOperadora = "Select id, nome_abrev, operadora from operadora where situacao =1 order by operadora";
                        if ($rs=mysqli_query($conn,$qsqlOperadora)){
                            while($reg=mysqli_fetch_array($rs)){
                                $comboOperadora = $comboOperadora."<option value=".$reg['id'].">".$reg['nome_abrev']." - ".$reg['operadora']."</option>";
                            }
                            echo $comboOperadora;
                        }
                    
                    ?>
                </select>   
              </div>
              <div class="form-group row">
                <select class="form-control col-sm-12" id="cboSituacao" name="cboSituacao" onChange="pesquisar()" disabled>
                    <option value = 'PF' selected>Planos PF</option>
                    <option value = 'PJ'>Planos PJ</option> 
                    <option>Todos os Planos</option> 
                </select>                  
            </div>
             </form>
             <hr>
<!-------------------Fim Botão Pesquisa----------------------------------------------->   
             <div id="listagem">
                 <?php include "../../ajax/pag/ajTabelas.php";?>
             </div>
        </div>

<!-- Modal Inclusão-->
<div class="modal fade" id="incluirPlano" tabindex="-1" aria-labelledby="incluirPlanoLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="incluirPlanoLabel">Planos das Operadora</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                    
          <form action="#" method="post" id="frmIncluir" name="frmIncluir" onSubmit="return processaInclusao()">
          <div class="mb-3">
            <input type="text" class="form-control" id="cod_oper" name="cod_oper" hidden="true" onChange="mudaPlano()">
              
            <label for="id" class="form-label">#</label>
            <input type="text" class="form-control" id="id" name="id" aria-describedby="Código" readonly>
          </div>          
          <div class="mb-3">
            <label for="txtValidade" class="form-label">Validade</label>
            <input type="date" class="form-control" id="txtValidade" name="txtValidade" aria-describedby="Validade" required  disabled>
          </div>
          <div class="mb-3">
            <label for="txtPlano" class="form-label">Plano</label>
            <select class="form-control col-sm-12" id="txtPlano" name="txtPlano" requerid disabled ><!-- onChange="validarPlano()" -->
                <option value = '' selected>Escolha o plano:</option>
                
             </select>
          </div>
          <div class="mb-3">
              <label for="cboUmTitular" class="form-label">Um Titular?</label>
              <select class="form-control col-sm-12" id="cboUmTitular" name="cboUmTitular" disabled>
                    <option selected> Selecione:</option>
                    <option value = '' selected></option>
                    <option value = 1>1 Titular</option> 
                    <option value = 0>+ de 1 Titular</option>
              </select>              
         </div>
          <div class="mb-3">
              <label for="cboCompulsorio" class="form-label">Compulsório?</label>
              <select class="form-control col-sm-12" id="cboCompulsorio" name="cboCompulsorio" disabled>
                    <option>Informe o tipo de Tabela:</option>
                    <option value = ''>Indiferente</option> 
                    <option value = 1>Compulsório</option> 
                    <option value = 0>Opcional</option>
              </select>              
         </div> 
          <div class="mb-3">
            <label for="txtVidasIni" class="form-label">Vidas Ini:</label>
            <input type="text" class="form-control" id="txtVidasIni" name="txtVidasIni" aria-describedby="VidasIni" required  disabled>
          </div>              
          <div class="mb-3">
            <label for="txtVidasFim" class="form-label">Vidas Fim:</label>
            <input type="text" class="form-control" id="txtVidasFim" name="txtVidasFim" aria-describedby="VidasFim" required  disabled>
          </div>
          <div class="mb-3">
              <label for="cboTabela" class="form-label">Tabela?</label>
              <select class="form-control col-sm-12" id="cboTabela" name="cboTabela" disabled>
                    <option>Informe a Tabela:</option>
                    <option value = ''></option> 
                    <option value = 'Premium'>Premium</option> 
                    <option value = 'Supremo'>Supremo</option>
              </select>              
         </div> 
          <div class="mb-3">
            <label for="txtFaixa1" class="form-label">De 0 a 18 anos:</label>
            <input type="text" class="form-control" id="txtFaixa1" name="txtFaixa1" aria-describedby="Faixa1" required  disabled>
          </div>
          <div class="mb-3">
            <label for="txtFaixa2" class="form-label">De 19 a 23 anos:</label>
            <input type="text" class="form-control" id="txtFaixa2" name="txtFaixa2" aria-describedby="Faixa2" required  disabled>
          </div>      
          <div class="mb-3">
            <label for="txtFaixa3" class="form-label">De 24 a 28 anos:</label>
            <input type="text" class="form-control" id="txtFaixa3" name="txtFaixa3" aria-describedby="Faixa3" required  disabled>
          </div>
         <div class="mb-3">
            <label for="txtFaixa4" class="form-label">De 29 a 33 anos:</label>
            <input type="text" class="form-control" id="txtFaixa4" name="txtFaixa4" aria-describedby="Faixa4" required  disabled>
          </div>
          <div class="mb-3">
            <label for="txtFaixa5" class="form-label">De 34 a 38 anos:</label>
            <input type="text" class="form-control" id="txtFaixa5" name="txtFaixa5" aria-describedby="Faixa5" required  disabled>
          </div>
          <div class="mb-3">
            <label for="txtFaixa6" class="form-label">De 39 a 43 anos:</label>
            <input type="text" class="form-control" id="txtFaixa6" name="txtFaixa6" aria-describedby="Faixa6" required  disabled>
          </div>
          <div class="mb-3">
            <label for="txtFaixa7" class="form-label">De 44 a 48 anos:</label>
            <input type="text" class="form-control" id="txtFaixa7" name="txtFaixa7" aria-describedby="Faixa7" required  disabled>
          </div>
          <div class="mb-3">
            <label for="txtFaixa8" class="form-label">De 49 a 53 anos:</label>
            <input type="text" class="form-control" id="txtFaixa8" name="txtFaixa8" aria-describedby="Faixa8" required  disabled>
          </div>
          <div class="mb-3">
            <label for="txtFaixa9" class="form-label">De 54 a 58 anos:</label>
            <input type="text" class="form-control" id="txtFaixa9" name="txtFaixa9" aria-describedby="Faixa9" required  disabled>
          </div>
         <div class="mb-3">
            <label for="txtFaixa10" class="form-label">De + de 59anos:</label>
            <input type="text" class="form-control" id="txtFaixa10" name="txtFaixa10" aria-describedby="Faixa10" required  disabled>
          </div>
      <div class="modal-footer" >
        <button type="button" class="buttonCancelar" id="cancelar" name="cancelar" class="buttonCancelar" data-dismiss="modal" onClick="cancelando()">Cancelar</button>
        
        <button id="alterar" name="alterar" class="buttonAlterar" disabled onClick="alterando()">Alterar</button>     
          
        <button type="submit" form="frmIncluir"  id="salvar" name="salvar" class="buttonSalvar" disabled  >Salvar</button>           
      </div>
         </form>
    </div>  
  </div>
</div>
        </div>
<!---- Fim Modal Inclusão--------->
 </main>
     
    <?php
include "../../inc/footer.php";

?>
<script src="../../js/pag/jsTabelas.js.php"></script> 
