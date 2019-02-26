<?php 

	class Usuario {
		
		/*** Static Variables ***/
		
		static $conn;
		
		/*** Private Variables ***/
		
		private $usuario, $senha;
		
		/*** Getters and Setters ***/
		
		public function getUsuario() {
			return strtolower($this->usuario);
		}
		
		public function setUsuario($usuario) {
			$this->usuario = strtolower($usuario);
		}
		
		public function getSenha() {
			return $this->senha;
		}
		
		public function setSenha($senha) {
			$this->senha = $senha;
		}
		
		/*** Static Functions ***/
		
		static function setConn($conn) {
			usuario::$conn = $conn;
		}
		
		static function existe($usuario) {
			
			$sql = "SELECT usuario
							FROM trufas_db.usuario
							WHERE usuario = '$usuario'";
			
			$result = usuario::$conn->query($sql);

			if ($result->num_rows > 0)
				return true;
			else
				return false;
		}
		
		static function getSha1($usuario) {
			
			if (usuario::existe($usuario)) {
				
				$sql = "SELECT senha
								FROM trufas_db.usuario
								WHERE usuario = '$usuario'";
				
				$result = usuario::$conn->query($sql);
				
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$senha = $row["senha"];
					}
				} 
				
				return $senha;
				
			} else throw new Exception("Não foi possível receber o SHA1 do usuário pois ele não existe!");
			
		}
		
		static function delete($usuario) {
			
			if (!usuario::existe($usuario))
				throw new Exception("Impossível remover o usuário. <br> O Usuário não existe!");
			
			$sql = "DELETE FROM trufas_db.usuario
							WHERE usuario = '$usuario'";
			
			if (usuario::$conn->query($sql) !== TRUE)
				throw new Exception("Não foi possível adicionar um novo Usuário. <br> <strong>Erro no servidor: </strong> " . produto::$conn->error);
			
		}
		
		/*** Public Functions ***/
		
		public function user($usuario) {
			
			if (usuario::existe($usuario)) {
				
				$sql = "SELECT *
								FROM trufas_db.usuario
								WHERE usuario = '$usuario'";
				
				$result = usuario::$conn->query($sql);
				
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$this->setUsuario($row["usuario"]);
						$this->setSenha($row["senha"]);
					}
				} 
				
			} else throw new Exception("O usuário informado não existe!");
			
		}
		
		public function add_bd() {
			
			$usuario 	= $this->getUsuario();
			$senha		= sha1($this->getSenha());
			
			if (usuario::existe($usuario))
				throw new Exception("Impossível adicionar o novo usuário. Usuário já existe!");
			
			$sql = "INSERT INTO trufas_db.usuario (usuario, senha)
							VALUES ('$usuario', '$senha')";
			
			if (usuario::$conn->query($sql) !== TRUE)
				throw new Exception("Não foi possível adicionar um novo Usuário. <br> <strong>Erro no servidor: </strong> " . produto::$conn->error);
			
		}
		
		public function update($user) {
			
			$usuario 	= $this->getUsuario();
			$senha		= $this->getSenha();
			
			if (!usuario::existe($user))
				throw new Exception("Impossível atualizar o usuário. Usuário não existe!");
			
			$sql = "UPDATE trufas_db.usuario
							SET
								usuario = '$usuario',
								senha 	= '$senha'
							WHERE usuario = '$user'";
			
			if (usuario::$conn->query($sql) !== TRUE)
				throw new Exception("Não foi possível atualizar o usuário. <br> <strong>Erro no servidor: </strong> " . produto::$conn->error);
		}
		
		
	} // end class

	usuario::setConn($conn);
