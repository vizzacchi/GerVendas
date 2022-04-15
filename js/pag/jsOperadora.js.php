// JavaScript Document

$(document).ready(function(){
  
    $('input[id="chkSituacao"]').on('change', function() {
        $(this).val(1);
      });

	$("#cpf").change(function(){
		var val = document.getElementById("cpf").value;
				var cpf = val.trim();
				cpf = cpf.replace('.', '');
				cpf = cpf.replace('-', '');
                cpf = cpf.replace('/', '');
                cpf = cpf.replace('.', '');

			if (cpf.length == 11) {;
				var cpf = val.trim();
				cpf = cpf.replace(/\./g, '');
				cpf = cpf.replace('-', '');
				cpf = cpf.split('');

				var v1 = 0;
				var v2 = 0;
				var aux = false;

				for (var i = 1; cpf.length > i; i++) {
					if (cpf[i - 1] != cpf[i]) {
						aux = true;   
					}
				} 

				if (aux == false) {
					alert("CNPJ/CPF Inválido!");
					$("#cpf").focus();
					return false; 
				} 

				for (var i = 0, p = 10; (cpf.length - 2) > i; i++, p--) {
					v1 += cpf[i] * p; 
				} 

				v1 = ((v1 * 10) % 11);

				if (v1 == 10) {
					v1 = 0; 
				}

				if (v1 != cpf[9]) {
					alert("CNPJ/CPF Inválido!");
					$("#cpf").focus();
					return false; 
				} 

				for (var i = 0, p = 11; (cpf.length - 1) > i; i++, p--) {
					v2 += cpf[i] * p; 
				} 

				v2 = ((v2 * 10) % 11);

				if (v2 == 10) {
					v2 = 0; 
				}

				if (v2 != cpf[10]) {
					alert("CNPJ/CPF Inválido!");
					$("#cpf").focus();
					return false; 
				} else { 
					return true; 
				}
			} else if (cpf.length == 14) {
				var cnpj = val.trim();
                
				cnpj = cnpj.replace(/\./g, '');
				cnpj = cnpj.replace('-', '');
				cnpj = cnpj.replace('/', ''); 
				cnpj = cnpj.split(''); 

				var v1 = 0;
				var v2 = 0;
				var aux = false;

				for (var i = 1; cnpj.length > i; i++) { 
					if (cnpj[i - 1] != cnpj[i]) {  
						aux = true;   
					} 
				} 

				if (aux == false) {  
					alert("CNPJ/CPF Inválido!");
					$("#cpf").focus();
					return false; 
				}

				for (var i = 0, p1 = 5, p2 = 13; (cnpj.length - 2) > i; i++, p1--, p2--) {
					if (p1 >= 2) {  
						v1 += cnpj[i] * p1;  
					} else {  
						v1 += cnpj[i] * p2;  
					} 
				} 

				v1 = (v1 % 11);

				if (v1 < 2) { 
					v1 = 0; 
				} else { 
					v1 = (11 - v1); 
				} 

				if (v1 != cnpj[12]) { 
					alert("CNPJ/CPF Inválido!");
					$("#cpf").focus();						   
					return false; 
				} 

				for (var i = 0, p1 = 6, p2 = 14; (cnpj.length - 1) > i; i++, p1--, p2--) { 
					if (p1 >= 2) {  
						v2 += cnpj[i] * p1;  
					} else {   
						v2 += cnpj[i] * p2; 
					} 
				}

				v2 = (v2 % 11); 

				if (v2 < 2) {  
					v2 = 0;
				} else { 
					v2 = (11 - v2); 
				} 

				if (v2 != cnpj[13]) { 
					alert("CNPJ/CPF Inválido!");
					$("#cpf").focus();						   
					return false; 
				} else {     
					return true;  
				}
			} else {
				alert("CNPJ/CPF Inválido!");
				$("#cpf").focus();						   
				return false;
			}
})		


});

function limpa_formulario_cep() {
    // Limpa valores do formulário de cep.
    $("#txtEndereco").val("");
    $("#txtBairro").val("");
    $("#txtCidade").val("");
    $("#txtUF").val("");
 }
		//Quando o campo cep perde o foco.
		$("#cep").blur(function() {

			//Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');
 
				//Verifica se campo cep possui valor informado.
                if (cep != "") {
					//Preenche os campos com "..." enquanto consulta webservice.
					$("#txtEndereco").val("...");
					$("#txtBairro").val("...");
					$("#txtCidade").val("...");
					$("#txtUF").val("...");

                       //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#txtEndereco").val(dados.logradouro);
                                $("#txtBairro").val(dados.bairro);
                                $("#txtCidade").val(dados.localidade);
                                $("#txtUF").val(dados.uf);
                            }
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulario_cep();
                                alert("CEP não encontrado.");
                            }
                        });
				}
				else{
					//cep sem valor, limpa formulário.
                    limpa_formulario_cep();

				}
		});
