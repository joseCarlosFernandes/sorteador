<?php
	require 'connect.php';

	$select = "SELECT id, id_grupo, nome_grupo FROM grupos";
	$action = $conn->query($select);

	$dados = [];

	if(!$action){
		echo "Erro na query";
	}else{
		while ($linhas = $action->fetch_assoc()) {
			$dados[] = $linhas;
		}
		echo json_encode($dados);
	}




?>