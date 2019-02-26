<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/functions.php";

	block_direct_access("kp");
	check_session();

	// Transforma a array $_POST/$_GET em uma string e passa a array para $data
	parse_str(http_build_query($_GET), $data);

	$id 		= $data["id"];
	$nome 	= $data["nome"];
	$preco 	= $data["preco"];

	$preco 	= str_replace(".", "", $preco);
	$preco 	= str_replace(",", ".", $preco);
		
	/*** Validação dos dados ***/
	if (empty($nome)) 
		finish("error", "Por favor, preencha o nome do produto!");

	if (empty($preco)) 
		finish("error", "Por favor, preencha o preço do produto!");

	if (!is_numeric($preco)) 
		finish("error", "Por favor, digite apenas números no preço!");

	/*** Conecta ao banco de dados e inclue a classe Produto ***/
	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/db_access.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/classes/Produto.php";

	$produto = new Produto();
	
	$produto->setId($id);
	$produto->setNome($nome);
	$produto->setPreco($preco);

	try {
	
		$produto->update();
		finish("success", "Produto atualizado com sucesso!");
		
	} catch (Exception $e) {
		
		finish("error", $e->getMessage());
		
	}

?>