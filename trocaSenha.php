<!doctype html>
<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cotador Planos de Saúde de São José dos Campos">
    <meta name="author" content="Douglas Jorge Vizzacchi, NewSunrise, and Bootstrap contributors">
    <meta name="generator" content="NewSunrise">
	<title>Cadastro de Senha</title>
    <!-- Bootstrap core CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">	<link rel="shortcut icon" href="images/favicon.jpg" />  

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
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet"></head>
	

<body>
	<?php
		include('inc/conexao.php');
		$id = $_GET['id'];
		$corretor = $_GET['corretor'];
	
		$sql = "Select email from corretores where id= $id and corretor = '$corretor' and senha = '999'";
	
		if($query = mysqli_query($conn,$sql)){
		  if (mysqli_num_rows($query) != 1) {
			  // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
			  echo "<h3 align='center'>Encontrado alguma inconsistência com seu cadastro entre em contato com a Pilon Vida e Saúde.</h3>";
			  echo "<p align='center'>12 3307-5375.</a></p>";
			  exit;
		   }
		   else{
			  ?>
		 	<main class="form-signin">
			  <div id="retorno" style="color: red"></div>
			  <form action="#retorno" method="post" id="frmSenha" name="frmSenha" onSubmit="return cadSenha()">

			  <img class="mb-4" src="img/logos/16286884666113d0526443b.jpg" alt="Pilon Vida e Saúde" >
			  <input type="text" id="id" name="id" class="form-control" value="<?php echo $id;?>" hidden="true" >  			  

			  <h3 class="h3 mb-3 font-weight-normal">Digite a nova senha:</h3>
			  <input type="password" id="novaSenha" name="novaSenha" class="form-control" placeholder="Nova senha" required autofocus onKeyUp ="verificaSenha()">
			  
			  <h3 class="h3 mb-3 font-weight-normal">Confirme a senha:</h3>
			  <input type="password" id="confSenha" name="confSenha" class="form-control" placeholder="Confirme a Senha" required onKeyUp="verificaSenha()">
			  <div id="msgSenha"></div>
			  
			  <p>&nbsp;</p>

			  <button id="bt-cad" class="btn btn-lg btn-primary btn-block" type="submit" >Cadastrar Senha</button>
			  <p>&nbsp;</p>	

			  <p class="mt-5 mb-3 text-muted">&copy; 2020 - New Sunrise</p>

			  </form>
			</main> 
<?php
		   }
		}
?>
	<script src="js/jsSenha.js.php"></script>	  
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.serializeObject.min.js"></script>
	<script src="js/jquery.maskedinput.min.js"></script>		
</body>
</html>