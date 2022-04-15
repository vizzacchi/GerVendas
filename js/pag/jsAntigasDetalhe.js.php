// JavaScript Document

function antigasDetalhe(id){
    alert("antigasDetalhe");
    $("#antigasDetalhes").load("../../ajax/pag/ajAntigasDetalhe.php",{id:id});
    return false;                                                  
};