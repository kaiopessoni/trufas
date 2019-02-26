<?php 

	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/functions.php";

	block_direct_access("kp");

	// Transforma a array $_POST/$_GET em uma string e passa a array para $data
	parse_str(http_build_query($_GET), $data);

	$usuario 	= $data["usuario"];
	$senha 		= $data["senha"];

	/*** Valida os dados ***/
	if (empty($usuario) || empty($senha))
		finish("error", "Por favor, preencha todos os campos!");

	// Verifica se possui espaços e se é somente letras
	if ( preg_match('/\s/', $usuario) || !preg_match("/^[a-zA-Z]+$/", $usuario) )
		finish("error", "Nome de usuário inválido!");

	/*** Conecta ao banco de dados e inclue a classe Usuario ***/
	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/db_access.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/classes/Usuario.php";

	$user = new Usuario();

	// Verifica se o usuário existe
	try {
		$user->user($usuario);
	} catch (Exception $e) {
		finish("error", $e->getMessage());
	}

	// Verifica se a senha está correta
	if (usuario::getSha1($usuario) != sha1($senha))
		finish("error", "A senha informada está incorreta!");

	session_save_path($_SERVER["DOCUMENT_ROOT"] . '/trufas/inc/session/session_files');
	if (session_status() == PHP_SESSION_NONE)
    session_start();

	$_SESSION["tf_user_active"] = true;
	$_SESSION["tf_usuario"] 		= strtolower($usuario);
	
	$_SESSION["tf_last_time_access"] = time();

	finish("success", "");


?>