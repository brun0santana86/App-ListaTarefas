<?php
	# classe de conexao com MySql utilizando PDO
	class Conexao{
		
		private $host = 'localhost';  #host local de conexao
		private $dbname = 'php_com_pdo';  #nome da base de dados
		private $user = 'root'; #usuario conexao
		private $pass = 'bds02101986'; #senha usuario



		public function conectar(){

			try {
				#criacao de forma nativa usando o PDO
				$conexao = new PDO(
					"mysql:host=$this->host;dbname=$this->dbname", #driver de conexao(mysql), definir o host, dbname(nome do banco de dados)
					"$this->user", #recuperar usuario na conexao
					"$this->pass", #recuperar senha na conexao
				);

				return $conexao; #retorna o metodo da conexao

			}
				#recuperacao de erro pelo metodo PDOException para melhor visualizacao casjo houver algum erro
			catch(PDOException $e){
				echo '<p>' .$e->getMessage(). '</p>';
			}
		}
	}
	

?>