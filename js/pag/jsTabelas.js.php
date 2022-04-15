// JavaScript Document
// JavaScript Document

function pesquisar(){              
	var operadora = $('#cboOperadora').val();
    var situacao  = $('#cboSituacao').val();
    $("#listagem").load("../../ajax/pag/ajTabelas.php",{select:operadora,status:situacao});
    $('#cod_oper').val($('#cboOperadora').val());
    $('#cboSituacao').prop("disabled", false);
    mudaPlano();
    return false;   

}  

function mudaPlano(){
    var operadora = $('#cboOperadora').val();
    var situacao  = $('#cboSituacao').val();
    $.post("../../ajax/pag/ajTabelasPlanos.php", {select:operadora,status:situacao},
	                  function(valor){
	                     $("#txtPlano").html(valor);
	                  })
}

function validarPlano(){
    
    var plano = $('#txtPlano').val();

		  var url="../../ajax/pag/ajTabelaBuscaPlano.php?plano="+plano;
			let xhr = new XMLHttpRequest();
			xhr.open('GET', url, true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200)
                        if(xhr.responseText=="Não"){
                           alert("Não temos tabela cadastrada para esse plano ainda.");
                           }
                        else{
                           alert("Já temos tabela cadastrada para esse plano.");
                           var chave = xhr.responseText;
                           var chaveAlt = chave.split(/\s*;\s*/);
                           btnAlterar(chaveAlt[0],chaveAlt[1],chaveAlt[2],chaveAlt[3],chaveAlt[4],chaveAlt[5],chaveAlt[6],chaveAlt[7],chaveAlt[8],chaveAlt[9],chaveAlt[10],chaveAlt[11],chaveAlt[12],chaveAlt[13],chaveAlt[14],chaveAlt[15],chaveAlt[16],chaveAlt[17]);
                        }
					}
				}
				xhr.send(); 
}

function btnIncluir(){
    $("#cod_oper").prop("disabled", false);                           
    $("#txtValidade").prop("disabled", false);
    $("#txtPlano").prop("disabled", false); 
    $("#cboUmTitular" ).prop( "disabled", false );
    $("#cboCompulsorio" ).prop( "disabled", false );
    $("#txtVidasIni" ).prop( "disabled", false );                           
    $("#txtVidasFim" ).prop( "disabled", false );                           
    $("#cboTabela" ).prop( "disabled", false );                           
    $("#txtFaixa1" ).prop( "disabled", false );                           
    $("#txtFaixa2" ).prop( "disabled", false );                           
    $("#txtFaixa3" ).prop( "disabled", false );                           
    $("#txtFaixa4" ).prop( "disabled", false );                           
    $("#txtFaixa5" ).prop( "disabled", false );                           
    $("#txtFaixa6" ).prop( "disabled", false );                           
    $("#txtFaixa7" ).prop( "disabled", false );                           
    $("#txtFaixa8" ).prop( "disabled", false );                           
    $("#txtFaixa9" ).prop( "disabled", false );                           
    $("#txtFaixa10" ).prop( "disabled", false );                           
    $("#cancelar" ).prop( "disabled", false );
    $("#alterar" ).prop( "disabled", true );
    $("#salvar").prop("disabled", false);                           
    $("#id").val("");
    $("#txtValidade").val("");
    $("#txtPlano").val("");
    $("#cboUmTitular" ).selectIndex=0;
    $("#cboCompulsorio" ).selectindex=0;
    $("#txtVidasIni" ).val("");                           
    $("#txtVidasFim" ).val("");
    $("#cboTabela" ).selectIndex=0;
    $("#txtFaixa1" ).val("");
    $("#txtFaixa2" ).val("");
    $("#txtFaixa3" ).val("");
    $("#txtFaixa4" ).val("");
    $("#txtFaixa5" ).val("");
    $("#txtFaixa6" ).val("");
    $("#txtFaixa7" ).val("");
    $("#txtFaixa8" ).val("");
    $("#txtFaixa9" ).val("");
    $("#txtFaixa10" ).val("");
    $("#txtValidade").focus();     
};
function cancelando(){
    $("#id").val("");
    $("#txtValidade").val("");
    $("#txtPlano").val("");
    $("#cboUmTitular" ).selectIndex=0;
    $("#cboCompulsorio" ).selectindex=0;
    $("#txtVidasIni" ).val("");                           
    $("#txtVidasFim" ).val("");
    $("#cboTabela" ).selectIndex=0;
    $("#txtFaixa1" ).val("");
    $("#txtFaixa2" ).val("");
    $("#txtFaixa3" ).val("");
    $("#txtFaixa4" ).val("");
    $("#txtFaixa5" ).val("");
    $("#txtFaixa6" ).val("");
    $("#txtFaixa7" ).val("");
    $("#txtFaixa8" ).val("");
    $("#txtFaixa9" ).val("");
    $("#txtFaixa10" ).val("");

    $("#cod_oper").prop("disabled", true);                           
    $("#txtValidade").prop("disabled", true);
    $("#txtPlano").prop("disabled", true); 
    $("#cboUmTitular" ).prop( "disabled", true );
    $("#cboCompulsorio" ).prop( "disabled", true );
    $("#txtVidasIni" ).prop( "disabled", true );                           
    $("#txtVidasFim" ).prop( "disabled", true );                           
    $("#cboTabela" ).prop( "disabled", true );                           
    $("#txtFaixa1" ).prop( "disabled", true );                           
    $("#txtFaixa2" ).prop( "disabled", true );                           
    $("#txtFaixa3" ).prop( "disabled", true );                           
    $("#txtFaixa4" ).prop( "disabled", true );                           
    $("#txtFaixa5" ).prop( "disabled", true );                           
    $("#txtFaixa6" ).prop( "disabled", true );                           
    $("#txtFaixa7" ).prop( "disabled", true );                           
    $("#txtFaixa8" ).prop( "disabled", true );                           
    $("#txtFaixa9" ).prop( "disabled", true );                           
    $("#txtFaixa10" ).prop( "disabled", true );                           
};  
function processaInclusao(){
    dados = $("#frmIncluir").serializeObject();
    $("#listagem").load("../../ajax/pag/ajTabelaInclusao.php",dados);
    return false;
}                            
function btnAlterar(id,validade,plano,umTitular,compulsorio,vidas_ini,vidas_fim,tabela,faixa1,faixa2,faixa3,faixa4,faixa5,faixa6,faixa7,faixa8,faixa9,faixa10){   
    $("#id").val(id);            
    $("#txtCod_oper").val(cod_oper);
    $("#txtValidade").val(validade);
    $("#txtPlano").val(plano);
    $("#cboUmTitular").val(umTitular);
    $("#cboCompulsorio").val(compulsorio);
    $("#txtVidasIni").val(vidas_ini);
    $("#txtVidasFim").val(vidas_fim);
    $("#cboTabela").val(tabela);
    $("#txtFaixa1").val(faixa1);
    $("#txtFaixa2").val(faixa2);
    $("#txtFaixa3").val(faixa3);
    $("#txtFaixa4").val(faixa4);
    $("#txtFaixa5").val(faixa5);
    $("#txtFaixa6").val(faixa6);
    $("#txtFaixa7").val(faixa7);
    $("#txtFaixa8").val(faixa8);
    $("#txtFaixa9").val(faixa9);
    $("#txtFaixa10").val(faixa10);
    $("#alterar").prop("disabled", false); 
    $("#cancelar").prop("disabled", false); 
    $("#salvar").prop("disabled",true);
    $("#txtFaixa1").focus();
    $("#cod_oper").prop("disabled", true);                           
    $("#txtValidade").prop("disabled", true);
    $("#txtPlano").prop("disabled", true); 
    $("#cboUmTitular" ).prop( "disabled", true );
    $("#cboCompulsorio" ).prop( "disabled", true );
    $("#txtVidasIni" ).prop( "disabled", true );                           
    $("#txtVidasFim" ).prop( "disabled", true );                           
    $("#cboTabela" ).prop( "disabled", true );                           
    $("#txtFaixa1" ).prop( "disabled", true );                           
    $("#txtFaixa2" ).prop( "disabled", true );                           
    $("#txtFaixa3" ).prop( "disabled", true );                           
    $("#txtFaixa4" ).prop( "disabled", true );                           
    $("#txtFaixa5" ).prop( "disabled", true );                           
    $("#txtFaixa6" ).prop( "disabled", true );                           
    $("#txtFaixa7" ).prop( "disabled", true );                           
    $("#txtFaixa8" ).prop( "disabled", true );                           
    $("#txtFaixa9" ).prop( "disabled", true );                           
    $("#txtFaixa10" ).prop( "disabled", true );
    
};   

