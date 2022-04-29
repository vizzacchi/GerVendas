<?php
include "../../inc/conexao.php";
include "../../inc/header.php";
?>
 <!--------------------- aqui começa a página----------------->
<main class="container-fluid"> 

  <div class="bg-light p-5">
      <h1>Cotador Planos de Saúde</h1>
<!------------------Botão Incluir e pesquisa --------------------> 
		<form id="formCotacao" action="#operadoras" method="post" onSubmit="return processaPesquisa()">	
		<section id="cabecalho">
		  <div class="form-group">
			<label>Nome do Cliente:</label>
			<input type="text" class="form-control" id="txtNomeCliente" name="txtNomeCliente" required>
		  </div>
		
		  <div class="form-row">
			<div class="col">
				<label>Tipo Plano:</label>
			  <select class="form-control" id="cboTipoPlano" name="cboTipoPlano">
			    <option value="PF">Pessoa Física</option>
			    <option value="PJ">Pessoa Jurídica</option>
              </select>
			</div>
			<div id="PJ" style="display: none">	
			  <div class="col">
			  	<label>Contratação:</label>	
		  	  	<select class="form-control" id="cboContratacao" name="cboContratacao">
		  	    	<option value="1">Compulsório</option>
		  	    	<option value="0">Opcional</option>
              	</select>
			  </div>		  
		  	</div>
			<div class="form-check" id="individual" name="individual" style="display: none">
				<p>&nbsp;</p>
				<input class="form-check-input" type="checkbox" value="1" id="empIndividual" name="empIndividual">
				<label class="form-check-label" for="empIndividual">
    				Empresário Individual?
  				</label>

			</div>  

		<div id='PF' class="col">
			<label>Escolha a tabela de Adesão:</label>
			<select class="form-control" id="cboProfissao" name="cboProfissao">
				<option value="Premium">Tabela Premium</option>
                <option value="Supremo">Tabela Supremo</option>
            </select>			
		</div>	
			</div>
			<p>&nbsp;</p>
		  <div class="form-row">
			<div class="col">
				<label>Número Titular:</label>
				<select class="form-control" id="cboNumTitular" name="cboNumTitular">
				  <option value="1">1 titular PJ / 1 beneficiário PF</option>
				  <option value="0" selected="SELECTED">+ de 1 titular PJ /+ de 1 beneficiário PF</option>
    			</select>
			</div>
			<div class="col">
			  <label>Acomodação:</label>	
			  	<select class="form-control" id="cboAcomodacao" name="cboAcomodacao">
			  	  <option value="ENF">Enfermaria</option>
			  	  <option value="APT">Apartamento</option>
			  	  <option value="Ambos">Ambos</option>
                </select>
			</div>
			<div class="col">
				<label>Coparticipação:</label>
			  	<select class="form-control" id="cboCoparticipacao" name="cboCoparticipacao">
			  	  <option value="1">Com Coparticipação</option>
			  	  <option value="0">Sem Coparticipação</option>
			  	  <option value="2">Ambos</option>
                </select>
			  				
			</div>	
			</div>
			<p>&nbsp;</p>
			<hr>
			
			<h2 align="center">
			<button type="submit" name='pesquisar' id="pesquisar" form="formCotacao">
			  <img src="images/svg/binoculos.svg" alt="" height=30px/> Pesquisar Planos </button>	
			</form>	
		  </h2>
			<p>&nbsp;</p>
		</section>
		<section id="operadoras">

			<div id="resultadoPesquisa">
				
			
				
			</div>
		
		
		
		</section>
		
		
		

	</main><!-- /.container -->
	
</main>
     
<?php
    include "../../inc/footer.php";

?>
<script src="../../js/pag/jsCotador.js.php"></script> 
