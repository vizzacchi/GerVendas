// JavaScript Document
 
function processaPesquisa(){
	dados = $("#frmPesquisar").serializeObject();

    $("#listagem").load("../../ajax/pag/ajVendaInternaPesquisa.php",dados);
    return false;
}    

function tipoPagto(){
	alert($("#cboTipo").val());
}

function Comprovante(){
	alert($("#cboCompr").val());
}
function Extrato(){
	alert($("#cboExtr").val());
}
                        
                           
                           
                           