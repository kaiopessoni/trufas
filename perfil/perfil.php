<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/functions.php";
	
	block_direct_access("kp");
	check_session();

	// Transforma a array $_POST/$_GET em uma string e passa a array para $data
	parse_str(http_build_query($_GET), $data);

	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/db_access.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/classes/Usuario.php";

	switch ($data["action"]):

		case "atualizar": {
			
			$usuario 			= $_SESSION["tf_usuario"];
			$novo_usuario = $data["usuario"];
			$senha 				= $data["senha"];
			
			if ( preg_match('/\s/', $novo_usuario) || !preg_match("/^[a-zA-Z]+$/", $novo_usuario) )
				finish("error", "Nome de usuário inválido!");
			
			$user = new Usuario();
			
			try {
				$user->user($usuario);
			} catch (Exception $e) {
				finish("error", $e->getMessage());
			}
			
			if ($novo_usuario != $usuario)
				$user->setUsuario($novo_usuario);
			
			if ($senha != "")
				$user->setSenha(sha1($senha));
			
			try {
				$user->update($usuario);
				$_SESSION["tf_usuario"] = $novo_usuario;
				finish("success", "Usuário atualizado com sucesso!");
			} catch (Exception $e) {
				finish("error", $e->getMessage());
			}
			
			break;
			
		} case "adicionar": {

			$usuario 	= strtolower($data["usuario"]);
			$senha 		= $data["senha"];
			$senha2 	= $data["senha2"];

			if (empty($usuario) || empty($senha) || empty($senha2))
				finish("error", "Por favor, preencha todos os campos!");

			if ( preg_match('/\s/', $usuario) || !preg_match("/^[a-zA-Z]+$/", $usuario) )
				finish("error", "Nome de usuário inválido!");

			if ($senha != $senha2)
				finish("error", "As senhas estão diferentes!");

			$user = new Usuario();
			$user->setUsuario($usuario);
			$user->setSenha($senha);
	
			try {
				$user->add_bd();
				finish("success", "O usuário foi adicionado!");
			} catch (Exception $e) {
				finish("error", $e->getMessage());
			}

			break;
			
		} case "remover": {
			
			$usuario = strtolower($data["usuario"]);
			
			if (empty($usuario))
				finish("error", "Por favor, digite um nome de usuário!");
			
			if ( preg_match('/\s/', $usuario) || !preg_match("/^[a-zA-Z]+$/", $usuario) || $usuario == "master" || $usuario == "patricia")
				finish("error", "Nome de usuário inválido!");
			
			if ($usuario == $_SESSION["tf_usuario"])
				finish("error", "Você não pode remover você mesmo. <br> Tente com outra conta.");
				
			try {
				usuario::delete($usuario);
				finish("success", "O usuário foi removido com sucesso!");
			} catch (Exception $e) {
				finish("error", $e->getMessage());
			}
			
			break;
			
		} case "lista": {
			
			$sql = "SELECT usuario
				FROM trufas_db.usuario
				ORDER BY usuario";

			$result = $conn->query($sql);

			if ($result->num_rows > 1) {
			
				while($row = $result->fetch_assoc()) {

					if ($row["usuario"] == "master")
						continue;

					$usuarios[] = $row["usuario"];
				}
			
			} else
				$usuarios = array();
			
			echo json_encode(array(
				"status" 	=> "success",
				"usuarios" => $usuarios
			), JSON_PRETTY_PRINT);
			exit();
			
		}
			
	endswitch;


?>