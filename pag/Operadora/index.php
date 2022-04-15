<?php
include "../../inc/conexao.php";
include "../../inc/header.php";
?>
 <!--------------------- aqui começa a página----------------->
    <main class="container-fluid"> 

         <div class="bg-light p-5">
            <h1>Operadoras</h1>
<!------------------Botão Incluir e pesquisa -------------------->             
            
             <div class="row">
                 <div class="col-md-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="botoes" data-toggle="modal" data-target="#incluirOperadora" onClick="btnIncluir()">
                      Incluir
                    </button>  
                 </div>
                 <div class="col-md-8">
                    <form>
                        <div class="input-group w-100">
                          <span class="input-group-text" id="basic-addon1">
                              <img src="../../img/svg/search.svg" alt="Perquisar"/> 
                          </span>
                          <input type="text" class="form-control" placeholder="Pesquisar " aria-label="Pesquisar por nome" id="txtPesquisar" aria-describedby="basic-addon1" onKeyUp="pesquisar()">
                        </div>
                    </form>
                </div>
            </div>
             <hr>
<!-------------------Fim Botão Pesquisa----------------------------------------------->   
             <div id="listagem">
                 <?php include "../../ajax/pag/ajOperadora.php";?>
             </div>
        </div>

<!-- Modal Inclusão-->
<div class="modal fade" id="incluirOperadora" tabindex="-1" aria-labelledby="incluirOperadoraLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="incluirOperadoraLabel">Operadora</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <form action="#" method="post" id="frmIncluir" name="frmIncluir" onSubmit="return processaInclusao()">
          <div class="mb-3">
            <label for="id" class="form-label">#</label>
            <input type="text" class="form-control" id="id" name="id" aria-describedby="Código" required  disabled>
          </div>          
          <div class="mb-3">
            <label for="cpf" class="form-label">CNPJ</label>
            <input type="text" class="form-control" id="cpf" name="cpf" aria-describedby="CNPJ" required  disabled>
          </div>
          <div class="mb-3">
            <label for="txtOperadora" class="form-label">Nome Operadora</label>
            <input type="text" class="form-control" id="txtOperadora" name="txtOperadora" aria-describedby="operadora" required  disabled>
          </div>
          <div class="mb-3">
            <label for="txtNomeAbrev" class="form-label">Nome Abreviado</label>
            <input type="text" class="form-control" id="txtNomeAbrev" name="txtNomeAbrev" aria-describedby="nomeAbrev" required  disabled> 
          </div> 
          <div class="mb-3">
            <label for="cep" class="form-label">Cep</label>
            <input type="text" class="form-control" id="cep" name="cep" required  disabled> 
          </div>               
          <div class="mb-3">
            <label for="txtEndereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="txtEndereco" name="txtEndereco" required  disabled> 
          </div>    
          <div class="mb-3">
            <label for="txtNumero" class="form-label">Número</label>
            <input type="text" class="form-control" id="txtNumero" name="txtNumero"  disabled> 
          </div> 
          <div class="mb-3">
            <label for="txtComplemento" class="form-label">Complemento</label>
            <input type="text" class="form-control" id="txtComplemento" name="txtComplemento"  disabled> 
          </div>
          <div class="mb-3">
            <label for="txtBairro" class="form-label">Bairro</label>
            <input type="text" class="form-control" id="txtBairro" name="txtBairro" required  disabled> 
          </div> 
          <div class="mb-3">
            <label for="txtCidade" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="txtCidade" name="txtCidade" required  disabled> 
          </div>               
          <div class="mb-3">
            <label for="txtUF" class="form-label">UF</label>
            <input type="text" class="form-control" id="txtUF" name="txtUF" required  disabled> 
          </div>     
          <div class="form-check">
              <input name="chkSituacao" type="checkbox" disabled class="form-check-input" id="chkSituacao" value="1" checked="checked" >
              <label class="form-check-label" for="chkSituacao" >
                Ativo
              </label>
          </div>
          <div class="mb-3">
            <label for="txtObservacao" class="form-label">Observação</label>
            <textarea class="form-control" id="txtObservacao" rows="3" name="txtObservacao" disabled></textarea> 
          </div>    
   
      <div class="modal-footer" >
        <button type="button" class="buttonCancelar" id="cancelar" name="cancelar" class="buttonCancelar" data-dismiss="modal" onClick="limpaFormIncluir()">Cancelar</button>
        
        <button id="alterar" name="alterar" class="buttonAlterar" disabled onClick="alterando()">Alterar</button>       
        
        <button type="submit" id="salvar" name="salvar" class="buttonSalvar" disabled  onClick="salvando()">Salvar</button>          
        
      </div>
         </form>
    </div>  
  </div>
</div>
        </div>
<!---- Fim Modal Inclusão--------->

<!-----------  MODAL Contato --------->
<div class="modal fade" id="contatosOperadora" tabindex="-1" aria-labelledby="contatosOperadoraLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contatosOperadoraLabel">Contatos Operadora</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="contatoOperadoras"></div>
        <div class="modal-footer" >
            <button type="button" class="btn-secondary" name="cancelar"  data-dismiss="modal">Fechar</button>
         
        </div>
      </div>
    </div>  
  </div>
</div>
 </main>
     
    <?php
include "../../inc/footer.php";

?>
<script src="../../js/pag/jsOperadora.js.php"></script> 
