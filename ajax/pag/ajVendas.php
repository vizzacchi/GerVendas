<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

if(!empty($_POST['cliente'])){
    $cliente = "nome like '".$_POST['cliente']."%'";
}else{
    $cliente = "nome like '%' ";
}
if(!empty($_POST['mes']) and $_POST['mes']<>'0'){
    $mes = "and mes = '".$_POST['mes']."'";
}else{
	
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
			$mes = " and mes = '".$mesLiteralMais."/".$anoMais."'";

		 }else{
			$mes = " and mes = '".$mesLiteral."/".$ano."'";
		 }
	}
if(!empty($_POST['tipo']) and $_POST['tipo']<>'0'){
    $tipo = "and tipo_plano = '".$_POST['tipo']."'";
}
else{
    $tipo = "";
}
if(!empty($_POST['operadora']) and $_POST['operadora']<>'0'){
    $operadora  = "and cod_operadora = '".$_POST['operadora']."'";
}else{
    $operadora = "";
}
if(!empty($_POST['corretora']) and $_POST['corretora']<>'0'){
    $corretora = "and corretora = '".$_POST['corretora']."'";
}else{
    $corretora = "";
}
if(!empty($_POST['vendedor']) and $_POST['vendedor']<>'0'){
    $vendedor = "and cod_vendedor = '".$_POST['vendedor']."'";
}else{
    if ($_SESSION['perfil']<=1){
        $vendedor="";   
    }else{
        
		$cpf = $_SESSION['cpf'];
		$qsql = "SELECT id, corretor from corretores where cpf = $cpf ";
		if($rs=mysqli_query($conn,$qsql)){
			$reg=mysqli_fetch_array($rs);
			$vendedor = "and cod_vendedor = '".$reg['id']."'";
		}
		
    }
}
if($cliente == "" and $mes == "" and $tipo == "" and $operadora=="" and $corretora=="" and $vendedor == ""){
    $condicao = 1;
}else{
    $condicao = "";
}
$qsql = "SELECT venda.dataVenda, venda.id as idVenda, venda.mes, venda.nome, venda.tipoPlano, venda.cod_operadora, venda.cod_plano, venda.valor, venda.numVidas, venda.cod_vendedor, venda.contrato, venda.vigencia, venda.situacao, operadora.nome_abrev, planos.plano, corretores.corretor  FROM `venda`, `operadora`, `planos`, `corretores` 
	WHERE venda.cod_operadora = operadora.id and
	      venda.cod_plano     = planos.id and 
		  venda.cod_vendedor  = corretores.id and
		  $cliente $mes $tipo $operadora $corretora $vendedor $condicao order by venda.dataVenda desc";

