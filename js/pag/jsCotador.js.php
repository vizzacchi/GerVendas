// JavaScript Document

$(document).ready(function(){
	
    $( "#cboTipoPlano" ).change(function(){
    	if($(this).val()=='PJ'){
        	$("#PJ").show();
            $("#PF").hide();
   		 }else{
         	$("#PJ").hide();
            $("#PF").show();
         }
    })
})

	function processaPesquisa(){
		dados = $("#formCotacao").serializeObject();
		$("#resultadoPesquisa").load("../../ajax/pag/ajCotacao.php",dados);
		return false;

	}	
