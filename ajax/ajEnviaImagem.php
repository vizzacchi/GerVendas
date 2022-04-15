<?php
/******
 * Upload de imagens
 ******/
 	
$id = $_GET['id'];
// verifica se foi enviado um arquivo
if ( isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) {
 
    $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
    $nome = $_FILES[ 'arquivo' ][ 'name' ];
 
    // Pega a extensão
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
 
    // Converte a extensão para minúsculo
    $extensao = strtolower ( $extensao );
 
    // Somente imagens, .jpg;.jpeg;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if ( strstr ( '.jpg;.jpeg;.png', $extensao ) ) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = uniqid ( time () ) . '.' . $extensao;
 
        // Concatena a pasta com o nome
        $destino = '../img/logos/' . $novoNome;
		
        // tenta mover o arquivo para o destino
        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
            include "../inc/conexao.php";
			$qsqlImagem = "Select logo from operadora where id='$id'";

			if($rsImagem = mysqli_query($conn,$qsqlImagem)){
				$row = mysqli_fetch_assoc($rsImagem); 
                if($row['logo']!=""){
                    $arquivoAnterior = str_replace('../',"",$row['logo']);
                    $arquivoAnterior = '../'.$arquivoAnterior;
                    if (file_exists($arquivoAnterior)){
                        unlink($arquivoAnterior);
                    }
                }
			}			
			$imagem = $destino;
			$qsql = "UPDATE `operadora` SET `logo`= '$imagem' WHERE id =$id";
			if($rs = mysqli_query($conn,$qsql)){
			   	$image = new Imagick($destino);
				$image->readImage($destino);
				$image->setImageFormat('jpeg');
				$image->setImageCompression(Imagick::COMPRESSION_JPEG);
				$image->setImageCompressionQuality(75);
				//$image->stripImage();
				$image->setInterlaceScheme(Imagick::INTERLACE_PLANE);
				$image->writeImage($destino);					

				echo "<h2 align='center'>Arquivo salvo com sucesso!!!</h2>";
                echo "<script language='javaScript'>window.location.href='/pag/Operadora'</script>";
	  	 		exit;
			}
			else{
				echo "Não foi possível salvar sua imagem.";
			}
        }
        else
            echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
    }
    else
        echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.png"<br />';
}
else
    echo 'Você não enviou nenhum arquivo!';

?>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/jquery-3.5.1.min.js"></script>	      
    <script src="../../js/jquery.maskedinput.min.js"></script>    
    <script src="../../js/jquery-ui.min.js"></script>      
    <script src="../../js/jquery.serializeObject.min.js"></script>
    <script src="../../js/jquery.tablesorter.min.js"></script> 
    <script src="../../js/scripts.js"></script>
    <script src="../../js/pag/jsOperadora.js.php"></script>