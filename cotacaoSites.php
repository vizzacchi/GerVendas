<?php 
include "includes/conexao.php";
?>
<!doctype html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Douglas Jorge Vizzacchi e colaboradores Bootstrap">
    <meta name="generator" content="Douglas Jorge Vizzacchi">
    <title>Cotação Planos de Saúde</title>

    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	<!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/album.css" >
	
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>	  
  </head>
<body>
<div class="container-fluid">
<?php 
	$nome 		= $_POST['nome'];
	$email 		= $_POST['email'];
	$telefone 	=  $_POST['telefone'];
	$cidade 	=  $_POST['cidade'];
	$tipo		=  $_POST['tipo'];
	$faixa1 	=  $_POST['qtd0-18'];
	$faixa2 	=  $_POST['qtd19-23'];
	$faixa3 	=  $_POST['qtd24-28'];
	$faixa4 	=  $_POST['qtd29-33'];
	$faixa5 	=  $_POST['qtd34-38'];
	$faixa6 	=  $_POST['qtd39-43'];
	$faixa7 	=  $_POST['qtd44-48'];
	$faixa8 	=  $_POST['qtd49-53'];
	$faixa9 	=  $_POST['qtd54-58'];
	$faixa10 	=  $_POST['qtd59-99'];
	$totalVidas	= $faixa1+$faixa2+$faixa3+$faixa4+$faixa5+$faixa6+$faixa7+$faixa8+$faixa9+$faixa10;
	
	if($_POST['site']){
		if($_POST['site']=="Sulamerica"){
			$origem = 'SulamericaSaudeNacional';
			$condicao = "and (planos.cod_oper = 61 or planos.cod_oper = 63)";
		}
	}else{
			$condicao = "";
			$origem = "Planosdesaudesjc";
	}
			$qsqlIndicacao = "INSERT INTO `indicacao` (`cod_indicacao`, `nome_cliente`, `telefone`, `email`, `cidade`, `site_origem`, `data`,`cod_situacao`, `faixa1`, `faixa2`, `faixa3`, `faixa4`, `faixa5`, `faixa6`, `faixa7`, `faixa8`, `faixa9`, `faixa10`, `tipo`) VALUES (NULL, '$nome', '$telefone', '$email', '$cidade', '$origem',now(),1, '$faixa1', '$faixa2', '$faixa3', '$faixa4', '$faixa5', '$faixa6', '$faixa7', '$faixa8', '$faixa9','$faixa10', '$tipo');";
	
			$rsIndicacao = mysqli_query($conexao,$qsqlIndicacao);
			if ($conexao){
				mysqli_close($conexao);
			}

?>
	<section id='cotacao'>	
	<h1 style="text-align: center">Pilon Vida e Saúde - <em>Cotação Planos de Saúde</em></h1>
	<p>&nbsp;</p>
	<h3>Cliente: <small class="text-muted"><?php echo $nome;?></small></h3>
	<h3>Data: <small class="text-muted"><?php echo date('d/m/Y'); ?></small></h3>
     <p>Abaixo você encontrará todas as opções de planos de saúde
	<?php 
		if($tipo=='PF'){
			echo " pessoa física.</p>";
		}else{
			echo " pessoa jurídica. </p>";
		}
