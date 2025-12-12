<?php
	require 'connect.php';

	$nome = $_POST['nome'];
	$id_grupo = $_POST['id'];

	$insert =  "INSERT INTO participantes (nome, id_grupo) VALUES ('$nome', '$id_grupo');
		INSERT INTO nomes (id_grupo, nome) VALUES ('$id_grupo','$nome')";
	$action = $conn->multi_query($insert);

	if (!$action) {
		echo "Erro na query";
	}else{
		echo "Membro Adicionado!";
	}


?>