<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
	<input type="text" name="txt_grupos" placeholder="Nome do Grupo" id="txt_grupos">
	<input type="submit" name="btn_grupo" id="btn_grupo" value="Criar">
	<div id="grupos"></div>

	<script>

		$(document).ready(function() {
			buscaGrupos();
		});

		const btn_grupo = document.getElementById('btn_grupo');
		const txt_grupos = document.getElementById('txt_grupos');

		btn_grupo.addEventListener("click", function(a){
			a.preventDefault();
			criarGrupo(txt_grupos.value);
		});

		function criarGrupo(nomeGrupo){
			$.ajax({
				url: "adicionar.php",
				type: "POST",
				data: {nomeGrupo : nomeGrupo},
				success : function(retorno){
					buscaGrupos();
					alert(retorno);
				},
				error : function(){
					alert("Erro ao adicionar");
				}
			});
		}

		function buscaGrupos(){
			$.ajax({
				url: "buscar.php",
				dataType: "json",
				success : function(resposta){
					$("#grupos").empty();
					let grupos;
					resposta.forEach(function(r){
						grupos += `
						<div class='gp_retorno'>
							<h1 class='id_grupo'>${r.id}</h1>
							<p>Id do Grupo: ${r.id_grupo}</p>
							<p>Nome do Grupo: ${r.nome_grupo}</p>
							<button class='btn_add'>Adicionar Membros</button>
							<button class='btn_rm'>Remover Grupo</button>
							<button class='btn_sort'>Sorteio</button>
						</div>
						`;
					});
					$("#grupos").append(grupos);
				},
				error : function(){
					alert("Erro ao buscar");
				}
			});
		}

		document.addEventListener("click", function(a){
			a.preventDefault();
			if(a.target.classList.contains("btn_add")){
				const div = a.target.closest("div");
		        const h2 = div.querySelector(".id_grupo"); 
		        const valor = h2.innerText;



				window.location.href = `membros.php?id_grupo=${valor}`;
			}
		});

		document.addEventListener("click", function(r){
			r.preventDefault();
			if(r.target.classList.contains("btn_rm")){
				const div = r.target.closest("div");
		        const h2 = div.querySelector(".id_grupo"); 
		        const id = h2.innerText;

		        apagarGrupo(id);
			}
		});

		document.addEventListener("click", function(s){
			s.preventDefault();
			if(s.target.classList.contains("btn_sort")){
				const div = s.target.closest("div");
		        const h2 = div.querySelector(".id_grupo"); 
		        const id = h2.innerText;

		        window.location.href = `../sorteio/index.php?id_grupo=${id}`;
			}
		});

		function apagarGrupo(id){
			$.ajax({
				url : "apagarGrupo.php",
				type : "POST",
				data : {id : id},
				success : function(retorno){
					alert(retorno);
					buscaGrupos();
				},
				error : function(){
					alert("Erro ao Apagar");
				}
			});
		}

	</script>
</body>
</html>