?>	<p>Você observará que nosso portfólio é bem completo, por isso, entre em contato 
		conosco para que possamos te orientar na melhor escolha para a sua necessidade. 
		Será um prazer estar com você nessa descisão.</p>

	<?php	$qsqlTabela = "SELECT * FROM `tabela_planos`,planos,operadora WHERE 
					planos.tipo_plano = '$tipo' and 
					(tabela_planos.umTitular = 1 or tabela_planos.umTitular = '') AND
                    (tabela_planos.compulsorio = 0 or tabela_planos.compulsorio = '') AND
                    (tabela_planos.tabela = 'aberta' or tabela_planos.tabela = '') AND
                    (tabela_planos.regiao = 5 or 
					tabela_planos.regiao = 8 or
                    tabela_planos.regiao = 11 or 
                    tabela_planos.regiao = 14 or 
                    tabela_planos.regiao = 17 or
					tabela_planos.regiao = 0) and
                    tabela_planos.vidas_ini <= $totalVidas AND
                    tabela_planos.vidas_fim >= $totalVidas and
					tabela_planos.plano = planos.id and 
					planos.cod_oper = operadora.id 
					$condicao
					order by operadora.id";

		$nomeOperadora= 'douglas';
		$registro = 0;
		if($rdPlano = mysqli_query($conn,$qsqlTabela)){
			
			while($regPlano=mysqli_fetch_array($rdPlano)){
				
				$nomeAbrev = $regPlano['nome_abrev'];
				
				if ($nomeAbrev <> $nomeOperadora){
					if($registro <> 0){?>
						</table>
					<?php } 
					echo "<h2 align=center><img src='images/logos/".$nomeAbrev.".png' alt='".$nomeAbrev."' style='height:80px'/></h2>";
					
					$nomeOperadora = $nomeAbrev;
					
						$valorTotal =   $faixa1  * $regPlano['faixa1'] +
									    $faixa2  * $regPlano['faixa2'] +
										$faixa3  * $regPlano['faixa3'] +
										$faixa4  * $regPlano['faixa4'] +
										$faixa5  * $regPlano['faixa5'] +
										$faixa6  * $regPlano['faixa6'] +
										$faixa7  * $regPlano['faixa7'] +
										$faixa8  * $regPlano['faixa8'] +
										$faixa9  * $regPlano['faixa9'] +
										$faixa10 * $regPlano['faixa10'];
?>
					<table class="table table-striped table-sm" >
							<thead>
								<tr>
									<th>Faixas Etárias</th>
									<td><strong>00 a 18</strong></td>
									<td><strong>19 a 23</strong></td>
									<td><strong>24 a 28</strong></td>
									<td><strong>29 a 33</strong></td>
									<td><strong>34 a 38</strong></td>
									<td><strong>39 a 43</strong></td>
									<td><strong>44 a 48</strong></td>
									<td><strong>49 a 53</strong></td>
									<td><strong>54 a 58</strong></td>
									<td><strong>59 a 99</strong></t>
									<td><strong>Total</strong></td>
								</tr>
							</thead>
							<tr>
								<th>Vidas</th>
								<td><?php echo $faixa1;?></td>
								<td><?php echo $faixa2;?></td>
								<td><?php echo $faixa3;?></td>
								<td><?php echo $faixa4;?></td>
								<td><?php echo $faixa5;?></td>
								<td><?php echo $faixa6;?></td>
								<td><?php echo $faixa7;?></td>
								<td><?php echo $faixa8;?></td>
								<td><?php echo $faixa9;?></td>
								<td><?php echo $faixa10;?></td>
								<td><strong><?php echo intval($totalVidas);?></strong></td>
							</tr>
							<tr>
								<th><?php echo ucfirst($regPlano['plano']) ;?></th>
								<td><?php if ($faixa1 <> 0){ 
									echo number_format($regPlano['faixa1'], 2, ',', '.');
														   }else{ echo " - ";					} ?></td>
								<td><?php if ($faixa2 <> 0){ 
									echo number_format($regPlano['faixa2'], 2, ',', '.');
														   }else{ echo " - ";					}  ?></td>
								<td><?php if ($faixa3 <> 0){ 
									echo number_format($regPlano['faixa3'], 2, ',', '.');
														   }else{ echo " - ";					}  ?></td>
								<td><?php if ($faixa4 <> 0){ 
									echo number_format($regPlano['faixa4'], 2, ',', '.');
														   }else{ echo " - ";					}  ?></td>
								<td><?php if ($faixa5 <> 0){ 
									echo number_format($regPlano['faixa5'], 2, ',', '.');
														   }else{ echo " - ";					}  ?></td>
								<td><?php if ($faixa6 <> 0){ 
									echo number_format($regPlano['faixa6'], 2, ',', '.');
														   }else{ echo " - ";					}  ?></td>
								<td><?php if ($faixa7 <> 0){ 
									echo number_format($regPlano['faixa7'], 2, ',', '.');
														   }else{ echo " - ";					}  ?></td>
								<td><?php if ($faixa8 <> 0){ 
									echo number_format($regPlano['faixa8'], 2, ',', '.');
														   }else{ echo " - ";					}  ?></td>
								<td><?php if ($faixa9 <> 0){ 
									echo number_format($regPlano['faixa9'], 2, ',', '.');
														   }else{ echo " - ";					}  ?></td>
								<td><?php if ($faixa10 <> 0){ 
									echo number_format($regPlano['faixa10'], 2, ',', '.');
														   }else{ echo " - ";					}  ?></td>
								<td><strong><?php echo number_format($valorTotal, 2, ',', '.'); ?></strong></td>
							</tr>
		<?php 
				$registro = $registro+1;
				}else{
						$valorTotal =   $faixa1  * $regPlano['faixa1'] +
									    $faixa2  * $regPlano['faixa2'] +
										$faixa3  * $regPlano['faixa3'] +
										$faixa4  * $regPlano['faixa4'] +
										$faixa5  * $regPlano['faixa5'] +
										$faixa6  * $regPlano['faixa6'] +
										$faixa7  * $regPlano['faixa7'] +
										$faixa8  * $regPlano['faixa8'] +
										$faixa9  * $regPlano['faixa9'] +
										$faixa10 * $regPlano['faixa10'];
		?>
							<tr>
								<th><?php echo ucfirst($regPlano['plano']) ;?></th>
								<td><?php if ($faixa1 <> 0){ 
									echo number_format($regPlano['faixa1'], 2, ',', '.');
														   }else{ echo " - ";					} ?></td>
								<td><?php if ($faixa2 <> 0){ 
									echo number_format($regPlano['faixa2'], 2, ',', '.');
														   }else{ echo " - ";					}  ?></td>
								<td><?php if ($faixa3 <> 0){ 
									echo number_format($regPlano['faixa3'], 2, ',', '.');
														   }else{ echo " - ";					}  ?></td>
								<td><?php if ($faixa4 <> 0){ 
									echo number_format($regPlano['faixa4'], 2, ',', '.');
														   }else{ echo " - ";					}  ?></td>
								<td><?php if ($faixa5 <> 0){ 
									echo number_format($regPlano['faixa5'], 2, ',', '.');
														   }else{ echo " - ";					}  ?></td>
								<td><?php if ($faixa6 <> 0){ 
									echo number_format($regPlano['faixa6'], 2, ',', '.');
														   }else{ echo " - ";					}  ?></td>
								<td><?php if ($faixa7 <> 0){ 
									echo number_format($regPlano['faixa7'], 2, ',', '.');
														   }else{ echo " - ";					}  ?></td>
								<td><?php if ($faixa8 <> 0){ 
									echo number_format($regPlano['faixa8'], 2, ',', '.');
														   }else{ echo " - ";					}  ?></td>
								<td><?php if ($faixa9 <> 0){ 
									echo number_format($regPlano['faixa9'], 2, ',', '.');
														   }else{ echo " - ";					}  ?></td>
								<td><?php if ($faixa10 <> 0){ 
									echo number_format($regPlano['faixa10'], 2, ',', '.');
														   }else{ echo " - ";					}  ?></td>
								<td><strong><?php echo number_format($valorTotal, 2, ',', '.'); ?></strong></td>
							</tr>
	
		<?php
				}
				
			}?>
		</table>
	<?php } ?>
</section>
</div>
<p>&nbsp;</p>
<p>As tabelas podem sofrer alteração sem aviso prévio.</p>
<img src="images/logos/pilon-vida-e-saude-logo.jpg" width="200" height="90" alt="Pilon Vida e Saúde" style="float: left;margin-right: 50px"/>
<p><strong><em><?php echo $_SESSION['UsuarioNome']; ?></em></strong><br>
	<strong>Telefone:</strong> 12 3307-5375 WhatsApp<br>
	<strong>Email:   </strong> comercial@pilonvidaesaude.com.br  </p>
<!--SCRIPTS -->
	<script src="js/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>		
	
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.serializeObject.min.js"></script>
<script src="js/jquery.maskedinput.min.js"></script>
					
</body>
</html>							