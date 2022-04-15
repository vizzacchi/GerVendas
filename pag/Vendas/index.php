<?php
include "../../inc/conexao.php";
include "../../inc/header.php";
?>
 <!--------------------- aqui começa a página----------------->
 <main class="container-fluid"> 

     <div class="bg-light p-5">
        <h1>Cadastro de Vendas Novas</h1>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    Corretora:
                </div>
                <div class="col-sm-6">
                    Vendedor:
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    Tipo: PJ
                </div>
                <div class="col-sm-6">
                    Razão Social:
                </div>
                <div class="col-sm-4">
                    CNPJ:
                </div>                 
            </div>             
            <div class="row">
                <div class="col-sm-4">
                    Mês: 
                </div>
                <div class="col-sm-4">
                    Vigência:
                </div>
                <div class="col-sm-4">
                    Vencimento:
                </div>            
            </div> 
            <div class="row">
                <div class="col-sm-4">
                    Contrato: 
                </div>
                <div class="col-sm-4">
                    Operadora:
                </div>
                <div class="col-sm-4">
                    Plano: 
                </div>                
            </div>    
            <div class="row">
                <div class="col-sm-4">
                    Núm.Vidas:
                </div>                 
                <div class="col-sm-4">
                    Valor:
                </div> 
            </div>    
            <hr>
            <div class="row">
                <div class="col-sm-2">
                    Cep: 
                </div>
                <div class="col-sm-4">
                    Endereço:
                </div>
                <div class="col-sm-2">
                    Número:
                </div> 
                <div class="col-sm-4">
                    Complemento:
                </div>                 
            </div> 
            <div class="row">
                <div class="col-sm-4">
                    Bairro: 
                </div>
                <div class="col-sm-4">
                    Cidade:
                </div>
                <div class="col-sm-2">
                    UF:
                </div>                 
            </div>   
            <div class="row">
                <div class="col-sm-4">
                    Telefone 1: 
                </div>
                <div class="col-sm-4">
                    Telefone 2:
                </div>
                <div class="col-sm-4">
                    E-mail:
                </div>                 
            </div>  
            <hr>
            <div class="row">
                <div class="col-sm-2">
                    Tipo: Responsável
                </div>
                <div class="col-sm-6">
                    Nome: 
                </div>
                <div class="col-sm-4">
                    Data Nascimento:
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    RG: 
                </div>
                <div class="col-sm-6">
                    CPF:
                </div>
            </div>  
            <div class="row">
                <div class="col-sm-4">
                    Telefone 1: 
                </div>
                <div class="col-sm-4">
                    Telefone 2:
                </div>
                <div class="col-sm-4">
                    E-mail:
                </div>                
            </div>    
            <button>Incluir Dependente</button>
            <button>Incluir Titular</button>
        </div> 
         
         
         
         
    </div>
 </main>
     
    <?php
include "../../inc/footer.php";

?>
<script src="../../js/pag/jsVendas.js.php"></script> 
