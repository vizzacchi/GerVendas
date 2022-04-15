<?php
	$conn = mysqli_connect('localhost','root','d3202171B','php');
	if (mysqli_connect_errno()) {
	   $conn = mysqli_connect('localhost','plan7923_php','d3202171B','plan7923_php');
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
		  exit();
	   }
    }
	$servidor = 'gerpilon.mysql.dbaas.com.br';
	$user = 'gerpilon';
	$senha = 'Dd395184';
	$db='gerpilon';
	$conexao = mysqli_connect("$servidor", $user, $senha, $db);

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
?>
