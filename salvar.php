<?php
	require("connect.php");
	$id = $_POST['id'];
	$usuario = $_POST['usuario'];

	$update = "UPDATE nomes SET sorteado = 1, usuario = '$usuario' WHERE id ='$id'";
	$action = $conn->query($update);

	if(!$action){
		echo "Erro no Update";
	}else{
		echo "Sorteado";
	}

?>