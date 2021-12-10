<?php
	#script privado de controle de tarefas

	#requisicao dos scripts de modelo, service e conexao, para controle, em niveis de hierarquia nos diretorios
	#require ja vem do tarefa controle do nivel publico
	require "../../app_lista_tarefas_private/tarefa.model.php";
	require "../../app_lista_tarefas_private/tarefa.service.php";
	require "../../app_lista_tarefas_private/conexao.php";

	#teste para recuperar a variavel acao para controlar o tratamento da informacao recebido por parametro
	$acao = isset ($_GET['acao']) ? $_GET['acao'] : $acao;


	#super global get para recuperar o parametro de inserir na aba nova tarefa, no action do form
	if($acao == 'inserir'){

	#intancia do objeto tarefa
	$tarefa = new Tarefa();
	$tarefa->__set('tarefa', $_POST['tarefa']);

	#instancia de conexao
	$conexao = new Conexao();

	#instancia de tarefa service, que vai recuperar o objeto e realizar a operacao no banco de dados
	$tarefaService = new TarefaService($conexao, $tarefa);
	#executar o metodo de inserir
	$tarefaService->inserir();

	#redirecionar o usuario para a pagina de sucesso
	header('Location: nova_tarefa.php?inclusao=1');
}	else if ($acao == 'recuperar'){
		#criar uma instancia de tarefa
		$tarefa = new Tarefa();
		$conexao = new Conexao();
		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefas = $tarefaService->recuperar();
} else if ($acao == 'atualizar'){
	 // regra de negocio para atualizacao
		$tarefa = new Tarefa();
		$tarefa->__set('id', $_POST['id']); // setar respectivo id cujo valor sera indice id da super globlal post
		$tarefa->__set('tarefa', $_POST['tarefa']); // setar tarefa atraves da super global psot
		$conexao = new Conexao(); //instancia de conexao
		$tarefaService = new tarefaService($conexao, $tarefa); //instancia de tarefa service
		// executar metodo criado para atualizacao
		if($tarefaService->atualizar()) {
			
			if(isset ($_GET['pag']) && $_GET['pag'] == 'index'){
				header('Location:index.php');
			} else {
			header('Location:todas_tarefas.php');
		}
		}


}	else if($acao == 'remover'){
		// logica de remocao da tarefa
		$tarefa = new Tarefa();  // variavel
		$tarefa->__set('id', $_GET['id']);  // recuperar a instancia do objeto via get
		$conexao = new Conexao(); 

		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->remover();
		if(isset ($_GET['pag']) && $_GET['pag'] == 'index'){
				header('Location:index.php');
			} else {
			header('Location:todas_tarefas.php');
		}

}  else if($acao == 'marcarRealizada'){
		//logica para aleterar status da acao

		$tarefa = new Tarefa();
		$tarefa->__set('id', $_GET['id']);
		$tarefa->__set('id_status', 2);
		$conexao = new Conexao();
		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->marcarRealizada();
		if(isset ($_GET['pag']) && $_GET['pag'] == 'index'){
				header('Location:index.php');
			} else {
			header('Location:todas_tarefas.php');
		}
} elseif ($acao == 'recuperarTarefasPendentes') {
		#criar uma instancia de tarefa
		$tarefa = new Tarefa();
		$tarefa->__set('id_status', 1);
		$conexao = new Conexao();
		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefas = $tarefaService->recuperarTarefasPendentes();

}

?>