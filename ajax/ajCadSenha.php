<?php
  // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
  if (empty($_POST['id'])) {
      echo "<h3 align='center'>Não foi possível identificar o usuário.";
  }
  else{
	 // Tenta se conectar ao servidor MySQL

	  include("../inc/conexao.php");

	  $id 		 = $_POST['id'];
	  $novaSenha = $_POST['novaSenha'];
	  $confSenha = $_POST['confSenha'];
	  /***************Validando as senhas********************/
	  
	  if($novaSenha != $confSenha){
		  echo "As senhas devem ser iguais";
	  }
	  else
	  {
		  if(strlen($novaSenha)<6){
			  echo "A senha deve ter no mínimo 6 caracteres";
		  }
		  else
		  {
			  $qsql = "UPDATE `corretores` SET `senha` = md5('$novaSenha') WHERE `corretores`.`id` = $id";
			  if($query = mysqli_query($conn,$qsql)){
				  echo "Senha Alterada com sucesso!!!";?>
				  <p align="center">Efetue um novo <a href="../pag/Pilon/" title="Login">login</a>.</p>
			<?php	  
			   }
			  else{
				  echo "Não foi possível alterar a senha, entre em contato com a equipe da Pilon Vida e Saúde";
			  }
		}
	  }
  }