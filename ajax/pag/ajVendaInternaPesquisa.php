<?php
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";
if($_POST['cboVendedor'] and $_POST['cboVendedor']<>0){
	$vendedor = $_POST['cboVendedor'];
	$vendedor = " and venda.cod_vendedor = $vendedor";
}else{
	$vendedor = " and corretores.id_perfil = 2 ";
}
if($_POST['cboMes'] and $_POST['cboMes']<>0){
	$mes = $_POST['cboMes'];
	$mes 	= " and venda.mes = '$mes'";
}else{
	$mes = "";
}
if($_POST['txtCliente'] and $_POST['txtCliente']<>""){
	$cliente = $_POST['txtCliente']."%";
	$cliente 	= " and venda.nome like '$cliente'";
}else{
	$cliente = "";
}
if($_POST['txtValor'] and $_POST['txtValor']<>""){
	$valor = number_format($_POST['txtValor'], 2, ',', '.');
	$valor 	= " and venda.valor = '$valor'";
}else{
	$valor = "";
}
if($_POST['cboTipoPagto'] and $_POST['cboTipoPagto']<>0){
	$tipoPagto= $_POST['cboTipoPagto'];
	$tipoPagto 	= " and venda.tipoPagto = '$tipoPagto'";
}else{
	$tipoPagto= "";
}
if($_POST['cboComprovante'] and $_POST['cboComprovante']<>0){
	$comprovante = $_POST['cboComprovante'];
	$comprovante 	= " and venda.comprovante = '$comprovante'";
}else{
	$comprovante = "";
}
if($_POST['cboExtrato'] and $_POST['cboExtrato']<>0){
	$extrato = $_POST['cboExtrato'];
	$extrato 	= " and venda.extrato = '$extrato'";
}else{
	$extrato = "";
}

$qsql = "Select venda.id, venda.dataVenda, venda.cod_vendedor, corretor, venda.contrato, venda.nome, venda.cod_operadora, nome_abrev,  venda.tipoPlano, venda.valor, venda.tipoPagto, venda.comprovante, venda.extrato, venda.dtExtrato from venda, operadora, corretores where venda.cod_operadora = operadora.id and venda.cod_vendedor = corretores.id $vendedor $mes $cliente $valor $tipoPagto $comprovante $extrato order by corretores.corretor, venda.dataVenda";

if($rs=mysqli_query($conn,$qsql)){?>
		<table class="table table-striped table-hover table-sm my-4">
		  <thead>
			<tr>
				<th scope="col">Data</th>
				<th scope="col">Vendedor</th>
				<th scope="col">Contrato</th>
				<th scope="col">Cliente</th>
				<th scope="col">Operadora</th>
				<th scope="col">Tipo</th>
				<th scope="col">Valor</th>
				<th scope="col">Tipo Pagto</th>
				<th scope="col">Comprovante</th>
				<th scope="col">Extrato</th>
				<th scope="col">Data</th>
			</tr>
		  </thead>
		  <tbody>
	<?php
			while($reg=mysqli_fetch_array($rs)){?>
			 <tr>
			  <td style="font-size: 0.7rem"><?php echo $reg['dataVenda']; ?></td>
			  <td style="font-size: 0.7rem"><?php echo $reg['corretor']; ?></td>
			  <td style="font-size: 0.7rem"><?php echo $reg['contrato']; ?></td>
			  <td style="font-size: 0.7rem"><?php echo $reg['nome']; ?></td>
			  <td style="font-size: 0.7rem"><?php echo $reg['nome_abrev']; ?></td>
			  <td style="font-size: 0.7rem"><?php echo $reg['tipoPlano']; ?></td>
			  <td style="font-size: 0.7rem"><?php echo number_format($reg['valor'],2,',','.'); ?></td>
			  <td style="font-size: 0.7rem"><?php 
						if($reg['tipoPagto']==1){?>
				  			<select class="form-control form-control-sm" id="cboTipo" name="cboTipo" onChange="tipoPagto()" >
								<option value=2>PIX/Transferência</option>
								<option value=3>Boleto Pilon</option>
								<option value=4>Boleto Operadora</option>
							</select>
					<?php		
						}elseif($reg['tipoPagto']==2){
							echo "Pix/Transferência";
						}elseif($reg['tipoPagto']==3){
							echo "Boleto Pilon";
						}elseif($reg['tipoPagto']==4){
							echo "Boleto Operadora";
						}						
						 ?></td>
			  <td style="font-size: 0.7rem"><?php 
						if($reg['comprovante']==1){?>
				  			<select class="form-control form-control-sm" id="cboCompr" name="cboCompr" onChange="Comprovante()">
								<option value=1>Pendente</option>
								<option value=2>Recebido</option>
							</select>
						<?php
				  		}else{
							echo "Recebido";
						} ?></td>
			  <td style="font-size: 0.7rem"><?php
						if($reg['extrato']==1){?>
				  			<select class="form-control form-control-sm" id="cboExtr" name="cboCompr" onChange="Extrato()">
								<option value=1>Pendente</option>
								<option value=2>Lançado</option>
							</select>
						<?php
						}else{
							echo "Lançado";
						}
						 ?></td>
			  <td style="font-size: 0.7rem"><?php
						if($reg['dtExtrato']=="0000-00-00"){?>
							<input type="date" id="dtLancado" name="dtLancado" disabled  onChange="dtExtrato()">
						<?php	
						}else{
							echo $reg['dtExtrato'];
						}?></td>
			</tr>
			<?php
		}?>
		  </tbody>
	</table>
<?php
	
}else{
	echo "Não foi possivel localizar nenhuma venda!";
}
?>
	

