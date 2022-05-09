<?php
include "../../inc/conexao.php";
include "../../inc/header.php";
?>

<main class="container-fluid">
	<div class="bg-light p-5"> 
		<h1 class="mt-4">Controle Recebimento | Vendedores Internos</h1>
			<form action="#" method="post" id="frmPesquisar" name="frmPesquisar" onSubmit="return processaPesquisa()" >
				<div class="row mt-4">
					<div class="col-12 col-sm-12 col-md-6 col-lg-4">
						<label for="cboVendedor">Vendedor:</label>
						<select class="form-control form-control-sm" id="cboVendedor" name="cboVendedor">
							<?php
								$qsql = "Select id, corretor from corretores where id_perfil = 2";
								if($rs=mysqli_query($conn,$qsql)){
									echo "<option value=0>Todos</option>";
									while($reg=mysqli_fetch_array($rs)){
										echo "<option value =".$reg['id'].">".$reg['corretor']."</option>";
									}
								}
							?>
						</select>						
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-2">
						<label for="cboMes">Mês:</label>
                       <?php
					    $mesNome=array('01'=>'jan','02'=>'fev','03'=>'mar','04'=>'abr','05'=>'mai','06'=>'jun','07'=>'jul','08'=>'ago','09'=>'set','10'=>'out','11'=>'nov','12'=>'dez');	  
						$data = date('Y-m-d', strtotime("+30 days"));
						$mes = $mesNome[date('m',strtotime($data))];	
						$ano = date('Y',strtotime($data));
						$data_fim = date('Y-m-d', strtotime('2022-01-01'));			
		  ?>
      		<select class="form-control" id="cboMes" name="cboMes">
	  		<option value="0">TODOS</option>
	  		<?php 
			$list = 0;
			while ($data > $data_fim){
			  if ($list == 1){
				  echo "<option value=".$mes."/".$ano." selected >".$mes."/".$ano."</option>";			
				  $data = date('Y-m-d', strtotime("-25 days",strtotime($data)));
				  $mes = $mesNome[date("m", strtotime($data))];	
				  $ano = date("Y",strtotime($data));	
				  $list = $list + 1;
			  }else{	
				  echo "<option value=".$mes."/".$ano.">".$mes."/".$ano."</option>";			
				  $data = date('Y-m-d', strtotime("-25 days",strtotime($data)));
				  $mes = $mesNome[date("m", strtotime($data))];	
				  $ano = date("Y",strtotime($data));	
				  $list = $list + 1;
			}
		}
	  	?>
      	</select>
						
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-4">
						<label for="txtCliente">Cliente:</label>
						<input class="form-control form-control-sm" type="text" id="txtCliente" name="txtCliente">
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-2">
						<label for="txtValor">Valor:</label>
						<input class="form-control form-control-sm" type="text" id="txtValor" name="txtValor">
					</div>					
				</div>
				<div class="row my-3">
					<div class="col-12 col-sm-12 col-md-6 col-lg-3">
						<label for="cboTipoPagto">Tipo Pagamento:</label>
						<select class="form-control form-control-sm" id="cboTipoPagto" name="cboTipoPagto">
						  	<option value=0>Todos</option>
							<option value=1>Não Definido</option>
							<option value=2>PIX/Transferência</option>
							<option value=3>Boleto Pilon</option>
							<option value=4>Boleto Operadora</option>
							
						</select>						
					</div>	
					<div class="col-12 col-sm-12 col-md-6 col-lg-3">
						<label for="cboComprovante">Comprovante de Pagto:</label>
						<select class="form-control form-control-sm" id="cboComprovante" name="cboComprovante">
						  	<option value=0>Todos</option>
							<option value=1>Pendente</option>
							<option value=2>Recebido</option>
						</select>						
					</div>	
					<div class="col-12 col-sm-12 col-md-6 col-lg-3">
						<label for="cboExtrato">Extrato:</label>
						<select class="form-control form-control-sm" id="cboExtrato" name="cboExtrato">
						  	<option value=0>Todos</option>
							<option value=1>Pendente</option>
							<option value=2>Lançado</option>
						</select>						
					</div>	
					<div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3 d-flex justify-content-center">
						<input type="submit" form="frmPesquisar" id="pesquisar" name="pesquisar" value="Pesquisar" class="btn btn-lg btn-secondary">
					</div>
				</div>
			</form>
		<hr class="my-4">

		<div id="listagem"></div>
    </div>
</main>

<?php
include "../../inc/footer.php";
?>
<script src="../../js/pag/jsVendaInterna.js.php"></script> 