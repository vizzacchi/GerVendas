<form id='cotacao' name ='cotacao' action="../../pag/Cotador/cotacao.php" method="post" target="new">

<?php 

include "../../inc/conexao.php";

	
$tipoPlano 		= $_POST['cboTipoPlano'];
$nomeCliente 	= $_POST['txtNomeCliente'];
$contratacao	= $_POST['cboContratacao'];
$profissao		= $_POST['cboProfissao'];
$numTitulares	= $_POST['cboNumTitular'];
$acomodacao		= $_POST['cboAcomodacao'];
$coparticipacao = $_POST['cboCoparticipacao'];
if(isset($_POST['empIndividual'])){
	$individual     = $_POST['empIndividual'] ;
}else{
	$individual = 0;
}

$parametros = $profissao."#".$contratacao."#".$numTitulares."#".$nomeCliente."#".$tipoPlano."#".$individual;


if($acomodacao == 'Ambos'){
	$cond_acomodacao ="";
}else{
	$cond_acomodacao = " and planos.acomodacao = '$acomodacao'";
}
if($coparticipacao == 2){
	$cond_coparticipacao="";
}else{
	$cond_coparticipacao = " and planos.coparticipacao = $coparticipacao";
}

$qsql = "select DISTINCT oper, cod FROM ( 
		 SELECT operadora.nome_abrev as oper, operadora.id as cod, planos.plano 
		 FROM planos, operadora
		 WHERE planos.cod_oper = operadora.id AND 
		 	   planos.tipo_plano = '$tipoPlano' 	   
			   						$cond_acomodacao     
									$cond_coparticipacao
		ORDER BY planos.cod_oper) as teste";

if($rd = mysqli_query($conn,$qsql)){ ?>
	<div class="container">
	  <div class="row">
<?php
	while($reg=mysqli_fetch_assoc($rd)){ ?>

		<div class="col-md-3"> 
			<div class="form-check" style="margin-top: 30px">
		 		 <p>
				<?php 
					$codigoOperadora = $reg['cod'];
					$nomeOperadora   = $reg['oper'];
					echo "<img src='../../img/logos/".$nomeOperadora.".png' alt='".$nomeOperadora."' style='height:80px'/>" ?> </p>
				<?php
						
                $qsqlPlano = "Select planos.plano, planos.id, planos.cod_oper
				 				from planos
								where planos.cod_oper       = $codigoOperadora  and
									  planos.tipo_plano     = '$tipoPlano' 	 
									  $cond_acomodacao     									$cond_coparticipacao";
					
					if ($rdPlano = mysqli_query($conn,$qsqlPlano)){
						echo "<p style='font-size:small'>Escolha os planos:</p>";
						while($regPlano=mysqli_fetch_assoc($rdPlano)){ 
							$plano = $regPlano['id'];
							$operadora = $regPlano['cod_oper'];
														?>
							<div class="form-check">
							<?php
							echo "<input class='form-check-input' type='checkbox' value='$plano' id='p$plano' name='plano$plano' >";
							
								 echo "<span style='font-size:small' >".ucfirst($regPlano['plano'])."</span>"; ?> <br> 
						   <?php echo "<div id='plano".$plano."' >"; 
									
							echo	'</div>' ?>
							</div>
					<?php	}
					}					
				 ?>
			</div>
			
		</div>
<?php 
	} ?>
	</div>
	</div>
<?php
}
?>

	<p>&nbsp;</p>
	<h2 align="center">Informe as faixas etárias:</h2>
	<p>&nbsp;</p>
	<div class="row row-cols-auto" align="center">
		<div class="col-sm">
			<label>0 a 18</label>
		  <input type="number" class="form-control" name="faixa1" id="faixa1" max="99" min="0" value="0">
		</div>
		<div class="col-sm">
			<label>19 a 23</label>
		  <input name="faixa2" type="number" class="form-control" id="faixa2" max="99" min="0" value="0">
		</div>
		<div class="col-sm">
			<label>24 a 28</label>
		  <input name="faixa3" type="number" class="form-control" id="faixa3" max="99" min="0" value="0">
		</div>
		<div class="col-sm">
			<label>29 a 33</label>
		  <input type="number" class="form-control" name="faixa4" id="faixa4" max="99" min="0" value="0">
		</div>
		<div class="col-sm">
			<label>34 a 38</label>
		  <input type="number" class="form-control" name="faixa5" id="faixa5" max="99" min="0" value="0">
		</div>
		<div class="col-sm">
			<label>39 a 43</label>
		  <input type="number" class="form-control" name="faixa6" id="faixa6" max="99" min="0" value="0">
		</div>
		<div class="col-sm">
			<label>44 a 48</label>
		  <input type="number" class="form-control" name="faixa7" id="faixa7" max="99" min="0" value="0">
		</div>
		<div class="col-sm">
			<label>49 a 53</label>
		  <input type="number" class="form-control" name="faixa8" id="faixa8" max="99" min="0" value="0">
		</div>
		<div class="col-sm">
			<label>54 a 58</label>
		  <input type="number" class="form-control" name="faixa9" id="faixa9" max="99" min="0" value="0">
		</div>
		<div class="col-sm">
			<label>59 a 99</label>
		  <input name="faixa10" type="number" class="form-control" id="faixa10" max="99" min="0" value="0">
		</div>
		<input type="hidden" name="parametros" id="parametros" value="<?php echo $parametros ?>" />
		
	</div>
	<p>&nbsp;</p>
	<div align="center">
		<input type="submit" name='cotar' id="cotar">
	</div>	   
</form>
	<p>&nbsp;</p>
	