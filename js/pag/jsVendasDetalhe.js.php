// JavaScript Document

function vendasDetalhe(id){
    $("#vendasDetalhes").load("../../ajax/pag/ajVendasDetalhe.php",{id:id});
    return false;                                                  
};