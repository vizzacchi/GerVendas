<?php
include "../../inc/conexao.php";
include "../../inc/header.php";
?>
<main class="container-fluid">
    <div class="bg-light p-5" align="center">
		<div class="container">
			<form>
				<select id="vendedor" name="vendedor" class="inputs">
					<option>Selecione o vendedor...</option>
				</select>
				<select id="mes" name="mes" class="inputs">
					<option>Selecione o mês</option>
				</select>
				<input type="text" id="cliente" name="cliente" class="inputs">
				<input type="number" id="valor" name="valor" class="inputs">
				<select id="tipoPagto" name="tipoPagto" class="inputs">
					<option value="0">Selecione o tipo de pagamento..</option>
					<option value="1">Pix/|Transferência</option>
					<option value="2">Boleto Pilon</option>
					<option value="2">Boleto Operadora</option>
				</select>
				<select id="comprovante" name="comprovante" class="inputs">
					<option value ="0">Selecione a opção...</option>
					<option value="1">Recebido</option>
					<option value="2">Pendente</option>
				</select>
				<select id="extrato" name="extrato" class="inputs">
					<option value ="0">Selecione a opção...</option>
					<option value="1">Lançado</option>
					<option value="2">Pendente</option>
				</select>
				
			
			</form>
		</div>
    </div>
</main>

<?
include "../../inc/footer.php";
?>