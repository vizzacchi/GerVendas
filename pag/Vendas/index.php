<?php
include "../../inc/conexao.php";
include "../../inc/header.php";
?>
 <!--------------------- aqui começa a página----------------->
    <main class="container-fluid"> 

         <div class="bg-light p-5">
            <h1>Consultas Vendas</h1>
<!------------------Botão Incluir e pesquisa -------------------->             
             <form> 
              <div class="form-group row">
                <div class="col-sm-3">
                  <label>Nome Cliente:</label>
                  <input type="text" class="form-control" id="txtNomeCliente" name="txtNomeCliente" onKeyUp ="pesquisar()">
                </div>
                <div class="col-sm-3">
                    <label>Mês:</label>
                       <?php
					   $mesNome=array('01'=>'jan','02'=>'fev','03'=>'mar','04'=>'abr','05'=>'mai','06'=>'jun','07'=>'jul','08'=>'ago','09'=>'set','10'=>'out','11'=>'nov','12'=>'dez');	  
						$data = date('Y-m-d', strtotime("+30 days"));
						$mes = $mesNome[date('m',strtotime($data))];	
						$ano = date('Y',strtotime($data));
						$data_fim = date('Y-m-d', strtotime('2022-01-01'));			
		  ?>
      		<select class="form-control" id="cboMes" name="cboMes">
	  		<option value="0">TODOS</option>
	  		<?php 
			$list = 0;
			while ($data > $data_fim){
			  if ($list == 1){
				  echo "<option value=".$mes."/".$ano." selected >".$mes."/".$ano."</option>";			
				  $data = date('Y-m-d', strtotime("-25 days",strtotime($data)));
				  $mes = $mesNome[date("m", strtotime($data))];	
				  $ano = date("Y",strtotime($data));	
				  $list = $list + 1;
			  }else{	
				  echo "<option value=".$mes."/".$ano.">".$mes."/".$ano."</option>";			
				  $data = date('Y-m-d', strtotime("-25 days",strtotime($data)));
				  $mes = $mesNome[date("m", strtotime($data))];	
				  $ano = date("Y",strtotime($data));	
				  $list = $list + 1;
			}
		}
	  	?>
      	</select>
                 </div>
                <div class="col-sm-3">  
                    <label>Tipo de Contrato:</label>
                    <select class="form-control" id="cboTipo" name="cboTipo">
                        <option value = "PF">Só Pessoa Física</option>
                        <option value = "PJ">Só Pessoa Jurídica</option> 
                        <option value = "0" selected>Todas os tipos</option>
                    </select>                   
                </div>
                <div class="col-sm-3">  
                    <label>Operadora:</label>
                    <select class="form-control" id="cboOperadora" name="cboOperadora">
                        <option value="0" selected>Todas</option>
                        <?php
                            $qsql = "Select distinct cod_operadora, operadora, nome_abrev from venda, operadora where venda.cod_operadora = operadora.id order by operadora";
                            if($rs=mysqli_query($conn,$qsql)){
                                while($reg=mysqli_fetch_array($rs)){
                                    echo "<option value = '".$reg['cod_operadora']."'>".$reg['nome_abrev']."</option>";
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
                        if($_SESSION['perfil']<=1){ 
							$qsql = "Select id, corretora from corretora order by corretora";
							if($rs=mysqli_query($conn,$qsql)){
								echo "<option value='0'>Todas</option>";
								while($reg=mysqli_fetch_array($rs)){
									if($reg['id']==1){
										echo "<option value=".$reg['id']." selected>".$reg['corretora']."</option>";
									}else{
										echo "<option value=".$reg['id'].">".$reg['corretora']."</option>";
									}
								}
							}
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
                            $qsql = "Select id, corretor from corretores order by corretor";
                            if($rs=mysqli_query($conn,$qsql)){
                                while($reg=mysqli_fetch_array($rs)){
                                    echo "<option value = '".$reg['id']."'>".$reg['corretor']."</option>";
                                }
                            }
                        }else{
							$cpf = $_SESSION['cpf'];
							$qsql = "SELECT id, corretor from corretores where cpf = $cpf ";
							if($rs=mysqli_query($conn,$qsql)){
								$reg=mysqli_fetch_array($rs);
								echo "<option value='".$reg['id']."'>".$reg['corretor']."</option>";
							}
                        }
                    ?>
                    </select>                          
                </div>
            </div>
                    
     </form>
     <hr>
<!-------------------Fim Botão Pesquisa----------------------------------------------->   
             <div id="listagem">
                 <?php include "../../ajax/pag/ajVendas.php";?>
             </div>
 </main>
     
<?php
include "../../inc/footer.php";

?>
<script src="../../js/pag/jsVendas.js.php"></script> 

