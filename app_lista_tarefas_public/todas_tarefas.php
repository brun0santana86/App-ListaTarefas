<?php
	#variavel para recuperar no tarefa controller
	$acao = 'recuperar';
	#recuperar script do diretorio publico
	require 'tarefa_controller.php';
?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		
		<!-- script complementar para a funcao editar no botao de editar, das tarefas -->
		<script>
			function editar(id, txt_tarefa){
				// criar um form de de edicao, de forma programatica
				let form = document.createElement('form')
				form.action = 'tarefa_controller.php?acao=atualizar' //acao que o form vai tomar
				form.method = 'post' //metodo do tipo post
				form.className = 'row' // definir botao e input
				// criar um input para entrada do texto

				let inputTarefa = document.createElement('input')
				inputTarefa.type = 'text'  //tipo texto no input
				inputTarefa.name = 'tarefa' // nome do input
				inputTarefa.className = 'col-9 form-control' // classe do bootstrap
				inputTarefa.value = txt_tarefa //texto recebido no parametro da funcao, pelo on click

				//criar um input hidden para guardar o id da tarefa
				let inputId = document.createElement('input') //criar elemento
				inputId.type = 'hidden' // tipo oculto
				inputId.name = 'id' // nome do elemento
				inputId.value = id // valor recebido

				// criar um button para envio do form
				let button = document.createElement('button')
				button.type = 'submit' // tipo que envia o foorm quando clicado
				button.className = 'col -3 btn btn-info' // classe do bootstrap
				button.innerHTML = 'Atualizar' //texto interno encapsulado

				// incluir input tarefa no form(criar modelo de hierarquia)
				form.appendChild(inputTarefa) //incluir input tarefa no forma
				form.appendChild(inputId) // incluir id oculto
				form.appendChild(button) // incluir button no form

				// selecionar a div tarefa
				let tarefa = document.getElementById('tarefa_' + id)

				//limpar o texto da tarefa para inclusao do forma
				tarefa.innerHTML = ''

				//inclusao do forma na pagina
				tarefa.insertBefore(form, tarefa[0])

				
			}
				// funcao para remover uma tarefa
			function remover(id){
				location.href = 'todas_tarefas.php?acao=remover&id='+id;

			}

			//funcao de marcar realizada
			function marcarRealizada(id){
				location.href = 'todas_tarefas.php?acao=marcarRealizada&id='+id;
			}

		</script>

	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item active"><a href="#">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todas tarefas</h4>
								<hr />

								<? foreach ($tarefas as $indice => $tarefa) { ?>
									<div class="row mb-3 d-flex align-items-center tarefa">
									<div class="col-sm-9" id="tarefa_<?= $tarefa->id ?>"><?= $tarefa->tarefa ?> (<?= $tarefa->status ?>)</div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">
										<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $tarefa->id ?>)"></i>
										<!-- condicao para remover os botoes ou exibir em uma logica -->
										<? if($tarefa->status == 'pendente') { ?>
										<i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $tarefa->id ?>, '<?= $tarefa->tarefa ?>')"></i>
										<i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?= $tarefa->id ?>)"></i> <? } ?>
									</div>
								</div>
									
								<? } ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>