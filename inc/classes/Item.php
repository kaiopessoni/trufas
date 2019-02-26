<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/classes/Produto.php";

	class Item extends Produto {

		/*** Private Variables ***/
		
		// $id, $nome, $preco;
		private $qtd, $preco_praticado;
		
		
		/*** Getters and Setters ***/
		
		public function getQtd() {
			return $this->qtd;
		}
		
		public function setQtd($qtd) {
			$this->qtd = $qtd;
		}
		
		public function getPreco_praticado() {
			return $this->preco_praticado;
		}
		
		public function setPreco_praticado($preco_praticado) {
			$this->preco_praticado = $preco_praticado;
		}
		
		
		/*** Public Functions ***/
		
		public function add_item_bd($id_pedido, $codigo_pedido) {
			
			$id_produto 			= $this->getId();
			$preco_praticado 	= $this->getPreco_praticado();
			$quantidade 			= $this->getQtd();
			
			$sql = "INSERT INTO trufas_db.itens_pedido (id_pedido, id_produto, codigo_pedido, preco_praticado, quantidade)
							VALUES ($id_pedido, $id_produto, '$codigo_pedido', $preco_praticado, $quantidade)";
			
			if (item::$conn->query($sql) !== TRUE)
				throw new Exception("Não foi possível adicionar o item. <br> <strong>Erro no servidor: </strong> " . produto::$conn->error, 10);
			
		}
		
		public function update_item($codigo_pedido, $id_produto) {
			
			$qtd = $this->getQtd();
			$preco_praticado = $this->getPreco_praticado();
			
			$sql = "UPDATE trufas_db.itens_pedido
							SET quantidade = $qtd, preco_praticado = $preco_praticado
							WHERE 
								codigo_pedido = '$codigo_pedido' AND id_produto = $id_produto";
			
			if (item::$conn->query($sql) !== TRUE)
				throw new Exception("Não foi possível atualizar o item. <br> <strong>Erro no servidor: </strong> " . produto::$conn->error, 10);
			
		}
		
		public function setItem($codigo_pedido, $id_produto) {
			
			$sql = "SELECT * FROM trufas_db.itens_pedido
							INNER JOIN trufas_db.produto
								ON trufas_db.produto.id_produto = trufas_db.itens_pedido.id_produto
							WHERE 
								codigo_pedido = '$codigo_pedido' AND 
								trufas_db.itens_pedido.id_produto = '$id_produto'";

			$result = item::$conn->query($sql);
			
			if ($result->num_rows > 0) {
				
				while ($row = $result->fetch_assoc()) :
				
					$this->setId($row["id_produto"]);
					$this->setNome($row["nome"]);
					$this->setPreco($row["preco"]);
					$this->setPreco_praticado($row["preco_praticado"]);
					$this->setQtd($row["quantidade"]);
				
				endwhile;
				
			} else throw new Exception("O item escolhido não existe!", 11);
			
		}
		
		
		/*** Static Functions ***/
		
		static function existe_item($codigo_pedido, $id_produto) {
			
			$sql = "SELECT * FROM trufas_db.itens_pedido
							WHERE codigo_pedido = '$codigo_pedido' AND id_produto = '$id_produto'";
			
			$result = item::$conn->query($sql);
			
			// Verifica se o item do pedido existe
			return $result->num_rows > 0;
			
		}
		
		static function remove_item($codigo_pedido, $id_produto) {
			
			if (item::existe_item($codigo_pedido, $id_produto)) {
				 
				$sql = "DELETE FROM trufas_db.itens_pedido
				WHERE codigo_pedido = '$codigo_pedido' AND id_produto = $id_produto";
			
				if (item::$conn->query($sql) !== TRUE)
					throw new Exception("Não foi possível remover o item do pedido. <br> <strong>Erro no servidor: </strong> " . produto::$conn->error, 10);
				
			} else throw new Exception("O item do pedido não existe");

		}
		
	} // end class

	