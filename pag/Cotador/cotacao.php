<?php 
include "../../inc/conexao.php";
include "../../inc/valida_login.php";
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
	$codPlano = 0;
	$codRegiao = 0;
	$cod_operadora = 0;
    $profissao = 0;

$parametros   = explode('#',$_POST['parametros']);
$profissao    = $parametros[0];
$contratacao  = $parametros[1];
$numTitulares = $parametros[2];
$nomeCliente  = $parametros[3];
$tipoPlano    = $parametros[4];	
?>
<section id='cotacao'>	
	<h1 style="text-align: center">Pilon Vida e Saúde - <em>Cotação Planos de Saúde</em></h1>
	<p>&nbsp;</p>
	<h3>Cliente: <small class="text-muted"><?php echo $nomeCliente;?></small></h3>
	<h3>Data: <small class="text-muted"><?php echo date('d/m/Y'); ?></small></h3>

	<?php 
		if($tipoPlano=='PF'){
				echo "<p>Valores para contratação de planos por pessoa física.</p>";
		}
        else{
			echo "<p>Valores para contratação de planos por pessoa jurídica. </p>";
		}?>

<?php

$faixa1 = $_POST['faixa1']<>''?$_POST['faixa1']:0;
$faixa2 = $_POST['faixa2']<>''?$_POST['faixa2']:0;
$faixa3 = $_POST['faixa3']<>''?$_POST['faixa3']:0;
$faixa4 = $_POST['faixa4']<>''?$_POST['faixa4']:0;
$faixa5 = $_POST['faixa5']<>''?$_POST['faixa5']:0;
$faixa6 = $_POST['faixa6']<>''?$_POST['faixa6']:0;
$faixa7 = $_POST['faixa7']<>''?$_POST['faixa7']:0;
$faixa8 = $_POST['faixa8']<>''?$_POST['faixa8']:0;
$faixa9 = $_POST['faixa9']<>''?$_POST['faixa9']:0;
$faixa10 = $_POST['faixa10']<>''?$_POST['faixa10']:0;
$totalVidas = $faixa1 + $faixa2 + $faixa3 + $faixa4 + $faixa5 + $faixa6 + $faixa7 + $faixa8 + $faixa9 + $faixa10;


    if($profissao=='Ambas'){
        $tabela = "";
    }
    else{
        $tabela = "(tabela.tabela = '$profissao' or tabela.tabela = '') and ";
    }
    

$registros = count($_POST);

for ($i=0;$i<=$registros;$i++){
	$reg = key($_POST);
	if (substr($reg,0,5)=='plano'){
		$codPlano = str_replace('plano','',$reg);
        
        $qsqlPlano = "Select tabela.*, planos.id as cod_plano,planos.plano, planos.cod_oper,                      planos.tipo_plano, operadora.nome_abrev as nomeAbrev 
                    from tabela_planos as tabela, planos, operadora 
                    where tabela.plano     = planos.id           and
                            planos.cod_oper  = operadora.id	     and
	                        tabela.validade >=  now()            and 
	                        tabela.plano     =  $codPlano	     and
	                        (tabela.umTitular = $numTitulares    or
	                        tabela.umTitular =  ''          )    and
	                        $tabela
				            (tabela.compulsorio = '$contratacao' or
							tabela.compulsorio = ''         ) and                           tabela.vidas_ini <= $totalVidas	  and
	                        tabela.vidas_fim >= $totalVidas
                            order by tabela";
        
		
		if($rdPlano = mysqli_query($conn,$qsqlPlano)){
			while($regPlano=mysqli_fetch_array($rdPlano)){
				$nomeAbrev = $regPlano['nomeAbrev'];
				$codPlano  = $regPlano['cod_plano'];
				$operadora = $regPlano['cod_oper'];
                $titular = $regPlano['umTitular'];
				$compulsorio = $regPlano['compulsorio'];
                $tipoPlano   = $regPlano['tipo_plano'];
                $profissao   = $regPlano['tabela'];
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

                $titular  = '';
                
                    if($regPlano['cod_oper']<>$cod_operadora) {
                        if($i<>0){	

                            echo "</table>";

                        }
                        $cod_operadora = $regPlano['cod_oper'];
                        echo "<h2 align=center><img src='../../img/logos/".$nomeAbrev.".png' alt='".$nomeAbrev."' style='height:80px'/></h2>";

                       ?>
                            <table class="table table-striped table-sm" >
                                <?php 
                            if($tipoPlano == 'PF'){
                                    echo "<caption>Valores para tabela $profissao </caption> ";
                                            }
                            if ($numTitulares<>''){
                                if($numTitulares==1){
                                            echo "Tabela para 1 titular.<br>";
                                    }else{
                                            echo  "Tabela para 1 titular com 1 ou mais dependentes.<br>";
                                            }
                                }						

                            if($compulsorio<>''){
                                if($compulsorio==1){
                                    echo "Tabela para contratação compulsória";
                                }else{
                                    echo "Tabela para contratação opcional";
                                }
                            }
                                ?>
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
                                    <td><?php echo intval($faixa1);?></td>
                                    <td><?php echo intval($faixa2);?></td>
                                    <td><?php echo intval($faixa3);?></td>
                                    <td><?php echo intval($faixa4);?></td>
                                    <td><?php echo intval($faixa5);?></td>
                                    <td><?php echo intval($faixa6);?></td>
                                    <td><?php echo intval($faixa7);?></td>
                                    <td><?php echo intval($faixa8);?></td>
                                    <td><?php echo intval($faixa9);?></td>
                                    <td><?php echo intval($faixa10);?></td>
                                    <td><strong><?php echo intval($totalVidas);?></strong></td>
                                </tr>
                    <?php

                     }
                

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
					
        
            }//while
        }//if existe query
    }//if existe plano
	next($_POST);
}//For
	?>
	</table>
</section>
</div>
<p>&nbsp;</p>
<p>As tabelas podem sofrer alteração sem aviso prévio.</p>
	<?php
	$id = $_SESSION['UsuarioID'];
	$qsql = "SELECT corretores.corretor,corretores.celular, corretores.email, corretora.telefone, corretora.logo FROM `corretores`,`corretora` WHERE corretores.id_corretora = corretora.id and corretores.id = $id";
	if($rs=mysqli_query($conn,$qsql)){
		$reg = mysqli_fetch_assoc($rs);?>
		<img src="<?php echo "../".$reg['logo']; ?>" width="200" height="90" alt="Pilon Vida e Saúde" style="float: left;margin-right: 50px"/>
		<p><strong><em><?php echo $reg['corretor']; ?></em></strong><br>
		<strong>Telefone:</strong><?php echo $reg['telefone'];?><br>
		<strong>Celular: </strong> <?php echo $reg['celular']; ?>  <br>
		<strong>Email:   </strong> <?php echo $reg['email']; ?>  <br>
		
	<?php 
	}
	?>		
<!--SCRIPTS -->
	<script src="js/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>		
	
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.serializeObject.min.js"></script>
<script src="js/jquery.maskedinput.min.js"></script>
					
</body>
</html>							