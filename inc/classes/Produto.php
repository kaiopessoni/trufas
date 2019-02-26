<?php 

	class Produto {
		
		/*** Static Variables ***/
		
		static $conn;
		
		/*** Private Variables ***/
		
		private $id, $nome, $preco;
		
		/*** Getters and Setters ***/
		
		public function getId() {
			return $this->id;
		}
		
		public function setId($id) {
			$this->id = $id;
		}
		
		public function getNome() {
			return $this->nome;
		}
		
		public function setNome($nome) {
			$this->nome = $nome;
		}
		
		public function getPreco() {
			return $this->preco;
		}
		
		public function setPreco($preco) {
			$this->preco = $preco;
		}
		
		
		/*** Static Functions ***/
		
		static function setConn($conn) {
			produto::$conn = $conn;
		}
		
		static function existe($id) {
			
			$sql = "SELECT * FROM trufas_db.produto
							WHERE id_produto = $id";
			
			$result = produto::$conn->query($sql);
			
			// Verifica se o produto existe
			return $result->num_rows > 0;
			
		}
		
		static function delete($id) {

			// Verifica se o produto existe
			if (produto::existe($id)) {
				
				// Exclue o produto de todos os pedidos em que ele está
				$sql = "DELETE FROM trufas_db.itens_pedido
								WHERE id_produto = $id";

				produto::$conn->query($sql);

				// Exclue o produto da sua tabela
				$sql = "DELETE FROM trufas_db.produto
								WHERE id_produto = $id";

				if (produto::$conn->query($sql) !== TRUE)
					throw new Exception("Não foi possível remover o produto. <br> <strong>Erro no servidor: </strong> " . produto::$conn->error, 10);

			} else throw new Exception("O produto escolhido para excluir não existe!", 1);

		}
		
		
		/*** Public Functions ***/
		
		public function setProduto($id) {
			
			$sql = "SELECT * FROM trufas_db.produto
							WHERE id_produto = $id";

			$result = produto::$conn->query($sql);
			
			if ($result->num_rows > 0) {
				
				while ($row = $result->fetch_assoc()) :
				
					$this->setId($row["id_produto"]);
					$this->setNome($row["nome"]);
					$this->setPreco($row["preco"]);
				
				endwhile;
				
			} else throw new Exception("O produto escolhido não existe!", 11);
			
		}
		
		public function add_bd() {
			
			$nome 	= $this->getNome();
			$preco 	= $this->getPreco();
			
			$sql = "SELECT nome
							FROM trufas_db.produto
							WHERE nome = '$nome'";
			
			$result = produto::$conn->query($sql);
			
			if ($result->num_rows > 0)
				throw new Exception("Já existe um produto com este nome!");
			
			
			$sql = "INSERT INTO trufas_db.produto (nome, preco)
							VALUES ('$nome', '$preco');";
			
			if (produto::$conn->query($sql) !== TRUE)
				throw new Exception("Não foi possível adicionar o produto. <br> <strong>Erro no servidor: </strong> " . produto::$conn->error, 10);
			
		}
		
		public function update() {
			
			$id 		= $this->getId();
			$nome 	= $this->getNome();
			$preco 	= $this->getPreco();
			
			$sql = "UPDATE trufas_db.produto
							SET nome = '$nome', preco = $preco 
							WHERE id_produto = $id";
			
			if (produto::$conn->query($sql) !== TRUE)
				throw new Exception("Não foi possível atualizar o produto. <br> <strong>Erro no servidor: </strong> " . produto::$conn->error, 10);
			
		}
		
	} // end class

	produto::setConn($conn);
	