<?php
	require 'connect.php';

	$id = $_GET['id_grupo'];

	$select = "SELECT id, nome FROM participantes WHERE id_grupo = '$id'";
	$action = $conn->query($select);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Membros</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style type="text/css">
	th, td{
		padding: 5px;
		font-family: Arial;
		font-size: 20px;
	}
	#tb_membros{
		width: fit-content;
		max-height: 300px;
		overflow-y: auto;
	}
</style>
<body>
	<h1>Membros do Grupo <?php echo $id;?></h1>
	<div id="tb_membros">
		<table id="tabela_membros">
			<thead>
				<tr>
					<th>Id</th>
					<th>Nome</th>
				</tr>
			</thead>
			<tbody>
				<?php
					while ($linhas = $action ->fetch_assoc()) {
						?>
						<tr>
							<td><?php echo $linhas['id'];?></td>
							<td><?php echo $linhas['nome'];?></td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
	</div>
	<br>
	<input type="text" name="txt_nome" id="nome_membro" placeholder="Nome do Participante" data-id = '<?php echo $id;?>'>
	<input type="submit" name="btn_nome" id="btn_add" value="Adicionar"><br>
	<br>
	<button id="btn_voltar">Voltar</button>

	<script>
		const nome_membro = document.getElementById('nome_membro');
		const btn_add = document.getElementById('btn_add');
		const btn_voltar = document.getElementById('btn_voltar');

		btn_voltar.addEventListener("click", function(v){
			v.preventDefault();
			window.location.href = "index.php";
		});

		btn_add.addEventListener("click", function(a){
			//a.preventDefault();
			adicionar(nome_membro.value, nome_membro.dataset.id);
		});

		function adicionar(nome, id){
			$.ajax({
				url : "adicionarM.php",
				type : "POST",
				data : {nome : nome, id : id},
				success : function(retorno){
					alert(retorno);
					window.location.href = `membros.php?id_grupo=${id}`;
				},
				error : function(){
					alert("Erro ao Adicionar");
				}
			});
		}


	</script>
</body>
</html>