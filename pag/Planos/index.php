<?php
include "../../inc/conexao.php";
include "../../inc/header.php";
?>
 <!--------------------- aqui começa a página----------------->
    <main class="container-fluid"> 

         <div class="bg-light p-5">
            <h1>Planos das Operadoras</h1>
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
                    <option value = 1 selected>Só planos ativos</option>
                    <option value = 2>Só planos inativos</option> 
                    <option value = 3>Todos os planos</option>
                </select>                  
            </div>
             </form>
             <hr>
<!-------------------Fim Botão Pesquisa----------------------------------------------->   
             <div id="listagem">
                 <?php include "../../ajax/pag/ajPlanos.php";?>
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
            <input type="text" class="form-control" id="cod_oper" name="cod_oper" hidden="true">
              
            <label for="id" class="form-label">#</label>
            <input type="text" class="form-control" id="id" name="id" aria-describedby="Código" readonly>
          </div>          
          <div class="mb-3">
            <label for="txtTipoPlano" class="form-label">Tipo Plano</label>
            <input type="text" class="form-control" id="txtTipoPlano" name="txtTipoPlano" aria-describedby="TipoPlano" required  disabled>
          </div>
          <div class="mb-3">
            <label for="txtPlano" class="form-label">Plano</label>
            <input type="text" class="form-control" id="txtPlano" name="txtPlano" aria-describedby="Plano" required  disabled>
          </div>
          <div class="mb-3">
              <label for="cboAcomodacao" class="form-label">Acomodação</label>
              <select class="form-control col-sm-12" id="cboAcomodacao" name="cboAcomodacao" disabled>
                    <option value = '' selected>Selecione a acomodação</option>
                    <option value = 'ENF'>Enfermaria</option> 
                    <option value = 'APT'>Apartamento</option>
              </select>              
         </div>
          <div class="mb-3">
              <label for="cboCoparticipacao" class="form-label">Coparticipação?</label>
              <select class="form-control col-sm-12" id="cboCoparticipacao" name="cboCoparticipacao" disabled>
                    <option>Informe se terá coparticipação:</option>
                    <option value = 0>Sem Coparticipação</option> 
                    <option value = 1>Com Coparticipação</option>
              </select>              
         </div>                
          <div class="form-check">
              <input name="chkSituacao" type="checkbox" disabled class="form-check-input" id="chkSituacao" value="1" checked="checked" >
              <label class="form-check-label" for="chkSituacao" >
                Ativo
              </label>
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
<script src="../../js/pag/jsPlanos.js.php"></script> 
