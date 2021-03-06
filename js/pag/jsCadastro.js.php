// JavaScript Document

$( document ).ready(function() {
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();	


    function limpa_formulário_cep() {
		// Limpa valores do formulário de cep.
		$("#txtEndereco").val("");
        $("#txtNumero").val("");
		$("#txtBairro").val("");
		$("#txtCidade").val("");
		$("#txtUF").val("");
        $("#txtComplemento").val("");
	 }
 
    $("#cboCorretora").change(function(){
        $("#cboCorretor").html('<option value="">Carregando...</option>');
        $.post('../../ajax/pag/ajCadastroCorretor.php', {'corretora': $(this).val() }, function(data){
            $("#cboCorretor").html(data);
        });
    }); 
    $("#cboTipoPlano").change(function(){
        $("#cboOperadora").html('<option value="">Carregando...</option>');
        $.post('../../ajax/pag/ajCadastroCBOoperadora.php', {'tipoPlano': $(this).val() }, function(data){
            $("#cboOperadora").html(data);
        });
        if($(this).val()=='PF'){
            $("#nomeTitular").html('Nome Titular:');
            $("#cpf").html('CPF:');
            $("#cboTipoBeneficiario").html('<option value=0>Titular</option>');
            $("#txtEntidade").val('PF');
        }
        else{
            $("#nomeTitular").html('Razão Social:');
            $("#cpf").html('CNPJ:');    
            $("#cboTipoBeneficiario").html('<option value=2>Responsável</option>');
            $("#txtEntidade").val('PJ');
        }
    }); 
    $("#cboOperadora").change(function(){
        $("#cboPlano").html('<option value="">Carregando...</option>');
        $.post('../../ajax/pag/ajCadastroCBOplano.php', {'operadora': $(this).val(),'tipoPlano': $("#cboTipoPlano").val() }, function(data){
            $("#cboPlano").html(data);
        });
    	if($("#cboOperadora").val()==60){
			$.post('../../ajax/pag/ajCadastroContratoUnimed.php', {'operadora': $(this).val(),'tipoPlano': $("#cboTipoPlano").val() }, function(data){
				$("#txtContrato").val(data);
			});
		}else{
			$("#txtContrato").val('');
		}
	}); 
    $("#txtNome").change(function(){
        if($("#cboTipoPlano").val()=='PF'){
            $("#txtTitularNome").attr('value', $(this).val() );
        }
    }); 
    $("#txtCPF").change(function(){
        if($("#cboTipoPlano").val()=='PF'){
            $("#txtCPFtitular").attr('value', $(this).val() );
        }
    });
    $("#txtTelefone1").change(function(){
        if($("#cboTipoPlano").val()=='PF'){
            $("#txtTelefone1Titular").attr('value', $(this).val() );
        }
    });
    $("#txtTelefone2").change(function(){
        if($("#cboTipoPlano").val()=='PF'){
            $("#txtTelefone2Titular").attr('value', $(this).val() );
        }
    });
    $("#txtEmail").change(function(){
        if($("#cboTipoPlano").val()=='PF'){
            $("#txtEmailTitular").attr('value', $(this).val() );
        }
    });
	$("#cboDepTitular").blur(function(){
		var tipo = $("#cboDepTitular").val();
		if (!isNaN(tipo)){
			$("#cboDepTipo").val(1);
			$("#depNome").val("");
			
		} else{
			$("#cboDepTipo").val(0);
			$("#depNome").val($("#depTitular").val());
		}
	});
	$("#txtDtNascimento").blur(function() {
		var nascimento = new Date($("#txtDtNascimento").val());
		var hoje       = new Date();
		var intervalo = hoje - nascimento;
		var idade = (intervalo / (1000 * 60 * 60 * 24 * 365.25));
		if(idade < 0.0001 || idade>100 ){
			alert("A idade informada foi "+Math.trunc(idade)+" informe outra data.");
			$("#txtDtNascimento").val("");
			$("#txtDtNascimento").focus();
		}
	});
		$("#depDtNascimento").blur(function() {
		var nascimento = new Date($("#depDtNascimento").val());
		var hoje       = new Date();
		var intervalo = hoje - nascimento;
		var idade = (intervalo / (1000 * 60 * 60 * 24 * 365.25));
		if(idade < 0.0001 || idade>100 ){
			alert("A idade informada foi "+Math.trunc(idade)+" informe outra data.");
			$("#depDtNascimento").val("");
			$("#depDtNascimento").focus();
		}
	});
			
	$("#txtVigencia").blur(function() {
		var nascimento = new Date($("#txtVigencia").val());
		var hoje       = new Date();
		var intervalo = nascimento - hoje;
		var idade = (intervalo / (86400000));
		if(idade < -30 || idade> 30 ){
			alert("A vigência informada está "+Math.trunc(idade)+" dias de hoje.");
			$("#txtVigencia").val("");
			$("#txtVigencia").focus();
		}
	});
	
	$("#txtContrato").blur(function(){
		var contrato = $("#txtContrato").val();
		  var url="../../ajax/pag/ajCadastroVerifContrato.php?contrato="+contrato;
			let xhr = new XMLHttpRequest();
			xhr.open('GET', url, true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200)
                        if(xhr.responseText=="Sim"){
                           }
						else{
							alert(xhr.responseText);
						}
					}
				}
				xhr.send(); 
			
	});

    //Quando o campo cep perde o foco.
    $("#txtCep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {
                //Preenche os campos com "..." enquanto consulta webservice.
                $("#txtEndereco").val("...");
                $("#txtNumero").val("...");
                $("#txtComplemento").val("...");
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
                            $("#txtComplemento").val("");
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
            }
            else{
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();

            }
     });
});

    function teclas(event) {
      return ((event.charCode >= 48 && event.charCode <= 57) || (event.keyCode == 44 ));
    };
                                                           
	function validaCPF(teste){
		var val = document.getElementById(teste).value;
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
					$("#"+teste).focus();
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
					$("#"+teste).focus();
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
					$("#"+teste).focus();
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
					$("#"+teste).focus();
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
					$("#"+teste).focus();						   
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
					$("#"+teste).focus();						   
					return false; 
				} else {     
					return true;  
				}
			} else {
				alert("CNPJ/CPF Inválido!");
				$("#"+teste).focus();						   
				return false;
			}
        };	
                           
