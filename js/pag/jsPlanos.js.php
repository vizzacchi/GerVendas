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
    $("#listagem").load("../../ajax/pag/ajPlanos.php",{select:operadora,status:situacao});
    $('#cod_oper').val($('#cboOperadora').val());
    $('#cboSituacao').prop("disabled", false);
	return false;    
}  
function btnIncluir(){
    $("#id").prop("disabled", true);
    $("#cod_oper").prop("disabled", false);                           
    $("#txtTipoPlano").prop("disabled", false);
    $("#txtPlano").prop("disabled", false); 
    $("#cboAcomodacao" ).prop( "disabled", false );
    $("#cboCoparticipacao" ).prop( "disabled", false );
    $("#chkSituacao" ).prop( "disabled", false );                           
    $("#cancelar" ).prop( "disabled", false );
    $("#alterar" ).prop( "disabled", true );
    $("#salvar").prop("disabled", false);                           
    $("#id").val("");                           
    $("#txtTipoPlano").val("");
    $("#txtPlano").val("");                           
    $("#cboAcomodacao").selectIndex=0;                                                        $("#cboCoparticipacao").selectIndex=0;                                                   
    $("#chkSituacao").prop("checked", false);                           
    $("#txtTipoPlano").focus();     
};
function cancelando(){
    $("#id").val("");                           
    $("#txtTipoPlano").val("");
    $("#txtPlano").val("");                           
    $("#cboAcomodacao").selectIndex=0;
    $("#cboCoparticipacao").selectIndex=0;
    $("#chkSituacao").prop("checked", false);                           
    $("#id").prop("disabled", true);
    $("#txtTipoPlano").prop("disabled", true);                           
    $("#txtPlano").prop("disabled", true);
    $("#cboAcomodacao").prop("disabled", true); 
    $("#cboCoparticipacao" ).prop( "disabled", true );
    $("#chkSituacao" ).prop( "disabled", true );
    $("#cancelar" ).prop( "disabled", false);
    $("#alterar" ).prop( "disabled", true);
    $("#salvar").prop("disabled", true);                           
};  
function processaInclusao(){
    dados = $("#frmIncluir").serializeObject();
    $("#listagem").load("../../ajax/pag/ajPlanoInclusao.php",dados);
    return false;
}                            
function btnAlterar(id,cod_oper,tipo_plano,plano,acomodacao,coparticipacao,situacao){   
    $("#id").val(id);            
    $("#txtCod_oper").val(cod_oper);
    $("#txtTipoPlano").val(tipo_plano);
    $("#txtPlano").val(plano);
    $("#cboAcomodacao").val(acomodacao);
    $("#cboCoparticipacao").val(coparticipacao);
    if(situacao==1){
        $("#chkSituacao").prop("checked", true);                   
    }                   
    else{
        $("#chkSituacao").prop("checked", false);                                          
    }
    $("#alterar").prop("disabled", false); 
    $("#cancelar").prop("disabled", false);                       
    $("#txtTipoPlano").focus();
    $("#id").prop("disabled", true);
    $("#txtTipoPlano").prop("disabled", true);                           
    $("#txtPlano").prop("disabled", true);
    $("#cboAcomodacao").prop("disabled", true); 
    $("#cboCoparticipacao").prop("disabled", true); 
    $("#chkSituacao" ).prop( "disabled", true );
};   
function alterando(){
    $("#id").prop("disabled", false);
    $("#id").prop("readonly", true);                
    var id= $('#id').val();
    $("#txtTipoPlano").prop("disabled", false);                      
    $("#txtPlano").prop("disabled", false);
    $("#cboAcomodacao").prop("disabled", false);
    $("#cboCoparticipacao").prop("disabled", false);
    $("#chkSituacao" ).prop( "disabled", false );
    $("#salvar" ).prop( "disabled", false );
    $("#cancelar" ).prop( "disabled", false );
    $("#alterar" ).prop( "disabled", true );
    };
function planoElimina(id){
		  var url="../../ajax/pag/ajPlanoElimina.php?id="+id;
			let xhr = new XMLHttpRequest();
			xhr.open('GET', url, true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200)
                        if(xhr.responseText=="DEU RUIM"){
                           alert("Não foi possível eliminar o plano.");
                           }
                        else{
                           alert("Plano eliminado com sucesso!");
                           pesquisar();
                           }
					}
				}
				xhr.send();  
}                           
                           
                           
                           