if($rs=mysqli_query($conn,$qsql)){
    ?>

    <div class="table-responsive-sm">
        <button type="button" class="btn btn-outline-success btn-sm" onclick="ExportToExcel('xlsx')" style="margin-bottom: 10px"><i class="bi-file-earmark-excel"></i> Exporta para Excell</button>
          <table class="table table-striped table-sm tablesorter" id="tbVendas">
            <thead>
                <tr>
                    <th scope="col" style="font-size: 0.8rem">Cadastro</th>
					<th scope="col" style="font-size: 0.8rem">Mes</th>
                    <th scope="col" style="font-size: 0.8rem">Contrato</th>
					<th scope="col" style="font-size: 0.8rem">Nome Cliente</th>
                    <th scope="col" style="font-size: 0.8rem">Tipo</th>
                    <th scope="col" style="font-size: 0.8rem">Operadora</th>
                    <th scope="col" style="font-size: 0.8rem">Plano</th>
                    <th scope="col" style="font-size: 0.8rem">Vidas</th>
                    <th scope="col" style="font-size: 0.8rem">Valor</th>
                    <th scope="col" style="font-size: 0.8rem">Nome Vendedor</th>
                    <th scope="col" style="font-size: 0.8rem">Vigência</th>
                    <th scope="col" style="font-size: 0.8rem"><i class="bi bi-plus-square"></i></th>
					<th scope="col" style="font-size: 0.8rem"><i class="bi bi-check-all"></i></th>
					<th scope="col" style="font-size: 0.8rem"><i class="bi bi-trash"></i></th>
                </tr>    
            </thead>
            <tbody>
    <?php
    while($reg=mysqli_fetch_array($rs)){?>
        <tr id="<?php echo $reg['idVenda'];?>"
			<?php
				if($reg['situacao']==2){?>
					style="color: green"
				<?php	
				}elseif($reg['situacao']==3){?>
					style="color: red"
				<?php
				}
				
				?>>
			<td style="font-size: 0.7rem"><?php echo date("d/m/Y",strtotime($reg['dataVenda']));?></td>
            <td style="font-size: 0.7rem"><?php echo $reg['mes'];?></td>
			<td style="font-size: 0.7rem"><?php echo $reg['contrato'];?></td>
            <td style="font-size: 0.7rem"><?php echo $reg['nome'];?></td>
            <td style="font-size: 0.7rem"><?php echo $reg['tipoPlano'];?></td>
            <td style="font-size: 0.7rem"><?php echo $reg['nome_abrev'];?></td>
            <td style="font-size: 0.7rem"><?php echo ucfirst($reg['plano']);?></td>
            <td style="font-size: 0.7rem"><?php echo $reg['numVidas'];?></td>
            <td style="font-size: 0.7rem"><?php echo number_format($reg['valor'], 2, ',', '.');?></td>
            <td style="font-size: 0.7rem"><?php echo $reg['corretor'];?></td>
            <td style="font-size: 0.7rem"><?php echo date("d/m/Y",strtotime($reg['vigencia']));?></td>
            <td style="font-size: 0.7rem"><i class="bi bi-plus-square" type="button" data-toggle="modal" data-target="#vendaModal" onClick="vendasDetalhe(<?php echo $reg['idVenda'];?>)"></td>
			<td style="font-size: 0.7rem"><i class="bi bi-check-all" type="button" onClick="emite(<?php echo $reg['idVenda']; ?>)"></i></td>
			<td style="font-size: 0.7rem"><i class="bi bi-trash" type="button" onClick="cancela(<?php echo $reg['idVenda']; ?>)"></i></td>
        </tr>        
    <?php    
    }?>
            <tbody>
        </table>
    </div>
	<div class="resumo">
		<h2>Resumo Vendas por Vendedor</h2>
		<table class="table table-sm table-striped tabelaVendas">
			<thead>
				<th scope="col">Vendedor</th>
				<th scope="col">Tipo</th>
				<th scope="col">Vidas</th>
				<th scope="col">Valor</th>
			</thead>
			<tbody>
<?php
$qsqlSum = "SELECT SUM(venda.valor) as soma, SUM(venda.numVidas) as vidas, corretores.corretor, planos.tipo_plano  FROM `venda`, `operadora`, `planos`, `corretores` 
	WHERE venda.cod_operadora = operadora.id and
	      venda.cod_plano     = planos.id and 
		  venda.cod_vendedor  = corretores.id and
		  venda.situacao      <> 3 and
		  $cliente $mes $tipo $operadora $corretora $vendedor $condicao 
		  Group BY planos.tipo_plano, venda.cod_vendedor order by venda.cod_vendedor";
		if($rs=mysqli_query($conn,$qsqlSum)){
			$totalVidas = 0;
			$totalValor = 0;
			while($reg=mysqli_fetch_array($rs)){
				$totalVidas = $totalVidas + $reg['vidas'];
				$totalValor = $totalValor + $reg['soma'];?>
				<tr>
					<td><?php echo $reg['corretor'];?></td>
					<td><?php echo $reg['tipo_plano'];?></td>
					<td><?php echo $reg['vidas'];?></td>
					<td><?php echo number_format($reg['soma'],2, ',', '.');?></td>
				</tr>
			<?php	
			}?>
				<tr>
					<th colspan="2" style="text-align: end">TOTAL</th>
					<th><?php echo $totalVidas; ?></th>
					<th><?php echo number_format($totalValor,2,',','.'); ?></th>
				</tr>
	<?php		
		}
?>
			
			</tbody>
		</table>
		<h2>Resumo Vendas por Corretora</h2>
		<table class="table table-sm table-striped tabelaVendas">
			<thead>
				<th scope="col">Corretora</th>
				<th scope="col">Tipo</th>
				<th scope="col">Vidas</th>
				<th scope="col">Valor</th>
			</thead>
			<tbody>
<?php
$qsqlSum = "SELECT SUM(venda.valor) as soma, SUM(venda.numVidas) as vidas, corretores.id_corretora, planos.tipo_plano  FROM `venda`, `operadora`, `planos`, `corretores` 
	WHERE venda.cod_operadora = operadora.id and
	      venda.cod_plano     = planos.id and 
		  venda.cod_vendedor  = corretores.id and
		  venda.situacao      <> 3 and
		  $cliente $mes $tipo $operadora $corretora $vendedor $condicao 
		  Group BY planos.tipo_plano, corretores.id_corretora order by corretores.id_corretora";
		if($rs=mysqli_query($conn,$qsqlSum)){
			while($reg=mysqli_fetch_array($rs)){?>
				<tr>
					<?php
					$corretora2 = $reg['id_corretora'];
					$qsqlCorretora = "Select nomeAbrev from corretora where id = $corretora2 ";
				    if($rsCorretora = mysqli_query($conn,$qsqlCorretora)){
						$regCorretora=mysqli_fetch_array($rsCorretora);
						$corretora2 = $regCorretora['nomeAbrev'];
					}
												
					?>
					<td><?php echo $corretora2;?></td>
					<td><?php echo $reg['tipo_plano'];?></td>
					<td><?php echo $reg['vidas'];?></td>
					<td><?php echo number_format($reg['soma'],2, ',', '.');?></td>
				</tr>
			<?php	
			}
		}
?>
			
			</tbody>
		</table>
		<h2>Resumo Vendas por Tipo</h2>
		<table class="table table-sm table-striped tabelaVendas">
			<thead>
				<th scope="col">Tipo</th>
				<th scope="col">Vidas</th>
				<th scope="col">Valor</th>
			</thead>
			<tbody>
<?php
$qsqlSum = "SELECT SUM(venda.valor) as soma, SUM(venda.numVidas) as vidas, planos.tipo_plano  FROM `venda`, `operadora`, `planos`, `corretores` 
	WHERE venda.cod_operadora = operadora.id and
	      venda.cod_plano     = planos.id and 
		  venda.cod_vendedor  = corretores.id and
		  venda.situacao      <> 3 and
		  $cliente $mes $tipo $operadora $corretora $vendedor $condicao 
		  Group BY planos.tipo_plano order by planos.tipo_plano";

		if($rs=mysqli_query($conn,$qsqlSum)){
			while($reg=mysqli_fetch_array($rs)){?>
				<tr>
					<td><?php echo $reg['tipo_plano'];?></td>
					<td><?php echo $reg['vidas'];?></td>
					<td><?php echo number_format($reg['soma'],2, ',', '.');?></td>
				</tr>
			<?php	
			}
		}
?>
			
			</tbody>
		</table>		
		
		
	</div>




<?php
}?>

<!-- Modal Inclusão-->
<div class="modal fade" id="vendaModal" tabindex="-1" aria-labelledby="vendaModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="vendaModalLabel">Detalhes da Venda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="vendasDetalhes"></div>
          
          <div class="modal-footer" >
            <button type="button" id="fechar" name="fechar" class="btn btn-primary" data-dismiss="modal">Fechar</button>
          </div>
      </div>  
    </div>
  </div>
</div>
<!---- Fim Modal Inclusão--------->

    <script>
        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('tbVendas');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || ('Vendas.' + (type || 'xlsx')));
        }
    </script>
    <script src="../../js/pag/jsVendasDetalhe.js.php"></script>
    <script src="../../js/jquery-3.5.1.min.js"></script> 
    <script src="../../js/jquery.tablesorter.min.js"></script> 
    <script src="../../js/scripts.js"></script>
