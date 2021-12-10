<?php
	#classe para instancia de um objeto que intermedia a gravacao de uma tarefa no banco de dados
	class TarefaService{
		#classe criada com metodos publicos
		
		private $conexao;  #variavel
		private $tarefa;   #variavel

			#construtor do objeto
		public function __construct(Conexao $conexao,Tarefa $tarefa){
			#recuperacao dos atributos e valores recebidos
			$this->conexao = $conexao->conectar();
			$this->tarefa = $tarefa;
		}


						#create
		public function inserir(){
				#insercao no banco de dados

				#criacao da query pro mysql
				$query = 'insert into tb_tarefas(tarefa)values(:tarefa)';
				#preparo do statement pdo com a conexao passando o metodo query
				$stmt = $this->conexao->prepare($query);
				#recuperar stmt para o metodo bind
				$stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
				#executar a query ja preparada
				$stmt->execute();

		}
						#read
		public function recuperar(){
				#criar query de consulta
			$query = 'select t.id, s.status, t.tarefa 
			from 
			tb_tarefas as t
			left join tb_status as s 
			on (t.id_status = s.id)';
				#criar stmt para receber pdo
			$stmt = $this->conexao->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
						#update
		public function atualizar(){
			// criar query do sgbd
			$query = "update tb_tarefas set tarefa = :tarefa where id = :id"; //setar atualizacao
			$stmt = $this->conexao->prepare($query);  // criacao da conexao para preparo do pdo
			$stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa')); //recuperar valor da tarefa atraves do metodo get
			$stmt->bindValue(':id', $this->tarefa->__get('id')); //recuperar valor da tarefa atraves do metodo get
			return $stmt->execute(); //executar stmt 



		}
						#delete
		public function remover(){
				$query = 'delete from tb_tarefas where id = :id';
				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':id', $this->tarefa->__get('id'));
				$stmt->execute();
		}

		public function marcarRealizada(){
			// criar query do sgbd
			$query = "update tb_tarefas set id_status = :id_status where id = :id"; //setar atualizacao
			$stmt = $this->conexao->prepare($query);  // criacao da conexao para preparo do pdo
			$stmt->bindValue(':id_status', $this->tarefa->__get('id_status')); //recuperar valor da tarefa atraves do metodo get
			$stmt->bindValue(':id', $this->tarefa->__get('id')); //recuperar valor da tarefa atraves do metodo get
			return $stmt->execute(); //executar stmt 



		}

		public function recuperarTarefasPendentes(){
					#criar query de consulta
			$query = 'select t.id, s.status, t.tarefa 
			from 
			tb_tarefas as t
			left join tb_status as s 
			on (t.id_status = s.id)
			where t.id_status = :id_status';
				#criar stmt para receber pdo
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);

		}
	}







?>