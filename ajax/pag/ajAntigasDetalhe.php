<?php 
include "../../inc/conexao.php";
include "../../inc/valida_login.php";    

if($_POST['id']){
    $id= $_POST['id'];
    $qsql = "Select * from vendasantigas where id = $id";
    if($rs=mysqli_query($conn,$qsql)){
        $reg = mysqli_fetch_array($rs);
            $base           = $reg['base'];
            $contrato       = $reg['contrato'];
            $operadora      = $reg['operadora'];
            $plano          = $reg['plano'];
            $tipoPlano      = $reg['tipo_plano'];
            $entidade       = $reg['entidade'];
            $numVidas       = $reg['num_vidas'];
            $valor          = number_format($reg['valor'], 2, ',', '.');
            $nomeVendedor   = $reg['nomeVendedor'];
            if($reg['corretora']==1){
                $corretora      = "Pilon Vida e Saúde";
            }
            else{
                $corretora      = "Parceiros";
            }
            $nomeCliente    = $reg['nome'];
            $dataNascimento = date("d/m/Y",strtotime($reg['dataNascimento']));
            $cpf            = $reg['cpf'];
            $rg             = $reg['rg'];
            $telefone       = $reg['telefone'];
            $celular        = $reg['celular'];
            $comercial      = $reg['comercial'];
            $email          = $reg['email'];
            $rua            = $reg['rua'];
            $numero         = $reg['numero'];
            $complemento    = $reg['complemento'];
            $bairro         = $reg['bairro'];
            $cidade         = $reg['cidade'];
            $estado         = $reg['estado'];
            $cep            = $reg['cep'];
            $vigencia       = date("d/m/Y",strtotime($reg['vigencia']));
            $mes            = $reg['mes'];
            $codigo         = $reg['codigo'];
            $data           = date("d/m/Y",strtotime($reg['data']));
            $nomeMae        = $reg['nomeMae'];
    }
}else{
    echo "Dados não encontrado, favor tentar outra venda!";
}
?> 
<div class="container-fluid">
    <div class="container">
        <p align="center">Cadastrado em <span class="tituloDetalhes"><?php  echo $data;?> </span> para o mês de <span class="tituloDetalhes"><?php  echo $mes;?> </span> na Base de Dados da <span class="tituloDetalhes"><?php  echo $base;?> </span></p>
          <div class="row">
            <div class="col-sm-6">Corretora: <span class="tituloDetalhes"><?php  echo $corretora;?> </span></div>
            <div class="col-sm-6">Vendedor: <span class="tituloDetalhes"><?php  echo $nomeVendedor;?> </span></div>
          </div>    
        <hr>
          <div class="row">
            <div class="col-sm-3">Contrato: <span class="tituloDetalhes"><?php  echo $contrato;?> </span></div>
            <div class="col-sm-6">Cliente: <span class="tituloDetalhes"><?php  echo $nomeCliente;?> </span></div>
            <div class="col-sm-3">Vigência: <span class="tituloDetalhes"><?php  echo $vigencia;?> </span></div>
          </div>
        <hr>
          <div class="row">
            <div class="col-sm-2">Tipo Plano: <span class="tituloDetalhes"><?php  echo $tipoPlano;?> </span></div>
            <div class="col-sm-5">Operadora: <span class="tituloDetalhes"><?php  echo $operadora;?> </span></div>
            <div class="col-sm-5">Plano: <span class="tituloDetalhes"><?php  echo $plano;?> </span></div>
            <div class="col-sm-2">Valor: <span class="tituloDetalhes"><?php  echo $valor;?> </span></div> 
            <div class="col-sm-5">Entidade: <span class="tituloDetalhes"><?php  echo $entidade;?> </span></div>  
            <div class="col-sm-5">Qtdade Vidas: <span class="tituloDetalhes"><?php  echo $numVidas;?> </span></div>  
          </div>
        <hr>
          <div class="row">
            <div class="col-sm-12">e-mail: <span class="tituloDetalhes"><?php  echo $email;?> </span></div>
            <div class="col-sm-4">Telefone: <span class="tituloDetalhes"><?php  echo $telefone;?> </span></div>
            <div class="col-sm-4">Celular: <span class="tituloDetalhes"><?php  echo $celular;?> </span></div>
            <div class="col-sm-4">Comercial: <span class="tituloDetalhes"><?php  echo $comercial;?> </span></div> 
          </div>     
        <hr>
          <div class="row">
            <div class="col-sm-8">Rua: <span class="tituloDetalhes"><?php  echo $rua;?> </span>, <span class="tituloDetalhes"><?php  echo $numero;?> </span></div>
            <div class="col-sm-4">Complemento: <span class="tituloDetalhes"><?php  echo $complemento;?> </span></div>
            <div class="col-sm-4">Bairro: <span class="tituloDetalhes"><?php  echo $bairro;?> </span></div>
            <div class="col-sm-4">Cidade: <span class="tituloDetalhes"><?php  echo $cidade;?> </span> / <span class="tituloDetalhes"><?php  echo $estado;?> </span></div> 
            <div class="col-sm-4">Cep: <span class="tituloDetalhes"><?php  echo $cep;?> </span></div>   
          </div>         
        <hr>
          <div class="row">
            <div class="col-sm-8">Titular: <span class="tituloDetalhes"><?php  echo $nomeCliente;?> </span></div>
            <div class="col-sm-4">Dt Nascimento: <span class="tituloDetalhes"><?php  echo $dataNascimento;?> </span></div>
            <div class="col-sm-4">CPF: <span class="tituloDetalhes"><?php  echo $cpf;?> </span></div>
            <div class="col-sm-4">RG: <span class="tituloDetalhes"><?php  echo $rg;?> </span></div>
            <div class="col-sm-8">Nome Mãe: <span class="tituloDetalhes"><?php  echo $nomeMae;?> </span></div> 
            <div class="col-sm-4">Código: <span class="tituloDetalhes"><?php  echo $codigo;?> </span></div>   
          </div>
        <br>
        <?php
            if($numVidas>1){
                $qsql = "Select * from dependentesantigos where id = $id and base = '$base'";
                if($rs=mysqli_query($conn,$qsql)){?>
                    <p class="text-muted">Dependentes:</p>
                    <?php
                    while($reg=mysqli_fetch_array($rs)){?>
                    
                        <div class="row">
                            <div class="col-sm-8">Nome: <span class="tituloDetalhes"><?php echo $reg['nome'];?></span></div>
                            <div class="col-sm-4">Dt Nascimento: <span class="tituloDetalhes"><?php echo date("d/m/Y",strtotime($reg['nascimento']));?></span></div>
                            <div class="col-sm-4">CPF: <span class="tituloDetalhes"><?php echo $reg['cpf'];?></span></div>
                            <div class="col-sm-4">Código: <span class="tituloDetalhes"><?php echo $reg['carteirinha'];?></span></div>   
                        </div> 
        <?php    
                    }
                }
            
        ?>
                  
                
  
                            
            <?php
            }else{
                echo "Esse contrato não possui dependentes!";
            }
        
        ?>
               
    </div>
</div>

