<?php
include "../../inc/conexao.php";
include "../../inc/header.php";
?>
 <!--------------------- aqui começa a página----------------->
 <main class="container-fluid"> 

     <div class="bg-light p-5">
        <h1>Cadastro de Vendas Novas</h1>
    <form class="needs-validation" novalidate method="post" action="" name="frmCadastro" id = "frmCadastro" onSubmit="return processaInclusao()">
        <div class="container">
            <div class="container-sm conteudo">
            <div class="row">
                <div class="col-sm-3">
                    Corretora: 
                    <select class="form-select form-control form-control-sm" aria-label="Corretora" id="cboCorretora" name="cboCorretora" required>
                      <option selected></option>
                      <?php 
                        $qsql = "select id,nomeAbrev from corretora where situacao = 1";
                        if($rs=mysqli_query($conn,$qsql)){
                            while($reg=mysqli_fetch_array($rs)){
                                echo "<option value=".$reg['id'].">".$reg['nomeAbrev']."</option>";
                            }
                        }
                        ?>
                    </select>  
                    <div class="invalid-feedback">
                          Selecione uma corretora.
                    </div> 
                </div>

                <div class="col-sm-6">
                    Vendedor:
                    <select class="form-select form-control form-control-sm" aria-label="Corretor" id="cboCorretor" name="cboCorretor" required>
                      <option selected></option>
                    </select>
                    <div class="invalid-feedback">
                          Selecione um corretor.
                    </div>                     
                </div>
                <div class="col-sm-3">
                    <span id="NumIndicacao">Núm.Indicação:</span>
                    <input class="form-control form-control-sm" type="text" id="txtNumIndicacao" name="txtNumIndicacao" onKeyPress="return teclas(event)" value="0" disabled>
                    <div class="invalid-feedback">
                          O número da indicação é obrigatório.
                    </div> 
                </div>                
            </div>
            <div class="row">
                <div class="col-sm-2">
                    Tipo: 
                    <select class="form-select form-control form-control-sm" aria-label="Tipo Plano" id="cboTipoPlano" name="cboTipoPlano" required>
                      <option selected></option>
                      <option value="PF">PF</option>
                      <option value="PJ">PJ</option>    
                    </select>
                    <div class="invalid-feedback">
                          Selecione um tipo do contrato.
                    </div> 
                </div>
                <div class="col-sm-6">
                    <span id="nomeTitular">Nome Titular:</span>
                    <input class="form-control form-control-sm" type="text" id="txtNome" name="txtNome" required>
                    <div class="invalid-feedback">
                          Nome titular/Razão Social é obrigatório.
                    </div> 
                </div>
               
                <div class="col-sm-4">
                    <span id="cpf">CPF:</span>
                    <input class="form-control form-control-sm" type="text" id="txtCPF" name="txtCPF" required onChange="validaCPF('txtCPF')" onKeyPress="return teclas(event)">
                    <div class="invalid-feedback">
                          CPF/CNPJ é obrigatório.
                    </div> 
                </div>                 
            </div>             
            <div class="row">
                <div class="col-sm-4">
                    Mês: 
                    <select class="form-select form-control form-control-sm" aria-label="Mês" id="cboMes" name="cboMes" required>
                        <?php
                            $nomeMes=[1 =>'Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
  
                            $dataMais = date("d/n/Y",
                                    mktime(
                                    date("H"),
                                    date("i"),
                                    date("s"),
                                    date("n")+1,
                                    date("d"),
                                    date("Y")
                                    )
                                );
                            $dataMenos = date("d/n/Y",
                                    mktime(
                                    date("H"),
                                    date("i"),
                                    date("s"),
                                    date("n")-1,
                                    date("d"),
                                    date("Y")
                                    )
                                );
                             $data = date("d/n/Y",
                                    mktime(
                                    date("H"),
                                    date("i"),
                                    date("s"),
                                    date("n"),
                                    date("d"),
                                    date("Y")
                                    )
                                );           
                         // Explode a barra e retorna três arrays
                            $data = explode("/", $data);
                            $dataMais  = explode("/", $dataMais);
                            $dataMenos = explode("/", $dataMenos);
                        // Cria três variáveis $dia $mes $ano
                            list($dia, $mes, $ano) = $data;
                            list($diaMais, $mesMais, $anoMais) = $dataMais;
                            list($diaMenos, $mesMenos, $anoMenos) = $dataMenos;
                            $mesLiteral = $nomeMes[$mes];
                            $mesLiteralMenos = $nomeMes[$mesMenos];
                            $mesLiteralMais =$nomeMes[$mesMais];

                        if($dia>=21){
                                echo "<option selected>$mesLiteralMais/$anoMais</option>
                                      <option>$mesLiteral/$ano</option>  
                                      <option>$mesLiteralMenos/$anoMenos</option>";
                                 
                             }else{
                                 
                                 echo "<option>$mesLiteralMais/$anoMais</option>
                                       <option selected>$mesLiteral/$ano</option>
                                       <option>$mesLiteralMenos/$anoMenos</option>";
                             }
                        ?>  
                    </select>                     
                    <div class="invalid-feedback">
                          Selecione um mês.
                    </div> 
                </div>
                <div class="col-sm-4">
                    Vigência:
                    <input class="form-control form-control-sm" type="date" id="txtVigencia" name="txtVigencia" required>
                    <div class="invalid-feedback">
                          Informe a vigência do contrato.
                    </div> 
                </div>
                <div class="col-sm-4">
                    Dia de Vencimento:
                    <input class="form-control form-control-sm" type="number" id="txtVencimento" name="txtVencimento" max="31" min="0" step="1" required>
                    <div class="invalid-feedback">
                          Informe o dia de vencimento.
                    </div> 
                </div>            
            </div> 
            <div class="row">
                <div class="col-sm-4">
                    Contrato: 
                    <input class="form-control form-control-sm" type="text" id="txtContrato" name="txtContrato" required>                     
                    <div class="invalid-feedback">
                          Informe o número do contrato/proposta.
                    </div> 
                </div>
                <div class="col-sm-4">
                    Operadora:
                    <select class="form-select form-control form-control-sm" aria-label="Operadora" id="cboOperadora" name="cboOperadora" required>
                      <option>Selecione o tipo de plano primeiro...</option>   
                    </select>
                    <div class="invalid-feedback">
                          Selecione uma operadora.
                    </div> 
                </div>
                <div class="col-sm-4">
                    Plano: 
                    <select class="form-select form-control form-control-sm" aria-label="Plano" id="cboPlano" name="cboPlano">
                      <option>Selecione a operadora primeiro...</option>   
                    </select>  
                    <div class="invalid-feedback">
                          Selecione um plano.
                    </div> 
                </div>                
            </div>    
            <div class="row">
                <div class="col-sm-4">
                    Núm.Vidas:
                    <input class="form-control form-control-sm" type="number" id="txtNumVidas" name="txtNumVidas" max="9999" min="0" step="1" required>
                    <div class="invalid-feedback">
                          Informe o número de vidas do contrato.
                    </div> 
                </div>                 
                <div class="col-sm-4">
                    Valor:
                    <input class="form-control form-control-sm" type="text" id="txtValor" name="txtValor" required onKeyPress="return teclas(event)">
                    <div class="invalid-feedback">
                          Informe o valor.
                    </div> 
                </div> 
                <div class="col-sm-4">
                    Entidade:
                    <input class="form-control form-control-sm" type="text" id="txtEntidade" name="txtEntidade" required>
                    <div class="invalid-feedback">
                          Se não for adesão colocar PF ou PJ.
                    </div> 
                </div>                 
            </div>    
            <hr>
            <div class="row">
                <div class="col-sm-2">
                    Cep:
                    <input class="form-control form-control-sm" type="number" id="txtCep" name="txtCep" required>
                    <div class="invalid-feedback">
                          Cep é obrigatório.
                    </div> 
                </div>
                <div class="col-sm-4">
                    Endereço:
                    <input class="form-control form-control-sm" type="text" id="txtEndereco" name="txtEndereco" required>
                    <div class="invalid-feedback">
                          Informe o endereço.
                    </div> 
                </div>
                <div class="col-sm-2">
                    Número:
                    <input class="form-control form-control-sm" type="number" id="txtNumero" name="txtNumero" min="0" step="1">
                </div> 
                <div class="col-sm-4">
                    Complemento:
                    <input class="form-control form-control-sm" type="text" id="txtComplemento" name="txtComplemento">
                </div>                 
            </div> 
            <div class="row">
                <div class="col-sm-4">
                    Bairro: 
                    <input class="form-control form-control-sm" type="text" id="txtBairro" name="txtBairro" required>
                    <div class="invalid-feedback">
                          Informe o bairro.
                    </div> 
                </div>
                <div class="col-sm-4">
                    Cidade:
                    <input class="form-control form-control-sm" type="text" id="txtCidade" name="txtCidade" required>
                    <div class="invalid-feedback">
                          Informe a cidade.
                    </div> 
                </div>
                <div class="col-sm-2">
                    UF:
                    <input class="form-control form-control-sm" type="text" id="txtUF" name="txtUF" required>
                    <div class="invalid-feedback">
                          Informe o estado.
                    </div> 
                </div>                 
            </div>   
            <div class="row">
                <div class="col-sm-4">
                    Telefone 1:
                    <input class="form-control form-control-sm" type="text" id="txtTelefone1" name="txtTelefone1" required onKeyPress="return teclas(event)">
                    <div class="invalid-feedback">
                          Obrigatório um telefone válido.
                    </div> 
                </div>
                <div class="col-sm-4">
                    Telefone 2:
                    <input class="form-control form-control-sm" type="text" id="txtTelefone2" name="txtTelefone2" onKeyPress="return teclas(event)">                    
                </div>
                <div class="col-sm-4">
                    E-mail:
                    <input class="form-control form-control-sm" type="email" id="txtEmail" name="txtEmail" required>
                    <div class="invalid-feedback">
                          Obrigatório um e-mail válido.
                    </div> 
                </div>                 
            </div>  
            <hr>
            <div class="row">
                <div class="col-sm-2">
                    Tipo:
                    <select class="form-select form-control form-control-sm" aria-label="Tipo Beneficiário" id="cboTipoBeneficiario" name="cboTipoBeneficiario">
                      <option value = 0 selected>Titular</option>
                      <option value = 1>Dependente</option>
                      <option value = 2>Responsável Legal</option>    
                    </select>                     
                    
                </div>
                <div class="col-sm-6">
                    Nome:
                    <input class="form-control form-control-sm" type="text" id="txtTitularNome" name="txtTitularNome" value="" required>
                    <div class="invalid-feedback">
                          Nome é obrigatório.
                    </div> 
                </div>
                <div class="col-sm-2">
                    Data Nascimento:
                    <input class="form-control form-control-sm" type="date" id="txtDtNascimento" name="txtDtNascimento" required>
                    <div class="invalid-feedback">
                          Informe a data de nascimento.
                    </div> 
                </div>
                <div class="col-sm-2">
                    Sexo:
                    <select class="form-select form-control form-control-sm" aria-label="Sexo" id="cboSexo" name="cboSexo">
                      <option selected></option>
                      <option value = "M">Masc</option>
                      <option value = "F">Fem</option>    
                    </select>                     
                    
                </div>                
            </div>
            <div class="row">
                <div class="col-sm-6">
                    RG:
                    <input class="form-control form-control-sm" type="text" id="txtRG" name="txtRG">                    
                </div>
                <div class="col-sm-6">
                    CPF:
                    <input class="form-control form-control-sm" type="text" id="txtCPFtitular" name="txtCPFtitular" value="" required onChange="validaCPF('txtCPFtitular')" onKeyPress="return teclas(event)">
                    <div class="invalid-feedback">
                          CPF é obrigatório.
                    </div> 
                </div>
            </div>  
            <div class="row">
                <div class="col-sm-4">
                    Telefone 1:
                    <input class="form-control form-control-sm" type="text" id="txtTelefone1Titular" name="txtTelefone1Titular" required onKeyPress="return teclas(event)">
                    <div class="invalid-feedback">
                          Telefone obrigatório.
                    </div> 
                </div>
                <div class="col-sm-4">
                    Telefone 2:
                    <input class="form-control form-control-sm" type="text" id="txtTelefone2Titular" name="txtTelefone2Titular" onKeyPress="return teclas(event)">                    
                </div>
                <div class="col-sm-4">
                    E-mail:
                    <input class="form-control form-control-sm" type="email" id="txtEmailTitular" name="txtEmailTitular" required>
                    <div class="invalid-feedback">
                          E-mail é obrigatório.
                    </div> 
                </div>                
            </div>              
        </div> 
            <p>&nbsp;</p>
            <button class="btn btn-primary" type="submit" name="salvar" id="salvar">Salvar</button>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDependente" disabled id="dependente" name="dependente">
			  Incluir Dependente
			</button>
         
    </form>         
         
        </div>  
		 <div id="listagem"></div>
   


<!-- Modal -->
<div class="modal fade" id="modalDependente" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalDependenteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Inclusão de Dependentes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form>
			  <div class="row">
				   <div class="col-sm-4">
						Tipo:
						<select class="form-select form-control form-control-sm" aria-label="Sexo" id="cboDepTipo" name="cboDepTipo" >
						  <option value = "0">Titular</option>
						  <option value = "1" selected>Dependente</option>    
						</select>                     
					</div>  
		  			<div class="col-sm-4">
						Nome:
						<input class="form-control form-control-sm" type="text" id="depNome" name="depNome" required>
						<div class="invalid-feedback">
							  Nome é obrigatório.
						</div> 
				   </div>
				   <div class="col-sm-2">
						Sexo:
						<select class="form-select form-control form-control-sm" aria-label="Sexo" id="depSexo" name="depSexo">
						  <option selected></option>
						  <option value = "M">Masc</option>
						  <option value = "F">Fem</option>    
						</select>                     

                </div>  
                <div class="col-sm-2">
                    Data Nascimento:
                    <input class="form-control form-control-sm" type="date" id="depDtNascimento" name="depDtNascimento" required>
                    <div class="invalid-feedback">
                          Informe a data de nascimento.
                    </div> 
                </div>	
			</div>
			  <div class="row">
                <div class="col-sm-4">
                    RG:
                    <input class="form-control form-control-sm" type="text" id="depRG" name="depRG">                    
                </div>
                <div class="col-sm-4">
                    CPF:
                    <input class="form-control form-control-sm" type="text" id="depCPF" name="depCPF" value="" required onChange="validaCPF('depCPF')" onKeyPress="return teclas(event)">
                    <div class="invalid-feedback">
                          CPF é obrigatório.
                    </div> 
                </div>
                <div class="col-sm-4">
                    E-mail:
                    <input class="form-control form-control-sm" type="email" id="depEmail" name="depEmail" required>
                    <div class="invalid-feedback">
                          E-mail é obrigatório.
                    </div> 
                </div>    
			  </div>
			  <div class="row">
				<div class="col-sm-12">
					<input type="text" id="idBeneficiario">
					<input type="text" id="idVenda">
				
				</div>
			  </div>
		  </form>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
</div>
</div>
 </main>
     
    <?php
include "../../inc/footer.php";

?>
<script src="../../js/pag/jsCadastro.js.php"></script> 
