<?php

function gerarId($nomeGrupo)
{
	$nomeGrupo = trim($nomeGrupo);
	$embaralhar = str_shuffle($nomeGrupo);
	$numero = random_int(0, 255);

	$idGrupo = $embaralhar . $numero;

	return $idGrupo;
}


?>