// JavaScript Document

$( document ).ready(function() {
 
    $("#cboCorretora").change(function(){
        $("#cboVendedor").html('<option value="">Carregando...</option>');
        $.post('../../ajax/pag/ajVendasVendedor.php', {'corretora': $(this).val() }, function(data){
            $("#cboVendedor").html(data);
        });
       pesquisar();
    }); 

    $("#cboMes").change(function(){
        pesquisar();
    }); 

    $("#cboTipo").change(function(){
        $("#cboOperadora").html('<option value="">Carregando...</option>');
        $.post('../../ajax/pag/ajVendasOperadora.php', {'tipoPlano': $(this).val() }, function(data){
            $("#cboOperadora").html(data);
        });
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
    var mes         = $('#cboMes').val();
	var tipo        = $('#cboTipo').val();
    var operadora   = $('#cboOperadora').val();
	var corretora   = $('#cboCorretora').val();
    var vendedor    = $('#cboVendedor').val();
    $("#listagem").load("../../ajax/pag/ajVendas.php",{cliente:nomeCliente,mes:mes,tipo:tipo,operadora:operadora,corretora:corretora,vendedor:vendedor});   
}  

function vendasDetalhe(id){
    $("#vendasDetalhes").load("../../ajax/pag/ajVendasDetalhe.php",{id:id});
    return false;                                                  
};
function emite(id){
    var idVenda = id;
		  var url="../../ajax/pag/ajVendaEmite.php?id="+idVenda;
			let xhr = new XMLHttpRequest();
			xhr.open('GET', url, true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200)
                        if(xhr.responseText=="Sim"){
                           alert("Status da proposta alterada com sucesso.");
							var el = document.getElementById(id);
							el.style.color = 'green';
                           }
                        else{
                           alert("Não foi possível mudar o Status da proposta.");
                        }
					}
				}
				xhr.send(); 
};
function cancela(id){
    var idVenda = id;

		  var url="../../ajax/pag/ajVendaCancela.php?id="+idVenda;
			let xhr = new XMLHttpRequest();
			xhr.open('GET', url, true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200)
                        if(xhr.responseText=="Sim"){
                           alert("Status da proposta alterada com sucesso.");
							var el = document.getElementById(id);
							el.style.color = 'red';
                           }
                        else{
                           alert("Não foi possível mudar o Status da proposta.");
                        }
					}
				}
				xhr.send(); 
};

function codigoEmpresa(id,valor){
		  var url="../../ajax/pag/ajVendaCarteirinha.php?id="+id+"&codigo="+valor;
			let xhr = new XMLHttpRequest();
			xhr.open('GET', url, true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200)
                        if(xhr.responseText=="Sim"){
							var el = document.getElementById(id);
							el.style.color = 'green';
							var idCampo = "txt"+id;
							$("#"+idCampo).html(valor);
                           }
                        else{
                           alert("Não foi possível mudar o Status da proposta.");
                        }
					}
				}
				xhr.send(); 
};

function codigoBeneficiario(id,valor,idVenda){
		  var url="../../ajax/pag/ajVendaCarteirinhaBeneficiario.php?id="+id+"&codigo="+valor;
			let xhr = new XMLHttpRequest();
			xhr.open('GET', url, true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200)
                        if(xhr.responseText=="Sim"){
							var el = document.getElementById(id);
							el.style.color = 'green';
							var el = document.getElementById(idVenda);
							el.style.color = 'green';
							var idCampo = "txt"+id;
							
							$("#"+idCampo).html(valor);
                           }
                        else{
                           alert("Não foi possível mudar o Status da proposta.");
                        }
					}
				}
				xhr.send(); 
};