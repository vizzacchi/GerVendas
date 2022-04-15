<?php
  // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
  if (!empty($_POST) AND (empty($_POST['email']) OR empty($_POST['password']))) {
      echo "<h3 align='center'>Os campos senha e email são obrigatórios";
  }
  else{
	 // Tenta se conectar ao servidor MySQL

	  include("../inc/conexao.php");

	  $email = $_POST['email'];
	  $senha = $_POST['password'];
	  // Validação do usuário/senha digitados

	$sql = "SELECT `id`, `email`,`corretor`,`cpf`,`id_perfil` FROM `corretores` WHERE (`email` = '".$email ."') AND (`senha` = '". md5($senha) ."') AND (`ativo` = 1) LIMIT 1";

	if($query = mysqli_query($conn,$sql)){
	  if (mysqli_num_rows($query) != 1) {
		  // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
		  echo "<h3 align='center'>Login inválido!</h3>";
		  echo "<p align='center'>Verifique os dados informados.</a></p>";
		  exit;
	  } else {
		  // Salva os dados encontados na variável $resultado
		  $resultado = mysqli_fetch_assoc($query);
		  // Se a sessão não existir, inicia uma
		  if (!isset($_SESSION))
			  session_start();

			  // Salva os dados encontrados na sessão
			  $_SESSION['UsuarioID'] = $resultado['id'];
			  $_SESSION['email'] = $email;
			  $_SESSION['UsuarioNome'] = $resultado['corretor'];
			  $_SESSION['perfil'] = $resultado['id_perfil'];
              $_SESSION['cpf'] = $resultado['cpf'];
            
  
			 echo "<script language='javaScript'>
                    window.location.href='pag/Pilon/';
                </script>";
			 exit;
			}
			echo "Entrar em contato com 12 99715-0065 - Query 2";


	}
  }
?>