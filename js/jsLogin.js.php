// JavaScript Document

	function processaLogin(){
		window.scrollTo(0, 0);
		dados = $("#frmLogin").serializeObject();
		$("#retorno").load("ajax/ajValidaLogin.php",dados);
		return false;
	}