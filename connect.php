<?php
	$host = "localhost";
	$db = "sorteio";
	$user = "root";
	$passwd = "";

	$conn = new mysqli($host, $user, $passwd, $db);

	if($conn->connect_error){
		die("Erro na conexão: " . $conn->connect_error);
	}
?>