function pesquisar(){
	var value = $('#txtPesquisar').val();
	$("#listagem").load("../../ajax/pag/ajOperadora.php",{select:value});
	return false;    
}
function limpaFormIncluir()  {
    limpa_formulario_cep(); 
    $("#id").val("");                           
    $("#cep").val("");
    $("#cpf").val("");
    $("#txtOperadora").val("");                           
    $("#txtNomeAbrev").val("");                                                             
    $("#txtNumero").val("");                           
    $("#txtComplemento").val("");
    $("#txtObservacao").val("");
    $("#txtPesquisar").prop("disabled", false);                           
    pesquisar();
}  
function processaInclusao(){
    dados = $("#frmIncluir").serializeObject();
    $("#listagem").load("../../ajax/pag/ajOperadoraInclusao.php",dados);
    return false;
}   
function operadoraElimina(id){
		  var url="../../ajax/pag/ajOperadoraElimina.php?id="+id;
                        
			let xhr = new XMLHttpRequest();
			xhr.open('GET', url, true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200)
                        if(xhr.responseText=="DEU RUIM"){
                           alert("Deu ruim");
                           }
                        else{
                           alert("Operadora eliminada com sucesso!");
                           pesquisar();
                           }
					}
				}
				xhr.send();  
}                           
                           
function alterando(){
        $("input").prop("disabled", false);
        $("textarea").prop("disabled", false);
        $("#salvar" ).prop( "disabled", false );
        $("#cancelar" ).prop( "disabled", false );
        $("#alterar" ).prop( "disabled", true );
        $("#txtPesquisar").prop("disabled", false);
    };
function cancelar(){
        $("input").prop("disabled", true);
        $("textarea").prop("disabled", true); 
        $("#salvar" ).prop( "disabled", true );
        $("#cancelar" ).prop( "disabled", true );
        $("#alterar" ).prop( "disabled", false );
        $("#txtPesquisar").prop("disabled", false);
        location.reload();                           
    };
function salvar(){
        $("input").prop("disabled", true);
        $("textarea").prop("disabled", true); 
        $("#salvar" ).prop( "disabled", true);
        $("#cancelar" ).prop( "disabled",false  );
        $("#alterar" ).prop( "disabled", true );
        $("#txtPesquisar").prop("disabled", false);
    };
                           
function btnIncluir(){
    limpaFormIncluir();
    $("input").prop("disabled", false);
    $("textarea").prop("disabled", false); 
    $("#salvar" ).prop( "disabled", false );
    $("#cancelar" ).prop( "disabled", false );
    $("#alterar" ).prop( "disabled", true );   
    $("#id").prop("disabled", true);
    $("#txtPesquisar").prop("disabled", false);                           
    $("#cpf").focus();                           
};
                           
function btnAlterar(id,logo,cnpj,operadora,nome_abrev,cep,endereco,numero,complemento,bairro,cidade,uf,situacao,observacao){
    $("#id").val(id);            
    $("#cpf").val(cnpj);
    $("#txtOperadora").val(operadora);
    $("#txtNomeAbrev").val(nome_abrev);
    $("#cep").val(cep);
    $("#txtEndereco").val(endereco);
    $("#txtNumero").val(numero);
    $("#txtComplemento").val(complemento);                           
    $("#txtBairro").val(bairro);
    $("#txtCidade").val(cidade);
    if(situacao==1){
        $("#chkSituacao").prop("checked", true);                   
                           }                   
    else{
        $("#chkSituacao").prop("checked", false);                                              
                           }
    $("#txtUF").val(uf);                           
    $("#chkSituacao").val(situacao);                           
    $("#txtObservacao").val(observacao);      
                           
    $("input").prop("disabled", true);
    $("textarea").prop("disabled", true); 
    $("#salvar" ).prop( "disabled", true );
    $("#cancelar" ).prop( "disabled", false );
    $("#alterar" ).prop( "disabled", false );   
    $("#id").prop("disabled", true);
    $("#cpf").focus();                              
};   

function contatoOperadoras(id){
    $("#contatoOperadoras").load("../../ajax/pag/ajOperadoraContato.php/?id="+id);
    return false;                                                  
};