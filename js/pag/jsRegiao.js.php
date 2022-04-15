// JavaScript Document
// JavaScript Document

$(document).ready(function(){

});

function pesquisar(){              
	var operadora = $('#cboOperadora').val();
    $("#listagem").load("../../ajax/pag/ajRegiao.php",{select:operadora});
	return false;    
}  
