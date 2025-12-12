<?php 
	session_start();

	// Verifica se o resultado já foi mostrado nesta sessão
	if(isset($_SESSION['resultado_mostrado'])) {
	    // Já mostrou → redireciona para página inicial
	    header("Location: final.php");
	    exit;
	}

	// Marca que o resultado será mostrado agora
	$_SESSION['resultado_mostrado'] = true;

	require("connect.php");
	$id_grupo = $_GET['id_grupo'];
	$usuario = $_POST['nomes'];
	if(empty($usuario)){
		header("Location: erro.php");
	}

	$select = "SELECT id, nome FROM nomes WHERE id_grupo = $id_grupo AND nome != '$usuario' AND sorteado = 0";
	$action = $conn->query($select);

	//array de nomes
	$nomes = [];

	while ($linha = $action->fetch_assoc()) {
		$nomes[] = $linha;

	}
	//var_dump($nomes);
	if(empty($nomes)){
		$sorteado = [
		    "id" => 00,
		    "nome" => "Sem Nome"
		];
	}else{
		$sorteado = $nomes[array_rand($nomes)];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sorteado</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
	<h3 id="usuario"><?php echo $usuario;?></h3>
	<h3>O Nome Sorteado Foi:</h3>
	<h3 id="valor_nome" data-id = "<?php print_r($sorteado['id']);?>"><?php print_r($sorteado['nome']); ?></h3>
	<button id="btn_sair">Ok!</button>


	<script>
		const nome = document.getElementById('valor_nome');
		const btn_sair = document.getElementById('btn_sair');
		const usuario = document.getElementById('usuario');

		$(document).ready(function() {
			salvar(nome.dataset.id, usuario.innerText);
		});

		function salvar(id, usuario) {
			$.ajax({
				url: "salvar.php",
				type: "POST",
				data : {id:id, usuario:usuario},
				success: function(resposta){
					alert(resposta);
				},
				error: function(){
					alert("Erro ao Salvar");
				}
			});
		}

		btn_sair.addEventListener("click", function(s){
			window.location.href = "final.php";
		})

	</script>
</body>
</html>