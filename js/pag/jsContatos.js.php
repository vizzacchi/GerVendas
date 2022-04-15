// JavaScript Document
// JavaScript Document

$(document).ready(function(){
  
    $('input[id="chkSituacao"]').on('change', function() {
        $(this).val(1);
      });
});

function pesquisar(){              
	var operadora = $('#cboOperadora').val();
    var situacao  = $('#cboSituacao').val();
    $("#listagem").load("../../ajax/pag/ajContatos.php",{select:operadora,status:situacao});
    $('#cod_oper').val($('#cboOperadora').val());
    $('#cboSituacao').prop("disabled", false);
	return false;    
}  
function validaEmail(){
    var email= $('#txtEmail').val();
    var url="../../ajax/pag/ajContatosValidaEmail.php?email="+email;
			let xhr = new XMLHttpRequest();
			xhr.open('GET', url, true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200)
                        if(xhr.responseText=="Email já existe"){
                           alert("Email já existe na base de dados, escolha outro!");
                           $('#txtSetor').focus();
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
    $("#cod_oper").prop("disabled", false);                           
    $("#txtNome").prop("disabled", false);
    $("#txtSetor").prop("disabled", false); 
    $("#txtEmail" ).prop( "disabled", false );
    $("#txtTelefone" ).prop( "disabled", false );
    $("#txtRamal" ).prop( "disabled", false );                           
    $("#txtCelular" ).prop( "disabled", false );                           
    $("#chkSituacao" ).prop( "disabled", false );                           
    $("#cancelar" ).prop( "disabled", false );
    $("#alterar" ).prop( "disabled", true );
    $("#salvar").prop("disabled", false);                           
    $("#id").val("");                           
    $("#txtNome").val("");
    $("#txtSetor").val("");                           
    $("#txtEmail").val("");                                                             
    $("#txtTelefone").val("");
    $("#txtRamal").val("");  
    $("#txtCelular").val("");                             
    $("#chkSituacao").prop("checked", false);                           
    $("#txtNome").focus();     
};
function cancelando(){
    $("#id").val("");                           
    $("#txtNome").val("");
    $("#txtSetor").val("");                           
    $("#txtEmail").val("");                                                             
    $("#txtTelefone").val("");
    $("#txtRamal").val("");  
    $("#txtCelular").val("");                             
    $("#chkSituacao").prop("checked", false);                           
    $("#id").prop("disabled", true);
    $("#txtNome").prop("disabled", true);                           
    $("#txtSetor").prop("disabled", true);
    $("#txtEmail").prop("disabled", true); 
    $("#txtTelefone" ).prop( "disabled", true );
    $("#txtRamal" ).prop( "disabled", true );
    $("#txtCelular" ).prop( "disabled", true );
    $("#chkSituacao" ).prop( "disabled", true );
    $("#chkVendedor" ).prop( "disabled", true );                           
    $("#cancelar" ).prop( "disabled", false);
    $("#alterar" ).prop( "disabled", true);
    $("#salvar").prop("disabled", true);                           
};  
function processaInclusao(){
    dados = $("#frmIncluir").serializeObject();
    $("#listagem").load("../../ajax/pag/ajContatoInclusao.php",dados);
    return false;
}                            
function btnAlterar(id,cod_oper,nome,setor,email,telefone,ramal,celular,situacao){   
    $("#id").val(id);            
    $("#txtCod_oper").val(cod_oper);
    $("#txtNome").val(nome);
    $("#txtSetor").val(setor);
    $("#txtEmail").val(email);
    $("#txtTelefone").val(telefone);
    $("#txtRamal").val(ramal);
    $("#txtCelular").val(celular);                           
    if(situacao==1){
        $("#chkSituacao").prop("checked", true);                   
    }                   
    else{
        $("#chkSituacao").prop("checked", false);                                          
    }
    $("#alterar").prop("disabled", false); 
    $("#cancelar").prop("disabled", false);                       
    $("#txtNome").focus();
    $("#id").prop("disabled", true);
    $("#txtNome").prop("disabled", true);                           
    $("#txtSetor").prop("disabled", true);
    $("#txtEmail").prop("disabled", true); 
    $("#txtTelefone").prop("disabled", true); 
    $("#txtRamal").prop("disabled", true); 
    $("#txtCelular" ).prop( "disabled", true );
    $("#chkSituacao" ).prop( "disabled", true );
};   
function alterando(){
    $("#id").prop("disabled", false);
    $("#id").prop("readonly", true);                
    var id= $('#id').val();
    $("#txtNome").prop("disabled", false);                      
    $("#txtSetor").prop("disabled", false);
    $("#txtEmail").prop("disabled", false);
    $("#txtTelefone").prop("disabled", false);
    $("#txtRamal").prop("disabled", false);
    $("#txtCelular" ).prop( "disabled", false );
    $("#chkSituacao" ).prop( "disabled", false );
    $("#salvar" ).prop( "disabled", false );
    $("#cancelar" ).prop( "disabled", false );
    $("#alterar" ).prop( "disabled", true );
    };
function contatoElimina(id){
		  var url="../../ajax/pag/ajContatoElimina.php?id="+id;
			let xhr = new XMLHttpRequest();
			xhr.open('GET', url, true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200)
                        if(xhr.responseText=="DEU RUIM"){
                           alert("Não foi possível eliminar o contato.");
                           }
                        else{
                           alert("Contato eliminado com sucesso!");
                           pesquisar();
                           }
					}
				}
				xhr.send();  
}                           
                           
                           
                           