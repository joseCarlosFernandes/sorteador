<?php
	require 'connect.php';

	$id = $_POST['id'];

	$delete = "DELETE FROM grupos WHERE id = '$id'";
	$action = $conn->query($delete);

	if (!$action) {
		echo "Erro na query";
	}else{
		echo "Grupo Deletado!";
	}


?>