<?php 
include "../../func/func.php";
include "../../inc/conexao.php";
include "../../inc/valida_login.php";

if(!empty($_POST['cliente'])){
    $cliente = "nome like '".$_POST['cliente']."%'";
}else{
    $cliente = "nome like '%' ";
}
if(!empty($_POST['banco']) and $_POST['banco']<>'0'){
    $banco = "and base = '".$_POST['banco']."'";
}else{
    $banco = "";
}
if(!empty($_POST['tipo']) and $_POST['tipo']<>'0'){
    $tipo = "and tipo_plano = '".$_POST['tipo']."'";
}
else{
    $tipo = "";
}
if(!empty($_POST['operadora']) and $_POST['operadora']<>'0'){
    $operadora  = "and operadora = '".$_POST['operadora']."'";
}else{
    $operadora = "";
}
if(!empty($_POST['corretora']) and $_POST['corretora']<>'0'){
    $corretora = "and corretora = '".$_POST['corretora']."'";
}else{
    $corretora = "";
}
if(!empty($_POST['vendedor']) and $_POST['vendedor']<>'0'){
    $vendedor = "and Vendedor = '".$_POST['vendedor']."'";
}else{
    if ($_SESSION['perfil']<=2){
        $vendedor="";   
    }else{
        $vendedor = "and Vendedor = '".$_SESSION['cpf']."'";   
    }
}
if($cliente == "" and $banco == "" and $tipo == "" and $operadora=="" and $corretora=="" and $vendedor == ""){
    $condicao = 1;
}else{
    $condicao = "";
}
$qsql = "SELECT id, base, nome, tipo_plano, operadora, plano, valor, num_vidas, vendedor,   
         nomeVendedor, vigencia FROM `vendasantigas` WHERE $cliente $banco $tipo $operadora $corretora $vendedor $condicao";
if($rs=mysqli_query($conn,$qsql)){
    ?>

    <div class="table-responsive-sm">
        <button type="button" class="btn btn-outline-success btn-sm" onclick="ExportToExcel('xlsx')" style="margin-bottom: 10px"><i class="bi-file-earmark-excel"></i> Exporta para Excell</button>
          <table class="table table-striped table-sm tablesorter" id="tbVendas">
            <thead>
                <tr>
                    <th scope="col" style="font-size: 0.8rem">Base</th>
                    <th scope="col" style="font-size: 0.8rem">Nome Cliente</th>
                    <th scope="col" style="font-size: 0.8rem">Tipo</th>
                    <th scope="col" style="font-size: 0.8rem">Operadora</th>
                    <th scope="col" style="font-size: 0.8rem">Plano</th>
                    <th scope="col" style="font-size: 0.8rem">Vidas</th>
                    <th scope="col" style="font-size: 0.8rem">Valor</th>
                    <th scope="col" style="font-size: 0.8rem">Nome Vendedor</th>
                    <th scope="col" style="font-size: 0.8rem">Vigência</th>
                    <th scope="col" style="font-size: 0.8rem">Mais</th>
                </tr>    
            </thead>
            <tbody>
    <?php
    while($reg=mysqli_fetch_array($rs)){?>
        <tr>
            <td style="font-size: 0.7rem"><?php echo $reg['base'];?></td>
            <td style="font-size: 0.7rem"><?php echo $reg['nome'];?></td>
            <td style="font-size: 0.7rem"><?php echo $reg['tipo_plano'];?></td>
            <td style="font-size: 0.7rem"><?php echo $reg['operadora'];?></td>
            <td style="font-size: 0.7rem"><?php echo $reg['plano'];?></td>
            <td style="font-size: 0.7rem"><?php echo $reg['num_vidas'];?></td>
            <td style="font-size: 0.7rem"><?php echo number_format($reg['valor'], 2, ',', '.');?></td>
            <td style="font-size: 0.7rem"><?php echo $reg['nomeVendedor'];?></td>
            <td style="font-size: 0.7rem"><?php echo date("d/m/Y",strtotime($reg['vigencia']));?></td>
            <td style="font-size: 0.7rem"><i class="bi bi-plus-square" type="button" data-toggle="modal" data-target="#vendaModal" onClick="antigasDetalhe(<?php echo $reg['id'];?>)"></td>
        </tr>        
    <?php    
    }?>
            <tbody>
        </table>
    </div>
<?php
}?>

<!-- Modal Inclusão-->
<div class="modal fade" id="vendaModal" tabindex="-1" aria-labelledby="vendaModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="vendaModalLabel">Detalhes da Venda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="antigasDetalhes"></div>
          
          <div class="modal-footer" >
            <button type="button" id="fechar" name="fechar" class="btn btn-primary" data-dismiss="modal">Fechar</button>
          </div>
      </div>  
    </div>
  </div>
</div>
<!---- Fim Modal Inclusão--------->

    <script>
        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('tbVendas');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || ('Vendas.' + (type || 'xlsx')));
        }
    </script>
    <script src="../../js/pag/jsAntigasDetalhe.js.php"></script>
    <script src="../../js/jquery-3.5.1.min.js"></script> 
    <script src="../../js/jquery.tablesorter.min.js"></script> 
    <script src="../../js/scripts.js"></script>
