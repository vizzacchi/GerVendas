<?php
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";
$dados = $_GET['dados'];
$obj = json_decode($dados);

$indicacao     = 0 /*$obj->{'txtNumIndicacao'}*/;
$operadora     = $obj->{'cboOperadora'};
$vendedor      = $obj->{'cboCorretor'};
$corretora     = $obj->{'cboCorretora'};
$nome          = $obj->{'txtNome'};
$cpf           = $obj->{'txtCPF'};
$tipoPlano     = $obj->{'cboTipoPlano'};
$plano         = $obj->{'cboPlano'};
$dataVenda     = date('Y-m-d');
$vigencia      = $obj->{'txtVigencia'};
$mes           = $obj->{'cboMes'};
$vencimento    = $obj->{'txtVencimento'};
$entidade      = $obj->{'txtEntidade'};
$numVidas      = $obj->{'txtNumVidas'};
$valor         = str_replace(",",".",str_replace(".","",$obj->{'txtValor'}));
$contrato      = $obj->{'txtContrato'};
$situacao      = 1;
$usuario       = $_SESSION['UsuarioID'];
 
$qsql = "INSERT INTO `venda` ( `idIndicacao`, `cod_operadora`, `cod_vendedor`, `nome`, `cpf`, `cod_plano`, `dataVenda`, `vigencia`, `mes`, `vencimento`, `tipoPlano`, `entidade`, `numVidas`, `valor`, `contrato`, `corretora`, `titulo`, `situacao`, `codigo`, `char-1`, `cadastradoPor`) VALUES ( '$indicacao', '$operadora', '$vendedor', '$nome', '$cpf','$plano', '$dataVenda', '$vigencia', '$mes', '$vencimento', '$tipoPlano', '$entidade', '$numVidas', '$valor', '$contrato', '$corretora', '', '$situacao', '', '', '$usuario')";

mysqli_autocommit($conn,false);
$situacao = 0;

if($rs = mysqli_query($conn,$qsql)){
    $id = mysqli_insert_id($conn);
    $cep         = $obj->{'txtCep'};
    $rua         = $obj->{'txtEndereco'};
    $numero      = $obj->{'txtNumero'};
    $complemento = $obj->{'txtComplemento'};
    $bairro      = $obj->{'txtBairro'};
    $cidade      = $obj->{'txtCidade'};
    $uf          = $obj->{'txtUF'};
    $telefone1   = $obj->{'txtTelefone1'};
    $telefone2   = $obj->{'txtTelefone2'};
    $email       = $obj->{'txtEmail'};
    
    $qsqlEndereco = "INSERT INTO `vendaendereco` (`idVenda`, `cep`, `rua`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `telefone1`, `telefone2`, `email`, `situacao`) VALUES ( '$id', '$cep', '$rua', '$numero', '$complemento', '$bairro', '$cidade', '$uf', '$telefone1', '$telefone2', '$email', '1' )";
    
    
    if($rsEndereco = mysqli_query($conn,$qsqlEndereco)){
        $tipoBeneficiario       = $obj->{'cboTipoBeneficiario'};
        $nomeBeneficiario       = $obj->{'txtTitularNome'};
        $sexoBeneficiario       = $obj->{'cboSexo'};
        $dtNascimento           = $obj->{'txtDtNascimento'};
        $rg                     = $obj->{'txtRG'};
        $cpfBeneficiario        = $obj->{'txtCPFtitular'};
        $telefone1Beneficiario  = $obj->{'txtTelefone1Titular'};
        $telefone2Beneficiario  = $obj->{'txtTelefone2Titular'};
        $emailBeneficiario      = $obj->{'txtEmailTitular'};
        
        $qsqlBeneficiario = "INSERT INTO `vendabeneficiario` (`idVenda`, `tipoBeneficiario`, `nome`, `sexo`, `dtNascimento`, `rg`, `cpf`, `telefone1`, `telefone2`, `email`, `situacao`,`titulo`) VALUES ('$id','$tipoBeneficiario', '$nomeBeneficiario', '$sexoBeneficiario', '$dtNascimento', '$rg', '$cpfBeneficiario', '$telefone1Beneficiario', '$telefone2Beneficiario', '$emailBeneficiario', '1','0')";
        
        if($rsBeneficiario=mysqli_query($conn,$qsqlBeneficiario)){
			$idBeneficiario = mysqli_insert_id($conn);
			mysqli_commit($conn);
			if($numVidas==1 and $tipoPlano=='PF'){
				echo "Proposta cadastrada com sucesso";
			}else{
				$dados = array(
					'venda' => $id,
					'beneficiario' => $idBeneficiario
				);
				echo json_encode($dados);
			}
        }else{
			$situacao = 1;
			echo "Não foi possível cadastrar a proposta";
		}
        
    }else{
		$situacao = 1;
		echo "Não foi possível cadastrar a proposta";
	}
}else{
	$situacao = 1;
	echo "Não foi possível cadastrar a proposta";
}

?>
