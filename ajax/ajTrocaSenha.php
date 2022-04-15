<?php
  // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
  if (empty($_POST['email'])) {
      echo "<h3 align='center'>O campo email é obrigatório.";
  }
  else{
	 // Tenta se conectar ao servidor MySQL

	  include("../inc/conexao.php");

	  $email = $_POST['email'];

	  // Validação do usuário/senha digitados

	$sql = "SELECT `id`, `email`,`corretor` FROM `corretores` WHERE (`email` = '".$email ."') AND (`ativo` = 1) LIMIT 1";

	if($query = mysqli_query($conn,$sql)){
	  if (mysqli_num_rows($query) != 1) {
		  // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
		  echo "<h3 align='center'>E-mail não cadastrado ou usuário não esta ativo!</h3>";
		  echo "<p align='center'>Verifique o e-mail informado.</a></p>";
		  exit;
	   }
	   else{
		   $usuario = mysqli_fetch_assoc($query);
		  // Envia e-mail com o link para troca de senha.
		  	$id 		= $usuario['id'];
		  	$corretor 	= $usuario['corretor'];
		  
		    $emailsender = $_SERVER['SERVER_NAME'];

			if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
			elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
			else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");

			// Passando os dados obtidos pelo formulário para as variáveis abaixo
			$nomeremetente		= "Cotador São José dos Campos";
			$emailremetente		= 'comercial@pilonvidaesaude.com.br';
			$emaildestinatario	= $email;
			$assunto    	    = "Link para trocar senha | Cotador São José dos Campos";

			/* Montando a mensagem a ser enviada no corpo do e-mail. */
			$mensagemHTML = "<p>Atendendo a sua solicita&ccedil;&atilde;o para troca de  senha:</p>
			<p><a href='http://www.cotador.sjc.br/trocaSenha.php?id=$id&corretor=$corretor' title='Troca de Senha Cotador São José dos Campos' target='new'>Trocar senha</a></p><hr>";

			/* Montando o cabeçalho da mensagem */
			$headers = "MIME-Version: 1.1".$quebra_linha;
			$headers .= "Content-type: text/html; charset=iso-8859-1".$quebra_linha;
			$headers .= "From: ".$emailsender.$quebra_linha;
			$headers .= "Return-Path: " . $emailsender . $quebra_linha;
			$headers .= "Reply-To: ".$emailremetente.$quebra_linha;

			/* Enviando a mensagem */
			if(mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender)){
				echo "<h3>Link para alteração de senha enviado com sucesso.</h3>
			 		<p><a href='../pag/Pilon/'>Logar</a></p>"
			 		;
				$qsql = "UPDATE `corretores` SET `senha` = '999' WHERE `corretores`.`id` = $id";
				$rs = mysqli_query($conn,$qsql);
				
			 	exit;
			}
			else{
				echo "Deu erro no envio da senha, favor entrar em contato com a equipe Pilon Vida e Saúde";
			}
	  }		
	}else{
			echo "Entrar em contato com 12 99715-0065 - Query 2";

	}
  }
?>