<?php
include "../../inc/conexao.php";
include "../../inc/header.php";
?>
 <!--------------------- aqui começa a página----------------->
    <main class="container-fluid"> 

         <div class="bg-light p-5">
            <h1>Contatos das Operadoras</h1>
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
                    <option value = 1 selected>Só contatos ativos</option>
                    <option value = 2>Só contatos inativos</option> 
                    <option value = 3>Todos contatos</option>
                </select>                  
            </div>
             </form>
             <hr>
<!-------------------Fim Botão Pesquisa----------------------------------------------->   
             <div id="listagem">
                 <?php include "../../ajax/pag/ajContatos.php";?>
             </div>
        </div>

<!-- Modal Inclusão-->
<div class="modal fade" id="incluirContato" tabindex="-1" aria-labelledby="incluirContatoLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="incluirContatoLabel">Contatos das Operadora</h5>
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
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="txtNome" name="txtNome" aria-describedby="Nome" required  disabled>
          </div>
          <div class="mb-3">
            <label for="txtSetor" class="form-label">Setor</label>
            <input type="text" class="form-control" id="txtSetor" name="txtSetor" aria-describedby="Setor" required  disabled>
          </div>
          <div class="mb-3">
            <label for="txtEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="txtEmail" name="txtEmail" aria-describedby="Email" required  disabled onBlur="validaEmail()"> 
          </div> 
          <div class="mb-3">
            <label for="txtTelefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="txtTelefone" name="txtTelefone" required  disabled> 
          </div>  
          <div class="mb-3">
            <label for="txtRamal" class="form-label">Ramal</label>
            <input type="text" class="form-control" id="txtRamal" name="txtRamal" disabled> 
          </div>               
          <div class="mb-3">
            <label for="txtCelular" class="form-label">Celular</label>
            <input type="text" class="form-control" id="txtCelular" name="txtCelular" required  disabled> 
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
<script src="../../js/pag/jsContatos.js.php"></script> 
