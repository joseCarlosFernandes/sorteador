<?php
	require 'connect.php';
	require 'funcoes.php';

	$nomeGrupo = $_POST['nomeGrupo'];
	$idGrupo = gerarId($nomeGrupo);

	$insert =  "INSERT INTO grupos (id_grupo, nome_grupo) VALUES ('$idGrupo', '$nomeGrupo')";
	$action = $conn -> query($insert);

	if (!$action) {
		echo "Erro na query";
	}else{
		echo "Adicionado!";
	}


?>