<?php
include "../../inc/conexao.php";
include "../../inc/header.php";
?>
 <!--------------------- aqui começa a página----------------->
    <main class="container-fluid"> 

         <div class="bg-light p-5">
            <h1>Consultas Vendas Antigas</h1>
<!------------------Botão Incluir e pesquisa -------------------->             
             <form> 
              <div class="form-group row">
                <div class="col-sm-3">
                  <label>Nome Cliente:</label>
                  <input type="text" class="form-control" id="txtNomeCliente" name="txtNomeCliente" onChange="pesquisar()">
                </div>
                <div class="col-sm-3">
                    <label>Base de Dados:</label>
                   <select class="form-control" id="cboBase" name="cboBase">
                       <?php
                                $qsql = "Select distinct base from vendasantigas order by base";
                                if($rs=mysqli_query($conn,$qsql)){
                                    while($reg=mysqli_fetch_array($rs)){
                                        echo "<option value = '".$reg['base']."'>".$reg['base']."</option>";
                                    }
                                }
                       ?>
                        <option value = '0' selected>Todas</option>  
                    </select>   
                </div>
                <div class="col-sm-3">  
                    <label>Tipo de Contrato:</label>
                    <select class="form-control" id="cboTipo" name="cboTipo">
                        <option value = 'PF'>Só Pessoa Física</option>
                        <option value = 'PJ'>Só Pessoa Jurídica</option> 
                        <option value = "0" selected>Todas os tipos</option>
                    </select>                   
                </div>
                <div class="col-sm-3">  
                    <label>Operadora:</label>
                    <select class="form-control" id="cboOperadora" name="cboOperadora">
                        <option value="0" selected>Todas</option>
                        <?php
                            $qsql = "Select distinct operadora from vendasantigas order by operadora";
                            if($rs=mysqli_query($conn,$qsql)){
                                while($reg=mysqli_fetch_array($rs)){
                                    echo "<option value = '".$reg['operadora']."'>".$reg['operadora']."</option>";
                                }
                            }
                        ?>
                    </select>                   
                </div>                  
            </div>
            <div class="form-group row">

                <div class="col-sm-6">
                    <label>Corretora:</label>
                    <select class="form-control" id="cboCorretora" name="cboCorretora">
                        <?php
                        if($_SESSION['perfil']<=1){ ?>
                            <option selected value="1">Pilon Vida e Saúde</option>
                            <option value="999">Parceiros</option>
                            <option value="0">Todas</option>
                        <?php
                        }else{ ?>
                         <option selected value="1">Pilon Vida e Saúde</option>
                        <?php
                        }
                        ?>  
                    </select>  
                </div>
                <div class="col-sm-6">
                    <label>Vendedor:</label>
                    <select class="form-control" id="cboVendedor" name="cboVendedor" onChange="pesquisar()">                    
                    <?php
                        if($_SESSION['perfil']<=1){
                            echo "<option value='0' selected>Todos</option>";
                            $qsql = "Select distinct Vendedor, nomeVendedor from vendasantigas order by nomeVendedor";
                            if($rs=mysqli_query($conn,$qsql)){
                                while($reg=mysqli_fetch_array($rs)){
                                    echo "<option value = '".$reg['Vendedor']."'>".$reg['nomeVendedor']."</option>";
                                }
                            }
                        }else{
                            echo "<option value='".$_SESSION['cpf']."'>".$_SESSION['UsuarioNome']."</option>";
                        }
                    ?>
                    </select>                          
                </div>
            </div>
                    
     </form>
     <hr>
<!-------------------Fim Botão Pesquisa----------------------------------------------->   
             <div id="listagem">
                 <?php include "../../ajax/pag/ajAntigas.php";?>
             </div>
 </main>
     
<?php
include "../../inc/footer.php";

?>
<script src="../../js/pag/jsAntigas.js.php"></script> 

