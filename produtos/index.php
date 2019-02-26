<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/session/autoload.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Produtos Cadastrados - Trufas</title>
		<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/meta_tags.php"; ?>
	</head>
	<body>
		
		<!-- Header -->
		<?php $title = "Produtos"; require_once $_SERVER['DOCUMENT_ROOT'] . "/trufas/inc/header.php"; ?>
		
		<!-- Main -->
		<main>
			<div class="container">
			
				<?php
					
					/*** Listagem dos Produtos ***/
									
					require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/db_access.php";
					require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/classes/Produto.php";
				
					$sql = "SELECT * FROM trufas_db.produto ORDER BY nome;";
				
					$result = $conn->query($sql);

					$produtos = array();
				
					if ($result->num_rows > 0) {
							
						$i 		= 0;
						
						while($row = $result->fetch_assoc()) {
							
							$produtos[$i] = new Produto();
							$produtos[$i]->setProduto($row["id_produto"]);

							$i++;
						}
						
						$existe = true;
						
					} else echo '<p class="center-align">Nenhum produto cadastrado! <br> Clique <a href="/trufas/adicionar-produto">aqui</a> para adicionar um produto.</p>';

					foreach ($produtos as $i => $produto) :
						
						$id			= $produto->getId();
						$nome 	= $produto->getNome();
						$preco 	= str_replace(".", ",", $produto->getPreco());
				
						echo "<!-- Card Produto -->
									<div class='card' id='card-$id'>
										<div class='card-content'>

											<div class='row'>
												<div class='col s9 pink-text'>
													<div class='row'>
														<div class='col s12' style='margin-bottom: .5rem'>
															<strong>$nome</strong>
														</div>
													</div>
													<div class='row'>
														<div class='col s12'>
															<strong>R$ $preco</strong>
														</div>
													</div>
												</div>

												<div class='col s3'>
													<div class='row'>
														<div class='col s12 center' style='margin-bottom: .5rem'>
															<a class='modal-trigger' href='/trufas/produtos/editar/?produto=$id'>
																<i class='fas fa-pencil-alt indigo-text'></i>
															</a>
														</div>
													</div>
													<div class='row'>
														<div class='col s12 center'>
															<a class='modal-trigger' href='#modal_excluir' onclick='btn_excluir($id)'>
																<i class='fas fa-trash-alt red-text'></i>
															</a>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
									<!-- FIM Card Produto -->";
				
					endforeach;
				
				?>
			</div>
			
			<!-- Modal Confirm Excluir -->
			<div id="modal_excluir" class="modal padding-modal confirm">
				<div class="row ">
					<div class="col s12">Deseja realmente <span class="red-text"><strong>EXCLUIR</strong></span> este produto? O produto será <strong>excluído de todos</strong> os pedidos em que ele está!</div>
				</div>
				<div class="row mb-0">
					<div class="col s6 center">
						<a id="btn_excluir" class="btn-flat waves-effect waves-green modal-close">Sim</a>
					</div>
					<div class="col s6 center">
						<a class="btn red waves-effect waves-light modal-close">Não</a>
					</div>
				</div>
			</div>
			<!-- FIM Modal Confirm Excluir -->
			
			<!-- Modal Editar -->
			<div id="modal_editar" class="modal padding-modal">
				<div class="row">
					<div class="col s12"></div>
				</div>
			</div>
			<!-- FIM Modal Confirm Excluir -->
			
		</main>
		
		<!-- Footer -->
		<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/trufas/inc/footer.php"; ?>
		<script src="./produtos.js"></script>
	</body>
</html>