function alterando(){
alert("Alterando");
    $("#id").prop("disabled", false);
    $("#cod_oper").prop("disabled", false);                           
    $("#txtValidade").prop("disabled", false);
    $("#txtPlano").prop("disabled", false); 
    $("#cboUmTitular" ).prop( "disabled", false );
    $("#cboCompulsorio" ).prop( "disabled", false );
    $("#txtVidasIni" ).prop( "disabled", false );                           
    $("#txtVidasFim" ).prop( "disabled", false );                           
    $("#cboTabela" ).prop( "disabled", false );                           
    $("#txtFaixa1" ).prop( "disabled", false );                           
    $("#txtFaixa2" ).prop( "disabled", false );                           
    $("#txtFaixa3" ).prop( "disabled", false );                           
    $("#txtFaixa4" ).prop( "disabled", false );                           
    $("#txtFaixa5" ).prop( "disabled", false );                           
    $("#txtFaixa6" ).prop( "disabled", false );                           
    $("#txtFaixa7" ).prop( "disabled", false );                           
    $("#txtFaixa8" ).prop( "disabled", false );                           
    $("#txtFaixa9" ).prop( "disabled", false );                           
    $("#txtFaixa10" ).prop( "disabled", false ); 
    $("#alterar").prop("disabled", true); 
    $("#cancelar").prop("disabled", false); 
    $("#salvar").prop("disabled",false);
};

function tabelaElimina(id){
		  var url="../../ajax/pag/ajTabelaElimina.php?id="+id;
			let xhr = new XMLHttpRequest();
			xhr.open('GET', url, true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200)
                        if(xhr.responseText=="DEU RUIM"){
                           alert("Não foi possível eliminar o tabela.");
                           }
                        else{
                           alert("Tabela eliminada com sucesso!");
                           pesquisar();
                           }
					}
				}
				xhr.send();  
}                           
                           
                           
                           