$(document).ready(function(){
    
});
function perfil(id){
    alert(1);
    if(id==0){
        alert('0');
    }
    else{
        alert('1');
    }
}
$(function(){
	// Parser para configurar a data para o formato do Brasil
	$.tablesorter.addParser({
		id: 'datetime',
		is: function(s) {
			return false; 
		},
		format: function(s,table) {
			s = s.replace(/\-/g,"/");
			s = s.replace(/(\d{1,2})[\/\-](\d{1,2})[\/\-](\d{4})/, "$3/$2/$1");
			return $.tablesorter.formatFloat(new Date(s).getTime());
		},
		type: 'numeric'
	});

	$('.tablesorter').tablesorter({
        // Envia os cabeçalhos 
        headers: { 
            // A segunda coluna (começa do zero) 
            4:{ 
                // Desativa a ordenação para essa coluna 
                sorter: false 
            },
            5:{ 
                // Desativa a ordenação para essa coluna 
                sorter: false 
            },
           6:{ 
                // Desativa a ordenação para essa coluna 
                sorter: false 
            }
			//4: {
                // Ativa o parser de data na coluna 4 (começa do 0) 
              //  sorter: 'datetime' 
			//}
        },
		// Formato de data
		dateFormat: 'dd/mm/yyyy'
	});
});