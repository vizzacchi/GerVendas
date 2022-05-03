<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

if(is_numeric($_POST['cboDepTitular'])){
	//Cadastro de dependente
	$idTitular = $_POST['cboDepTitular'];
}else{
	//Cadastro de titular
	$idTitular = 0;
}
$tipoBeneficiario = $_POST['cboDepTipo'];
$nome             = $_POST['depNome'];
$sexo             = $_POST['depSexo'];
$dtNascimento1    = $_POST['depDtNascimento'];
$rg               = $_POST['depRG'];
$cpf              = $_POST['depCPF'];
$telefone1        = $_POST['depTelefone1'];
$telefone2        = $_POST['depTelefone2'];
$email            = $_POST['depEmail'];
$idVenda		  = $_POST['idVenda'];
$vidas            = 0;

$qsql = "Insert into vendabeneficiario (`idTitular`, `idVenda`, `tipoBeneficiario`, `nome`, `sexo`, `dtNascimento`, `rg`, `cpf`, `telefone1`, `telefone2`, `email`, `situacao`, `titulo`) Values ($idTitular, '$idVenda', '$tipoBeneficiario', '$nome', '$sexo', '$dtNascimento1', '$rg', '$cpf', '$telefone1', '$telefone2', '$email', 1, 0 )";


if($rs=mysqli_query($conn,$qsql)){
	echo "<h2 align='center'>Usuário incluído com sucesso</h2>";
}else{
	echo "<h2 align='center'>Não foi possível incluir o beneficiário</h2>";
}
$qsqlBeneficiario = "Select * from vendabeneficiario where idVenda = $idVenda and tipoBeneficiario < 2 order by  id";
	if($rsBeneficiario=mysqli_query($conn,$qsqlBeneficiario)){?>
		<table class="table table-striped">
		  <thead>
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">#Tit</th>
			  <th scope="col">Tipo</th>
			  <th scope="col">Nome</th>
			  <th scope="col">Sexo</th>
			  <th scope="col">Dt Nasc</th>
			  <th scope="col">RG</th>
			  <th scope="col">CPF</th>
			  <th scope="col">Telefone 1</th>
			  <th scope="col">Telefone 2</th>
			  <th scope="col">E-mail</th>	
			</tr>
		  </thead>
			<tbody><?php
				while($reg=mysqli_fetch_array($rsBeneficiario)){
				?>
					<tr>
					 	<td><?php echo $reg['id'];?></td>
						<td><?php echo $reg['idTitular'];?></td>
					 	<td><?php 
								if($reg['tipoBeneficiario']==0){
									echo "Titular";}
								else{
									echo "Dependente";}?></td>
					 	<td><?php echo $reg['nome'];?></td>
					 	<td><?php echo $reg['sexo'];?></td>
					 	<td><?php echo $reg['dtNascimento'];?></td>
					 	<td><?php echo $reg['rg'];?></td>
					 	<td><?php echo $reg['cpf'];?></td>
					 	<td><?php echo $reg['telefone1'];?></td>
					 	<td><?php echo $reg['telefone2'];?></td>
					 	<td><?php echo $reg['email'];?></td>
					</tr>		
			<?php	
				}?>
					</tbody>
	<?php
	}
$qsql = "Select id from vendabeneficiario where idVenda = $idVenda and tipoBeneficiario < 2";
if($rs=mysqli_query($conn,$qsql)){
	$numBeneficiarios=mysqli_num_rows($rs);
}
$qsql = "select numVidas from venda where id = $idVenda";
if($rs=mysqli_query($conn,$qsql)){
	$reg = mysqli_fetch_array($rs);
	$numVidas= $reg['numVidas'];
}

if($numBeneficiarios==$numVidas){
	echo "<script language='javaScript'>location. reload();</script>";
}else{
	echo 	
		"<script>	
			$('#cboTitular').html('<option>Carregando...</option>');
			$.post('../../ajax/pag/ajCadastroDepTitulares.php', {'id': $idVenda}, function(data){
			$('#cboTitular').html(data);
			});	
		</script>";
}
?>	
		




