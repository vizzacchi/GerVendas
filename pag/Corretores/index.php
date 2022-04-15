<?php
include "../../inc/conexao.php";
include "../../inc/header.php";
?>
 <!--------------------- aqui começa a página----------------->
    <main class="container-fluid"> 

         <div class="bg-light p-5">
            <h1>Corretores</h1>
<!------------------Botão Incluir e pesquisa -------------------->             
             <form> 
              <div class="form-group row">
                <select class="form-control col-sm-12" id="cboCorretora" name="cboCorretora" onChange="pesquisar()">
                    <option>Escolha a Corretora:</option>
                    <?php 
                        $comboCorretora = '';
                        $qsqlCorretora = "Select id, corretora from corretora where situacao =1 order by corretora";
                        if ($rs=mysqli_query($conn,$qsqlCorretora)){
                            while($reg=mysqli_fetch_array($rs)){
                                $comboCorretora = $comboCorretora."<option value=".$reg['id'].">".$reg['corretora']."</option>";
                            }
                            echo $comboCorretora;
                        }
                    
                    ?>
                </select>   
              </div>
              <div class="form-group row">
                <select class="form-control col-sm-12" id="cboSituacao" name="cboSituacao" onChange="pesquisar()" disabled>
                    <option value = 1 selected>Só os corretores ativos</option>
                    <option value = 2>Só os corretores inativos</option> 
                    <option value = 3>Todos</option>
                </select>                  
            </div>
             </form>
             <hr>
<!-------------------Fim Botão Pesquisa----------------------------------------------->   
             <div id="listagem">
                 <?php include "../../ajax/pag/ajCorretores.php";?>
             </div>
        </div>

<!-- Modal Inclusão-->
<div class="modal fade" id="incluirCorretores" tabindex="-1" aria-labelledby="incluirCorretoresLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="incluirCorretoresLabel">Corretor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                    
          <form action="#" method="post" id="frmIncluir" name="frmIncluir" onSubmit="return processaInclusao()">
          <div class="mb-3">
            <input type="text" class="form-control" id="id_corretora" name="id_corretora" hidden="true">
              
            <label for="id" class="form-label">#</label>
            <input type="text" class="form-control" id="id" name="id" aria-describedby="Código" readonly>
          </div>          
          <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" aria-describedby="CPF" required  disabled>
          </div>
          <div class="mb-3">
            <label for="txtCorretor" class="form-label">Nome Corretor</label>
            <input type="text" class="form-control" id="txtCorretor" name="txtCorretor" aria-describedby="Corretor" required  disabled>
          </div>
          <div class="mb-3">
            <label for="txtEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="txtEmail" name="txtEmail" aria-describedby="Email" required  disabled onBlur="validaEmail()"> 
          </div> 
          <div class="mb-3">
            <label for="txtCelular" class="form-label">Celular</label>
            <input type="text" class="form-control" id="txtCelular" name="txtCelular" required  disabled> 
          </div>  

          <div class="mb-3">
                <select class="form-control col-sm-12" id="cboPerfil" name="cboPerfil" disabled>
                    <option>Perfil do usuário:</option>
                    <option value=0>Administrador</option>
                    <option value=1>Operacional</option>
                    <option value=2>Vendedor Interno</option>
                    <option value=3>Vendedor Externo</option>
                    <option value=4>Corretor Parceiro</option>
              </select>
          </div>  
          <div class="perfil">    
              <div class="form-check">
                  <input name="chkSituacao" type="checkbox" disabled class="form-check-input" id="chkSituacao" value="1" checked="checked" >
                  <label class="form-check-label" for="chkSituacao" >
                    Ativo
                  </label>
              </div>    
              <div class="form-check">
                  <input name="chkVendedor" type="checkbox" disabled class="form-check-input" id="chkVendedor" value="1" checked="checked" >
                  <label class="form-check-label" for="chkVendedor" >
                    Vendedor
                  </label>
              </div>    
              <div class="form-check">
                  <input name="chkFinanceiro" type="checkbox" disabled class="form-check-input" id="chkFinanceiro" value="1" checked="checked" >
                  <label class="form-check-label" for="chkFinanceiro" >
                    Financeiro
                  </label>
              </div> 
              <div class="form-check">
                  <input name="chkResponsavel" type="checkbox" disabled class="form-check-input" id="chkResponsavel" value="1" checked="checked" >
                  <label class="form-check-label" for="chkResponsavel" >
                    Responsável
                  </label>
              </div>               
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
<script src="../../js/pag/jsCorretores.js.php"></script> 
