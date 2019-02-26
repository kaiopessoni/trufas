<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/db_access.php";

	class Pedido {
		
		/*** Static Variables ***/
		
		static $conn;
		
		/*** Private Variables ***/

		private $id, $codigo, $data, $status, $cliente, $telefone, $usuario, $total;
		
		/*** Getters and Setters ***/
		
		public function getId() {
			return $this->id;
		}
		
		public function setId($id) {
			$this->id = $id;
		}
		
		public function getCodigo() {
			return $this->codigo;
		}
		
		public function setCodigo() {
			
			$id 	= $this->getId();
			$data = $this->getData();
			
			$codigo = $id . "|" . $data;
			$codigo = strtoupper( substr(sha1($codigo), -8 ) );
			
			$this->codigo = $codigo;
		}
		
		public function getData() {
			return $this->data;
		}
		
		public function setData($data) {
			$this->data = $data;
		}
		
		public function getStatus() {
			return $this->status;
		}
		
		public function setStatus($status) {
			$this->status = $status;
		}
		
		public function getCliente() {
			return $this->cliente;
		}
		
		public function setCliente($cliente) {
			$this->cliente = $cliente;
		}
		
		public function getTelefone() {
			return $this->telefone;
		}
		
		public function setTelefone($telefone) {
			$this->telefone = $telefone;
		}
		
		public function getUsuario() {
			return $this->usuario;
		}
		
		public function setUsuario($usuario) {
			$this->usuario = $usuario;
		}
		
		public function getTotal() {
			return $this->total;
		}
		
		/* 
		 * Define o valor total do pedido, multiplicando a quantidade do item pelo valor praticado.
		 */
		public function setTotal($codigo) {
			
			$sql = "SELECT SUM(preco_praticado * quantidade) AS total 
							FROM trufas_db.pedido
							INNER JOIN trufas_db.itens_pedido
								ON trufas_db.pedido.id_pedido = trufas_db.itens_pedido.id_pedido
							where trufas_db.pedido.codigo = '$codigo'";
			
			$result = pedido::$conn->query($sql);
			
			if ($result->num_rows > 0) {

				while($row = $result->fetch_assoc()) {

					$this->total = $row["total"];
				}
			}
			
		}
		
		/*** Static Functions ***/
		
		static function setConn($conn) {
			pedido::$conn = $conn;
		}
		
		static function existe($codigo) {
			
			$sql = "SELECT * FROM trufas_db.pedido
							WHERE codigo = '$codigo'";
			
			$result = pedido::$conn->query($sql);
			
			// Verifica se o pedido existe
			return $result->num_rows > 0;
			
		}
		
		static function delete($codigo) {

			// Verifica se o pedido existe
			if (pedido::existe($codigo)) {

				// Exclue o pedido da tabela itens_pedido
				$sql = "DELETE FROM trufas_db.itens_pedido
								WHERE codigo_pedido = '$codigo'";

				pedido::$conn->query($sql);
				
				// Exclue o pedido da sua tabela
				$sql = "DELETE FROM trufas_db.pedido
								WHERE codigo = '$codigo'";

				if (pedido::$conn->query($sql) !== TRUE)
					throw new Exception("Não foi possível remover o pedido. <br> <strong>Erro no servidor: </strong> " . produto::$conn->error, 10);

			} else throw new Exception("O pedido escolhido para remover não existe!", 11);

		}
		
		static function update_status($codigo, $status) {

			// Verifica se o pedido existe
			if (pedido::existe($codigo)) {
				
				$pedido = new Pedido();
				$pedido->setPedido($codigo);

				if ($pedido->getStatus() == $status)
					throw new Exception("O pedido já está com o status <strong>$status</strong>!");
				
				$sql = "UPDATE trufas_db.pedido
								SET status = '$status'
								WHERE codigo = '$codigo'";

				if (pedido::$conn->query($sql) !== TRUE)
					throw new Exception("Não foi possível atualizar o status do pedido. <br> <strong>Erro no servidor: </strong> " . produto::$conn->error, 10);

			} else throw new Exception("O pedido escolhido não existe!", 11);

		}
		
		/*** Public Functions ***/
		
		public function setPedido($codigo) {
			
			$sql = "SELECT * FROM trufas_db.pedido
							WHERE codigo = '$codigo'";

			$result = pedido::$conn->query($sql);
			
			if ($result->num_rows > 0) {
				
				while ($row = $result->fetch_assoc()) :
				
					$this->setId($row["id_pedido"]);
					$this->codigo = $row["codigo"];
					$this->setData($row["data"]);
					$this->setStatus($row["status"]);
					$this->setCliente($row["cliente"]);
					$this->setTelefone($row["telefone"]);
					$this->setUsuario($row["usuario"]);
					$this->setTotal($row["codigo"]);
				
				endwhile;
				
			} else throw new Exception("O pedido escolhido não existe!", 11);
			
		}
		
		public function add_bd() {
			
			$usuario = $_SESSION["tf_usuario"];
			
			// Atributos do Pedido
			$nome 		= $this->getCodigo();
			$data 		= $this->getData();
			$cliente 	= $this->getCliente();
			$telefone = $this->getTelefone();
			
			// Adiciona o Pedido no BD
			$sql = "INSERT INTO trufas_db.pedido (data, status, cliente, telefone, usuario)
							VALUES ('$data', '-', '$cliente', '$telefone', '$usuario');";
			
			if (pedido::$conn->query($sql) !== TRUE)
				throw new Exception("Não foi possível adicionar o pedido. <br> <strong>Erro no servidor: </strong> " . produto::$conn->error, 10);
			
			// Atribui o ID do pedido
			$this->setId(pedido::$conn->insert_id);
			
			// Gera o código sha1 do pedido
			$this->setCodigo();
			$codigo = $this->getCodigo();
			
			// Atualiza o Código do pedido no BD
			$sql = "UPDATE trufas_db.pedido
							SET codigo = '$codigo'
							WHERE id_pedido = " . $this->getId();
			
			pedido::$conn->query($sql);
			
		}
		
	} // end class

	pedido::setConn($conn);