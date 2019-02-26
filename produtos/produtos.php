<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/functions.php";

	block_direct_access("kp");
	check_session();

	// Transforma a array $_POST/$_GET em uma string e passa a array para $data
	parse_str(http_build_query($_GET), $data);

	$id = $data["id"];

	if (!is_numeric($id))
		finish("error", "O ID informado é inválido!");

	// Conecta ao banco de dados e inclue a classe Produto
	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/db_access.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/classes/Produto.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/classes/Pedido.php";

	if (!produto::existe($id))
		finish("error", "O produto escolhido para excluir não existe!");

	// Exclue o produto de todos os pedidos em que ele está
	$sql = "DELETE FROM trufas_db.itens_pedido
					WHERE id_produto = $id";

	$conn->query($sql);
	
	try {
		
		// Exclue o produto
		produto::delete($id);
		
		
		/*
		 * Seleciona todos os codigos da tabela pedido
		 * para cada codigo, verificar se eles existem na tabela itens_peido
		 * se não existir, excluir o pedido
		 *
		 */
		
		$sql = "SELECT codigo
						FROM trufas_db.pedido";
			
		$result = produto::$conn->query($sql);

		if ($result->num_rows > 0):

			while( $row = $result->fetch_assoc() ):
		
				$codigos[] = $row["codigo"];

			endwhile;
		endif;
		
		foreach ($codigos as $codigo):
		
			$sql = "SELECT codigo_pedido 
							FROM itens_pedido 
							WHERE codigo_pedido = '$codigo'";

			$result = produto::$conn->query($sql);

			if ($result->num_rows == 0) {
				pedido::delete($codigo);
			}

		endforeach;
		
		finish("success", "O Produto foi deletado com sucesso!");
		
	} catch (Exception $e) {
		
		finish("error", $e->getMessage());
		
	}

	
?>