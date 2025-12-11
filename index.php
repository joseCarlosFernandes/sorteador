<?php
	session_start();

	// Limpa a flag do resultado
	unset($_SESSION['resultado_mostrado']);
	

	require("connect.php");

	$select = "SELECT p.nome FROM participantes p LEFT JOIN nomes n ON p.nome = n.usuario WHERE n.usuario IS NULL";

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
	<form name="fnome" method="POST" action="sorteio.php">
		<select name="nomes" id="nomes">
			<?php 
				while($linha = $action->fetch_assoc()){
					?>
					<option value="<?php echo $linha['nome']?>"><?php echo $linha['nome']?></option>
					<?php
				}

			?>


			<!--<option value="nome1">Nome 1</option>
			<option value="nome2">Nome 2</option>
			<option value="nome3">Nome 3</option>
			<option value="nome4">Nome 4</option>-->
		</select>
		<br>
		<br>
		<input type="submit" name="btn_nome" id="btn_nome" value="Sortear">
	</form>

</body>
</html>