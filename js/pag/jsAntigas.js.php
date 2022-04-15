// JavaScript Document

$( document ).ready(function() {
 
    $("#cboCorretora").change(function(){
        $("#cboVendedor").html('<option value="">Carregando...</option>');
        $.post('../../ajax/pag/ajAntigasVendedor.php', {'corretora': $(this).val() }, function(data){
            $("#cboVendedor").html(data);
        });
       pesquisar();
    }); 

    $("#cboBase").change(function(){
        $("#cboOperadora").html('<option value="">Carregando...</option>');
        $.post('../../ajax/pag/ajAntigasOperadora.php', {'base': $(this).val() }, function(data){
            $("#cboOperadora").html(data);
        });

        $("#cboVendedor").html('<option value="">Carregando...</option>');
        $.post('../../ajax/pag/ajAntigasCBOVendedor.php', {'base': $(this).val()}, function(data){
            $("#cboVendedor").html(data);
        });
        pesquisar();
    }); 

    $("#cboTipo").change(function(){
       pesquisar();
    });

    $("#cboOperadora").change(function(){
       pesquisar();
    });

    $("#cboVendedor").change(function(){
       pesquisar();
    });
    
});

function pesquisar(){ 
	var nomeCliente = $('#txtNomeCliente').val();
    var base        = $('#cboBase').val();
	var tipo        = $('#cboTipo').val();
    var operadora   = $('#cboOperadora').val();
	var corretora   = $('#cboCorretora').val();
    var vendedor    = $('#cboVendedor').val();
    $("#listagem").load("../../ajax/pag/ajAntigas.php",{cliente:nomeCliente,banco:base,tipo:tipo,operadora:operadora,corretora,corretora,vendedor:vendedor});   
}  

function antigasDetalhe(id){
    alert("jsAntigas");
    $("#antigasDetalhes").load("../../ajax/pag/ajAntigasDetalhe.php",{id:id});
    return false;                                                  
};