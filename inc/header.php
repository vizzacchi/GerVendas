<?php
    include "valida_login.php";

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Douglas Jorge Vizzacchi">
    <meta name="generator" content="Douglas V.2">
    <title>GerVendas - Gerenciamento de Vendas</title>

    <link rel="canonical" href="http://cotador.sjc.br">
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    <!-- Bootstrap core CSS -->

     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
      
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    
    <!-- Custom styles for this template -->
    <link href="../../css/navbar.css" rel="stylesheet">
</head>
  <body>
      
<nav class="navbar navbar-expand-xxl navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="../Pilon/"><img src="../../img/LogoPilon.png" height="40" alt="Logo Pilon Vida e Saúde"/></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <a class="navbar-brand" href="../Pilon/"  >
          <i class="bi bi-house-door" width="10" height="10" ></i>
            <span style="font-size: 0.9rem">Home</span>
        </a>
          <br>
        <a class="navbar-brand" href="https://1drv.ms/u/s!Ag-3NMQcm1g3g6UHF4bVTX53aBAe_w?e=7qcRVf" target="new">
          <i class="bi bi-cloud" width="10" height="10" ></i>
            <span style="font-size: 0.9rem">Nuvem</span>
        </a>
          <br>
        <a class="navbar-brand" href="../Cotador/"  >
          <i class="bi bi-calculator" width="10" height="10" ></i>
            <span style="font-size: 0.9rem">Cotador</span>
        </a>
      <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?php if($_SESSION['perfil']==4){ echo 'disabled';} ?>" href="#" id="mnuVendas" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Vendas
        </a>
        <div class="dropdown-menu" aria-labelledby="mnuVendas">
          <a class="dropdown-item" href="../Antigas/" id="mnuCorretoras">Consulta Vendas Antigas</a>
          <a class="dropdown-item" href="../Vendas/" id="mnuCorretores">Consulta Vendas</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item <?php if($_SESSION['perfil']>=2){ echo 'disabled';} ?>" href="../Cadastro/" id="mnuOperadora">Cadastro Vendas</a>
          <a class="dropdown-item" href="../Regiao/" id="mnuRegiao">Cidades por Região</a>            
        </div>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?php if($_SESSION['perfil']>=2){ echo 'disabled';} ?>" href="#" id="mnuCadastros" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Cadastros
        </a>
        <div class="dropdown-menu" aria-labelledby="mnuCadastros">
          <a class="dropdown-item" href="../Corretoras/" id="mnuCorretoras">Corretoras</a>
          <a class="dropdown-item" href="../Corretores/" id="mnuCorretores">Corretores</a>     
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../Operadora/" id="mnuOperadora">Operadora</a>
          <a class="dropdown-item" href="../Contato/"   id="mnuContOperadora">Contatos Operadora</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../Planos/"    id="mnuPlanos">Planos</a>
          <a class="dropdown-item" href="../Tabelas/"    id="mnuTabelasPlanos">Tabelas Planos</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?php if($_SESSION['perfil']>=1){ echo 'disabled';} ?>" href="#" id="mnuFinanceiro" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
          Financeiro
        </a>
        <div class="dropdown-menu" aria-labelledby="mnuFinanceiro">
          <a class="dropdown-item" href="#" id="mnuComissaoOperadora">Comissão das Operadora</a>
		  <a class="dropdown-item" href="../VendaInterna/" id="mnu1ParcelaVendaInterna">1° Parcela Venda Interna</a>
          <div class="dropdown-divider"></div>            
          <a class="dropdown-item" href="#" id="mnuComissaoPagar">Comissão a Pagar</a>
        </div>
      </li>        
    </ul>
  </div>
</nav>
