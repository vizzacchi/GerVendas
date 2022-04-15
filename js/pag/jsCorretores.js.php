// JavaScript Document

$(document).ready(function(){
  
    $('input[id="chkSituacao"]').on('change', function() {
        $(this).val(1);
      });
    $('input[id="chkVendedor"]').on('change', function() {
        $(this).val(1);
      });
    $('input[id="chkFinanceiro"]').on('change', function() {
        $(this).val(1);
      });
    $('input[id="chkResponsavel"]').on('change', function() {
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

function pesquisar(){              
	var corretora = $('#cboCorretora').val();
    var situacao  = $('#cboSituacao').val();
	$("#listagem").load("../../ajax/pag/ajCorretores.php",{select:corretora,status:situacao});
    $('#id_corretora').val($('#cboCorretora').val());
    $('#cboSituacao').prop("disabled", false);
	return false;    
}  
function validaEmail(){
    var email= $('#txtEmail').val();
    var url="../../ajax/pag/ajCorretoresValidaEmail.php?email="+email;
			let xhr = new XMLHttpRequest();
			xhr.open('GET', url, true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200)
                        if(xhr.responseText=="Email já existe"){
                           alert("Email já existe na base de dados, escolha outro!");
                           $('#txtCorretor').focus();
                           return false;
                           }
                        else{
                           alert("Email OK!");
                           }
					}
				}
				xhr.send();
}
function btnIncluir(){
    $("#id").prop("disabled", true);
    $("#cpf").prop("disabled", false);                           
    $("#txtCorretor").prop("disabled", false);
    $("#txtEmail").prop("disabled", false); 
    $("#txtCelular" ).prop( "disabled", false );
    $("#chkSituacao" ).prop( "disabled", false );
    $("#chkVendedor" ).prop( "disabled", false );                           
    $("#chkFinanceiro" ).prop( "disabled", false );                           
    $("#chkResponsavel" ).prop( "disabled", false );                           
    $("#cboPerfil").prop("disabled", false);
    $("#cancelar" ).prop( "disabled", false );
    $("#alterar" ).prop( "disabled", true );
    $("#salvar").prop("disabled", false);                           
    $("#id").val("");                           
    $("#cpf").val("");
    $("#txtCorretor").val("");                           
    $("#txtEmail").val("");                                                             
    $("#txtCelular").val("");
    $("#chkSituacao").prop('checked', false);  
    $("#chkVendedor").prop('checked', false);                             
    $("#chkFinanceiro").prop('checked', false);                             
    $("#chkResponsavel" ).prop( "checked", false );                           
    $("#cboPerfil").selectedIndex = 0;                            
    $("#cpf").focus();     
};
function cancelando(){
    $("#id").val("");                           
    $("#cpf").val("");
    $("#txtCorretor").val("");                           
    $("#txtEmail").val("");                                                             
    $("#txtCelular").val("");
    $("#chkSituacao").prop('checked', false);  
    $("#chkVendedor").prop('checked', false);                             
    $("#chkFinanceiro").prop('checked', false);                             
    $("#chkResponsavel" ).prop( "checked", false );                           
    $("#cboPerfil").selectedIndex = 0;          
    $("#id").prop("disabled", true);
    $("#cpf").prop("disabled", true);                           
    $("#txtCorretor").prop("disabled", true);
    $("#txtEmail").prop("disabled", true); 
    $("#txtCelular" ).prop( "disabled", true );
    $("#chkSituacao" ).prop( "disabled", true );
    $("#chkVendedor" ).prop( "disabled", true );                           
    $("#chkFinanceiro" ).prop( "disabled", true );                           
    $("#chkResponsavel" ).prop( "disabled", true );                           
    $("#cboPerfil").prop("disabled", true);
    $("#cancelar" ).prop( "disabled", false);
    $("#alterar" ).prop( "disabled", true);
    $("#salvar").prop("disabled", true);                           
};  
function processaInclusao(){
    dados = $("#frmIncluir").serializeObject();
    $("#listagem").load("../../ajax/pag/ajCorretoresInclusao.php",dados);
    return false;
}                            
function btnAlterar(id,corretor,cpf,email,celular,situacao,vendedor,financeiro,responsavel,perfil){   
    $("#id").val(id);            
    $("#txtCorretor").val(corretor);
    $("#cpf").val(cpf);
    $("#txtEmail").val(email);
    $("#txtCelular").val(celular);                           
    if(situacao==1){
        $("#chkSituacao").prop("checked", true);                   
    }                   
    else{
        $("#chkSituacao").prop("checked", false);                                          
    }
    if(vendedor==1){
        $("#chkVendedor").prop("checked", true);                   
    }                   
    else{
        $("#chkVendedor").prop("checked", false);                                          
    }
    if(financeiro==1){
        $("#chkFinanceiro").prop("checked", true);                   
    }                   
    else{
        $("#chkFinanceiro").prop("checked", false);                                          
    }
    if(responsavel==1){
        $("#chkResponsavel").prop("checked", true);                   
    }                   
    else{
        $("#chkResponsavel").prop("checked", false);        
    } 
    $("#cboPerfil").val(perfil);
    $("#alterar").prop("disabled", false); 
    $("#cancelar").prop("disabled", false);                       
    $("#cpf").focus();
    $("#id").prop("disabled", true);
    $("#cpf").prop("disabled", true);                           
    $("#txtCorretor").prop("disabled", true);
    $("#txtEmail").prop("disabled", true); 
    $("#txtCelular" ).prop( "disabled", true );
    $("#chkSituacao" ).prop( "disabled", true );
    $("#chkVendedor" ).prop( "disabled", true );                           
    $("#chkFinanceiro" ).prop( "disabled", true );                           
    $("#chkResponsavel" ).prop( "disabled", true );                           
    $("#cboPerfil").prop("disabled", true);
                           
};   
function alterando(){
    $("#id").prop("disabled", false);
    $("#id").prop("readonly", true);                
    var id= $('#id').val();
    var url="../../ajax/pag/ajCorretoresComVenda.php?id="+id;
			let xhr = new XMLHttpRequest();
			xhr.open('GET', url, true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200)
                        if(xhr.responseText=="Com venda"){
                            $("#cpf").prop("readonly", true);                      
                            $("#txtCorretor").prop("readonly", true);
                            $("#txtEmail").prop("readonly", true); 
                           }
                        else{
                            $("#cpf").prop("readonly", false);                      
                            $("#txtCorretor").prop("readonly", false);
                            $("#txtEmail").prop("readonly", false);                          
                           }
					}
				}
				xhr.send();                           
    $("#cpf").prop("disabled", false);                      
    $("#txtCorretor").prop("disabled", false);
    $("#txtEmail").prop("disabled", false);
    $("#txtCelular" ).prop( "disabled", false );
    $("#chkSituacao" ).prop( "disabled", false );
    $("#chkVendedor" ).prop( "disabled", false);                           
    $("#chkFinanceiro" ).prop( "disabled", false );                           
    $("#chkResponsavel" ).prop( "disabled", false );                           
    $("#cboPerfil").prop("disabled", false);
    $("#salvar" ).prop( "disabled", false );
    $("#cancelar" ).prop( "disabled", false );
    $("#alterar" ).prop( "disabled", true );
    };
function corretorElimina(id){
		  var url="../../ajax/pag/ajCorretoresElimina.php?id="+id;
			let xhr = new XMLHttpRequest();
			xhr.open('GET', url, true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200)
                        if(xhr.responseText=="DEU RUIM"){
                           alert("Não foi possível eliminar o corretor.");
                           }
                        else{
                           alert("Corretor eliminado com sucesso!");
                           pesquisar();
                           }
					}
				}
				xhr.send();  
}                           
                           
                           
                           