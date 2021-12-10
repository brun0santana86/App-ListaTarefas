<?php
	
		#criacao da classe de tarefas com metodos privados
	class Tarefa{
		private $id;
		private $id_status;
		private $tarefa;
		private $data_cadastro;

			# criacao do metodo publico para manipulacao, com metodo get e set magicos
		public function __get($atributo){
			return $this->$atributo;
		}
			# recebe o atributo e seu respectivo valor
		public function __set($atributo, $valor){
			$this->$atributo = $valor;
		}
	}

?>