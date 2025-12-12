<?php
	session_start();

	// Limpa a flag do resultado
	unset($_SESSION['resultado_mostrado']);
	

	require("connect.php");

	$id_grupo = $_GET['id_grupo'];

	$select = "SELECT p.nome, p.id_grupo FROM participantes p LEFT JOIN nomes n ON p.nome = n.usuario WHERE n.usuario IS NULL AND p.id_grupo = '$id_grupo'";

	$action = $conn->query($select);
	$dados = [];	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sorteio</title>
</head>
<style type="text/css">
	#nomes{
		width: 200px;
		height: 30px;
	}
	option{
		font-family: Arial;
		font-size: 15px;
	}
	label{
		font-family: Verdana;
		font-size: 20px;
	}
	#btn_nome{
		width: 200px;
		height: 30px;
	}
</style>
<body>
	<label for="nomes">Quem é Você?</label><br>
	<br>
	<form name="fnome" method="POST" action="sorteio.php?id_grupo='<?php echo $id_grupo;?>'">
		<select name="nomes" id="nomes">
			<?php 
				while($linha = $action->fetch_assoc()){
					?>
					<option value="<?php echo $linha['nome'];?>"><?php echo $linha['nome'];?></option>
					<?php
				}

			?>
		</select>
		<br>
		<br>
		<input type="submit" name="btn_nome" id="btn_nome" value="Sortear">
	</form>

</body>
</html>