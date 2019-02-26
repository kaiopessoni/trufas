<?php 

	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/functions.php";

	block_direct_access("kp");
	check_session();

	// Transforma a array $_POST/$_GET em uma string e passa a array para $data
	parse_str(http_build_query($_GET), $data);

	/*** Recebimento dos dados e validação ***/

	// Lista de IDs de produtos existens no momento do pedido
	$ids = explode(" ", $data["ids"]);

	$cliente = $data["cliente"];
	$telefone = (isset($data["telefone"])) ? $data["telefone"] : "";

	if (empty($cliente))
		finish("error", "Por favor, preencha o nome do cliente!");
	
	// Verifica se algum produto possui a quantidade maior que 0
	foreach ($ids as $i => $id) :

		$qtd = $data["p$id"];

		if ($qtd > 0)
			$existe = true;
		
	endforeach;

	if (!isset($existe))
		finish("error", "Por favor, é necessário que no mínimo um <br> produto tenha uma quantidade maior que 0.");
	
	/*** Conexão com o banco de dados e inclue a classe Pedido e Item ***/
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/db_access.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/classes/Pedido.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/classes/Item.php";
	
	$pedido = new Pedido();
	
	$pedido->setData(date("Y-m-d H:i:s"));
	$pedido->setCliente($cliente);
	$pedido->setTelefone($telefone);

	try {
		$pedido->add_bd();
	} catch (Exception $e) {
		finish("error", $e->getMessage());
	}

	// Cria um objeto de Item para cada Produto que existe na lista e se a qtd for maior que 0
	foreach ($ids as $i => $id) :

		$qtd = $data["p$id"];

		if ($qtd > 0) {
			
			$itens[$i] = new Item();
			$itens[$i]->setProduto($id);
			$itens[$i]->setQtd($data["p$id"]);
			$itens[$i]->setPreco_praticado($itens[$i]->getPreco());
			
		}

	endforeach;

	foreach ($itens as $item) :

		$item->add_item_bd($pedido->getId(), $pedido->getCodigo());

	endforeach;

	finish("success", "O Pedido foi feito com sucesso!");

?>