function processaInclusao(){
	if($('#cboCorretora').val()=="" 		|| 
	 	$('#cboCorretor').val()=="" 		|| 
		$('#cboTipoPlano').val()=="" 		|| 
		$('#txtNome').val()=="" 			||
		$('#txtCPF').val()=="" 				|| 
		$('#txtVigencia').val() == "" 		|| 
		$('#txtVigencia').val()=="" 		|| 
		$('#txtVencimento').val()==0 		||
	    $('#txtVencimento').val() =="" 		|| 
		$('#cboOperadora').val() =="" 		|| 
		$('#cboPlano').val()== ""       	||
		$('#txtContrato').val()=="" 		||
		$('#txtNumVidas').val()=="" 		||
		$('#txtValor').val()=="" 			||
		$('#txtCep').val()=="" 				||
		$('#txtEndereco').val()==""			||
		$('#txtBairro').val()==""			||
		$('#txtCidade').val()==""			||
		$('#txtUF').val()==""				||
		$('#txtTelefone1').val()==""		||
		$('#txtEmail').val()==""			||
		$('#txtDtNascimento').val()==""		||
		$('#txtCPFtitular').val()==""		||
		$('#txtTelefone1Titular').val()=="" ||
		$('#txtEmailTitular').val()==""
						   ){
						   alert("Existe campo obrigatório em branco!");
			return false;
						   }
						   
						   
						   
    dados = $("#frmCadastro").serializeObject();
    variaveis = JSON.stringify(dados);
    
    var url="../../ajax/pag/ajCadastroInclusao.php?dados="+variaveis;
			let xhr = new XMLHttpRequest();
			xhr.open('GET', url, false);
			xhr.send();
			if (xhr.readyState == 4){
				if (xhr.status == 200){
					if(xhr.responseText == "Proposta cadastrada com sucesso"){
					   alert(xhr.responseText);
						return true;
					}else{
					   if(xhr.responseText == "Não foi possível cadastrar a proposta"){
							alert(xhr.responseText);
							return false;
						}else{
						    alert("Cadastre mais beneficiários!")
						    const json = xhr.responseText;
						    const obj = JSON.parse(json);
						   var idVenda = obj.venda;
						   
						   $("#idVenda").val(idVenda);
						   
						   
						$("#cboDepTitular").html('<option value="">Carregando...</option>');
						$.post('../../ajax/pag/ajCadastroDepTitulares.php', {'id': idVenda}, function(data){
							$("#cboDepTitular").html(data);
						});						   
						   
						   $("#salvar").prop("disabled", true); 
						   $("#dependente").prop("disabled",false);
						   return false;
						}
					}
				}else{
					alert("Não foi possivel cadastrar a proposta - Request!!!");
					return false;
				}
			}	
};       
						   
function processaInclusaoBeneficiario(){
	var email 		= $("#depEmail").val();
	var telefone	= $("#depTelefone1").val();
	if(email=="" && $("#cboDepTipo").val()=="0"){
		alert("Para o titular o campo e-mail é obrigatório!");
		return false;
	}else{
		if(telefone=="" && $("#cboDepTipo").val()=="0"){
			alert("Para titular precisamos ter pelo menos um telefone informado!");
			return false;
		}else{
			if($("#depNome").val()=="" || $("#depCPF").val()==""){
				alert("Compo nome e CPF são obrigatórios");
				return false;
						   
			}else{			
				dados = $("#frmBeneficiario").serializeObject();
				$("#listagem").load("../../ajax/pag/ajCadastroBeneficiarios.php",dados);

							   $("#depTitular").val("");
							   $("#cboDepTipo").val("");
							   $("#depNome").val("");
							   $("#depSexo").val("");
							   $("#depDtNascimento").val("");
							   $("#depRG").val("");
							   $("#depCPF").val("");
							   $("#depTelefone1").val("");
							   $("#depTelefone2").val("");
							   $("#depEmail").val("");

							$('#cancelar').trigger('click');
							return false;   			
			}
		}
	}				   				   			   
};					   
function calcularIdade(data) {
	var now = new Date();
	var today = new Date(now.getYear(),now.getMonth(),now.getDate());

	var yearNow = now.getYear();
	var monthNow = now.getMonth();
	var dateNow = now.getDate();
	var dob = new Date(data.substring(6,10),
			data.substring(3,5)-1,                    
			 data.substring(0,2)                
			);

	var yearDob = dob.getYear();
	var monthDob = dob.getMonth();
	var dateDob = dob.getDate();
	var age = {};
	yearAge = yearNow - yearDob;

	if (monthNow >= monthDob)
		var monthAge = monthNow - monthDob;
	else {
		yearAge--;
		var monthAge = 12 + monthNow -monthDob;
	}

	if (dateNow >= dateDob)
		var dateAge = dateNow - dateDob;
	else {
		monthAge--;
	    var dateAge = 31 + dateNow - dateDob;

	    if (monthAge < 0) {
	      monthAge = 11;
	      yearAge--;
	    }
	  }

	age = {
			years: yearAge,
			months: monthAge,
			days: dateAge
		};
	return age.years;
}
                           

