// JavaScript Document

function processaSenha(){
	window.scrollTo(0, 0);
	dados = $("#frmSenha").serializeObject();
	$("#retorno").load("ajax/ajTrocaSenha.php",dados);
	return false;
}

function cadSenha(){
	window.scrollTo(0, 0);
	dados = $("#frmSenha").serializeObject();
	$("#retorno").load("ajax/ajCadSenha.php",dados);
	$("#novaSenha").val = "";
	$("#confSenha").val = "";
	return false;
}

function verificaSenha(){
		var senha = document.getElementById("novaSenha");
	    var elSenha = senha.value;

		if(6 >= elSenha.length){
			document.getElementById('novaSenha').focus();
			var el = document.getElementById('msgSenha');
			el.innerHTML = 'A senha deve ter no mínimo 6 caracteres';
			el.style.color = '#FF0000';
			var b = document.getElementById("bt-cad");
			b.setAttribute("disabled", "disabled");

        	return false;					   
    	   }
		else{

			var confSenha = document.getElementById("confSenha");
			var elconfSenha = confSenha.value;

			if(elconfSenha != elSenha){
				var el = document.getElementById('msgSenha');
				el.innerHTML = 'As senhas devem ser iguais';
				el.style.color = '#FF0000';
				var b = document.getElementById("bt-cad");
				b.setAttribute("disabled", "disabled");

				return false;
			}else{
				var el = document.getElementById('msgSenha');
				el.innerHTML = 'Senhas Ok';
				el.style.color = '#008000';

				var b = document.getElementById("bt-cad");
				b.disabled = false;
			}
		}
};
