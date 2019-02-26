<?php 

	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/functions.php";

	block_direct_access("kp");
	check_session();

	// Transforma a array $_POST/$_GET em uma string e passa a array para $data
	parse_str(http_build_query($_GET), $data);

	// Conexão com banco de dados e inclue a classe Pedido
	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/db_access.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/classes/Pedido.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/classes/Item.php";

	if (!isset($data["option"]))
		$codigo = $data["codigo"];

	switch($data["action"]):
			
		case "excluir": {

			try {
				pedido::delete($codigo);
				finish("success", "O Pedido foi excluído com sucesso!");
			} catch (Exception $e) {
				finish("error", $e->getMessage());
			}

			break;
			
		} case "entregue": {

			try {
				pedido::update_status($codigo,"Entregue");
				finish("success", "O status foi atualizado com sucesso!");
			} catch (Exception $e) {
				finish("error", $e->getMessage());
			}

			break;
			
		} case "pago": {
			
			try {
				pedido::update_status($codigo,"Pago");
				finish("success", "O status foi atualizado com sucesso!");
			} catch (Exception $e) {
				finish("error", $e->getMessage());
			}

			break;
			
		} case "detalhes": {
			
			$pedido = new Pedido();
		
			try {
				$pedido->setPedido($codigo);
			} catch (Exception $e) {
				finish("error", $e->getMessage());
			}

			$sql = "SELECT trufas_db.itens_pedido.id_produto 
							FROM trufas_db.itens_pedido
							INNER JOIN trufas_db.produto
								ON trufas_db.itens_pedido.id_produto = trufas_db.produto.id_produto
						 	WHERE codigo_pedido = '$codigo'
						 	ORDER BY nome";

			$result = pedido::$conn->query($sql);
			
			if ($result->num_rows > 0) {
				
				while ($row = $result->fetch_assoc()) {
					$ids_produtos[] = $row["id_produto"];
				}
				
			}
			
			foreach($ids_produtos as $i => $id_produto):
				
				$itens[$i] = new Item();
				$itens[$i]->setItem($codigo, $id_produto);
				
				$itens_array[] = array(
					"nome" =>  $itens[$i]->getNome(),
					"quantidade" => $itens[$i]->getQtd(),
					"preco_praticado" => str_replace(".", ",", $itens[$i]->getPreco_praticado())
				);

			endforeach;
			

			// Finaliza exibindo as informações do pedido
			echo json_encode(array(
				"status" 				=> "success",
				"codigo_pedido" => $pedido->getCodigo(),
				"status_pedido" => $pedido->getStatus(),
				"classe_status" => strtolower($pedido->getStatus()),
				"data_pedido" 	=> date("d/m/Y H:i", strtotime($pedido->getData())),
				"total_pedido" 	=> str_replace(".", ",", $pedido->getTotal()),
				"cliente" 			=> $pedido->getCliente(),
				"telefone" 			=> $pedido->getTelefone(),
				"usuario" 			=> $pedido->getUsuario(),
				"itens" 				=> $itens_array
			), JSON_PRETTY_PRINT);
			exit();


			break;
			
		} case "filtrar": {
			
			switch ($data["option"]):
			
				case "ultimo_mes": {
					
					$sql = "SELECT * FROM trufas_db.pedido
									WHERE
											data BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()
									ORDER BY data DESC";
					
					break;
			
				} case "nenhum_status": {
					
					$sql = "SELECT * FROM trufas_db.pedido
									WHERE
										status = '-'
									ORDER BY data DESC";
					
					break;
			
				} case "status_entregue": {
					
					$sql = "SELECT * FROM trufas_db.pedido
									WHERE
										status = 'Entregue'
									ORDER BY data DESC";
					
					break;
			
				} case "status_pago": {
					
					$sql = "SELECT * FROM trufas_db.pedido
									WHERE
										status = 'Pago'
									ORDER BY data DESC";
					
					break;
			
				} case "todos": {
					
					$sql = "SELECT * FROM trufas_db.pedido ORDER BY data DESC";
					
					break;
				} default:
					$option_error = true;
				
			endswitch;
			
			if (isset($option_error))
				finish("error", "Opção de filtro inválida!");

			$result = pedido::$conn->query($sql);

			if ($result->num_rows > 0) {

				$i = 0;

				while($row = $result->fetch_assoc()) {

					$pedidos[$i] = new Pedido();
					$pedidos[$i]->setPedido($row["codigo"]);
					$pedidos[$i]->setData( date("d/m/Y H:i", strtotime($row["data"])) );

					$classe_status = ($pedidos[$i]->getStatus() != "-") ? strtolower($pedidos[$i]->getStatus()) : "";
					
					$pedidos_array[] = array(
						"total" 				=> str_replace(".", ",", $pedidos[$i]->getTotal()),
						"codigo" 				=> $pedidos[$i]->getCodigo(),
						"status" 				=> $pedidos[$i]->getStatus(),
						"classe_status"	=> $classe_status,
						"data" 					=> $pedidos[$i]->getData(),
						"cliente" 			=> $pedidos[$i]->getCliente(),
						"telefone" 			=> $pedidos[$i]->getTelefone(),
						"id" 						=> $pedidos[$i]->getId()
					);
					
					$i++;
				}

				$existe = true;

			} else $pedidos_array = array();
			
			// Finaliza exibindo as informações do pedido
			echo json_encode(array(
				"status" 				=> "success",
				"pedidos" 				=> $pedidos_array
			), JSON_PRETTY_PRINT);
			exit();
			
			break;
		}
	
		default:
			$error = true;

	endswitch;
	
	if (isset($error))
		finish("error", "Ação inválida!");
	
	
?>