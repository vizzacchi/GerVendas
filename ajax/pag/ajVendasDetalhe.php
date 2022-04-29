<?php 
include "../../inc/conexao.php";
include "../../inc/valida_login.php";    

if($_POST['id']){
    $id= $_POST['id'];
    $qsql = "Select * from venda, vendaendereco where venda.id = vendaendereco.idVenda and venda.id = $id";
    if($rs=mysqli_query($conn,$qsql)){
        $reg = mysqli_fetch_array($rs);
            $mes            = $reg['mes'];
            $contrato       = $reg['contrato'];
            $operadora      = $reg['cod_operadora'];
            $plano          = $reg['cod_plano'];
            $tipoPlano      = $reg['tipoPlano'];
            $entidade       = $reg['entidade'];
            $numVidas       = $reg['numVidas'];
            $valor          = number_format($reg['valor'], 2, ',', '.');
            $nomeVendedor   = $reg['cod_vendedor'];
            $corretora      = $reg['corretora'];
            $nomeCliente    = $reg['nome'];
            $cpf            = $reg['cpf'];		
            $vigencia       = date("d/m/Y",strtotime($reg['vigencia']));
			$vencimento     = date("d/m/Y",strtotime($reg['vencimento']));
            $data           = date("d/m/Y",strtotime($reg['dataVenda']));	
			$cadastradoPor  = $reg['cadastradoPor'];
			$codigoEmpresa  = $reg['codigo'];
			$qsql = "Select corretor from corretores where id= $cadastradoPor";
			if($rs=mysqli_query($conn,$qsql)){
				$regUser = mysqli_fetch_array($rs);
				$cadastradoPor = $regUser['corretor'];
			}
		
			$telefone       = $reg['telefone1'];
            $celular        = $reg['telefone2'];
            $comercial      = "";
            $email          = $reg['email'];
            $rua            = $reg['rua'];
            $numero         = $reg['numero'];
            $complemento    = $reg['complemento'];
            $bairro         = $reg['bairro'];
            $cidade         = $reg['cidade'];
            $estado         = $reg['uf'];
            $cep            = $reg['cep'];		
		
		
            //$dataNascimento = date("d/m/Y",strtotime($reg['dataNascimento']));
            //$rg             = $reg['rg'];
            //$codigo         = $reg['codigo'];
            //$nomeMae        = $reg['nomeMae'];
    }
}else{
    echo "Dados não encontrado, favor tentar outra venda!";
}
?> 
<div class="container-fluid">
    <div class="container">
        <p align="center">Cadastrado em <span class="tituloDetalhes"><?php  echo $data;?> </span> para o mês de <span class="tituloDetalhes"><?php  echo $mes;?> </span> na Base de Dados da <span class="tituloDetalhes">Pilon nova </span> por: <span class="tituloDetalhes"><?php echo $cadastradoPor ; ?></span></p>
          <div class="row">
            <div class="col-sm-6">Corretora: <span class="tituloDetalhes"><?php  
				$qsql="Select nomeAbrev from corretora where id = $corretora";
				if($rs=mysqli_query($conn,$qsql)){
					$reg=mysqli_fetch_array($rs);
					echo $reg['nomeAbrev'];
				}else{
					echo $corretora;
				}
				?> </span></div>
            <div class="col-sm-6">Vendedor: <span class="tituloDetalhes"><?php  
				$qsql="Select corretor from corretores where id = $nomeVendedor	";
				if($rs=mysqli_query($conn,$qsql)){
					$reg=mysqli_fetch_array($rs);
					echo $reg['corretor'];
				}else{			
					echo $nomeVendedor;
				}
				?> </span></div>
          </div>    
        <hr>
          <div class="row">
            <div class="col-sm-2">Contrato: <span class="tituloDetalhes"><?php  echo $contrato;?> </span></div>
            <div class="col-sm-4">Cliente: <span class="tituloDetalhes"><?php  echo $nomeCliente;?> </span></div>
            <div class="col-sm-2">Vigência: <span class="tituloDetalhes"><?php  echo $vigencia;?> </span></div>
			<?php 
			  if($tipoPlano=='PJ'){?>
				<div class="col-sm-4">Código Empresa: <span class="tituloDetalhes"><?php 
					if($codigoEmpresa<>""){
						echo $codigoEmpresa;
					}
					else{
						$idCampoVenda = "txt".$id;
					?>
						
						<spam id= <?php echo $idCampoVenda; ?>>
						<?php
							echo "<input type='text' name='$id.codigoVenda' id=$id onChange='codigoEmpresa($id,$(this).val())' >";?>
						</spam>
					<?php
					}?> </span></div>	
			  <?php } ?>		  
          </div>
        <hr>
          <div class="row">
            <div class="col-sm-2">Tipo Plano: <span class="tituloDetalhes"><?php  echo $tipoPlano;?> </span></div>
            <div class="col-sm-5">Operadora: <span class="tituloDetalhes"><?php  
				$qsql="Select nome_abrev from operadora where id = $operadora	";
				if($rs=mysqli_query($conn,$qsql)){
					$reg=mysqli_fetch_array($rs);
					echo $reg['nome_abrev'];
				}else{			
					echo $operadora;
				}
			?> </span></div>
            <div class="col-sm-5">Plano: <span class="tituloDetalhes"><?php
				$qsql="Select plano from planos where id = $plano	";
				if($rs=mysqli_query($conn,$qsql)){
					$reg=mysqli_fetch_array($rs);
					echo ucfirst($reg['plano']);
				}else{				
					echo $plano;
				}
			?> </span></div>
            <div class="col-sm-2">Valor: <span class="tituloDetalhes"><?php  echo $valor;?> </span></div> 
            <div class="col-sm-5">Entidade: <span class="tituloDetalhes"><?php  echo $entidade;?> </span></div>  
            <div class="col-sm-5">Qtdade Vidas: <span class="tituloDetalhes"><?php  echo $numVidas;?> </span></div>  
          </div>
        <hr>
          <div class="row">
            <div class="col-sm-12">e-mail: <span class="tituloDetalhes"><?php  echo $email;?> </span></div>
            <div class="col-sm-4">Telefone: <span class="tituloDetalhes"><?php  echo $telefone;?> </span></div>
            <div class="col-sm-4">Celular: <span class="tituloDetalhes"><?php  echo $celular;?> </span></div>
            <div class="col-sm-4">Comercial: <span class="tituloDetalhes"><?php  echo $comercial;?> </span></div> 
          </div>     
        <hr>
          <div class="row">
            <div class="col-sm-8">Rua: <span class="tituloDetalhes"><?php  echo $rua;?> </span>, <span class="tituloDetalhes"><?php  echo $numero;?> </span></div>
            <div class="col-sm-4">Complemento: <span class="tituloDetalhes"><?php  echo $complemento;?> </span></div>
            <div class="col-sm-4">Bairro: <span class="tituloDetalhes"><?php  echo $bairro;?> </span></div>
            <div class="col-sm-4">Cidade: <span class="tituloDetalhes"><?php  echo $cidade;?> </span> / <span class="tituloDetalhes"><?php  echo $estado;?> </span></div> 
            <div class="col-sm-4">Cep: <span class="tituloDetalhes"><?php  echo $cep;?> </span></div>   
          </div>         
        <hr>
        <?php
            if($numVidas>=1){
                $qsql = "Select * from vendabeneficiario where idVenda = $id order by id";
                if($rs=mysqli_query($conn,$qsql)){ ?>
                    <p class="text-muted">Beneficiários:</p>
            		<table class="table table-striped table-sm">  
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Titular</th>
								<th scope="col">Tipo</th>
								<th scope="col">Nome</th>
								<th scope="col">Sexo</th>
								<th scope="col">Dt. Nasc.</th>
								<th scope="col">CPF</th>
								<th scope="col">Telefone 1</th>
								<th scope="col">Telefone 2</th>
								<th scope="col">Email</th>
								<th scope="col">Código Benef.</th>
							</tr>
						</thead>
						<tbody>
			<?php
					
                    while($reg=mysqli_fetch_array($rs)){?>
                    	<tr id=<?php echo $reg['id']; ?> >
							<td><?php echo $reg['id']; ?></td>
							<td><?php echo $reg['idTitular']; ?></td>
							<td><?php 
								if($reg['tipoBeneficiario']==0){
									echo "Tit";
								}elseif($reg['tipoBeneficiario']==1){
									echo "Dep";
								}else{							
									echo "Resp";
									}
							?></td>
							<td><?php echo $reg['nome']; ?></td>
							<td><?php echo $reg['sexo']; ?></td>
							<td><?php echo $reg['dtNascimento']; ?></td>
							<td><?php echo $reg['cpf']; ?></td>
							<td><?php echo $reg['telefone1']; ?></td>
							<td><?php echo $reg['telefone2']; ?></td>
							<td><?php echo $reg['email']; ?></td>
							<td><?php 
								if($reg['codigo']<>""){
									echo $reg['codigo'];
								}else{
									$idBeneficiario = $reg['id'];
									$idCampo = "txt".$idBeneficiario;?>
									<spam id="<?php echo $idCampo; ?>" >
								<?php
									
									echo "<input type='text' name='$idBeneficiario' id='$idBeneficiario' onChange='codigoBeneficiario($idBeneficiario,$(this).val(),$id)' >";
								} ?></spam></td>
						</tr>
        <?php    
                    }?>
					</tbody>
              <?php  }

            }else{
                echo "Esse contrato não possui dependentes!";
            }
        
        ?>
               
    </div>
</div>

