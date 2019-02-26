<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/session/autoload.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Adicionar Pedido - Trufas</title>
		<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/meta_tags.php"; ?>
	</head>
	<body>
		
		<!-- Header -->
		<?php $title = "Adicionar Pedido"; require_once $_SERVER['DOCUMENT_ROOT'] . "/trufas/inc/header.php"; ?>
		
		<!-- Main -->
		<main>
			<div class="container">
			<br>
			<form id="form_adicionar_pedido">
				
				<div class="row mb-0">
					<div class="input-field col s12">
						<i class="material-icons prefix grey-text">person</i>
						<input id="cliente" name="cliente" type="text">
						<label for="cliente">Nome do Cliente</label>
						<span class="helper-text">Obrigatório</span>
					</div>
				</div>
				
				<div class="row mb-0">
					<div class="input-field col s12">
						<i class="material-icons prefix grey-text">phone</i>
						<input type="text" id="telefone" name="telefone" autocomplete="off" >
						<label for="telefone">Telefone do Cliente</label>
					</div>
				</div>
		
				<?php
					
					/*** Listagem dos Produtos ***/
									
					require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/db_access.php";
					require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/classes/Produto.php";
				
					$sql = "SELECT * FROM trufas_db.produto ORDER BY nome;";
				
					$result = $conn->query($sql);

					$produtos = array();
				
					if ($result->num_rows > 0) {
							
						$i 		= 0;
						$ids 	= "";
						
						while($row = $result->fetch_assoc()) {
							
							$produtos[$i] = new Produto();
							$produtos[$i]->setId($row["id_produto"]);
							$produtos[$i]->setNome($row["nome"]);
							$produtos[$i]->setPreco($row["preco"]);
							
							// A lista de IDs dos produtos que existem no momento do pedido
							$ids = ($ids == "") ? $produtos[$i]->getId() : $ids . " " .  $produtos[$i]->getId();
							
							$i++;
						}
						
						$existe = true;
						$hide_btn = "";
						
					} else {
						
						$hide_btn = "hide";
						echo '<p class="center-align">Nenhum produto cadastrado! <br> Clique <a href="/trufas/adicionar-produto">aqui</a> para adicionar um produto.</p>';
					}
				
					if (isset($existe)) echo '<p class="center">Digite a quantidade  de cada produto</p>';
				
				?>
				
				
				<?php 
					echo '<ul id="produtos">';
					
						foreach ($produtos as $produto) :
					
							$id 	= $produto->getId();
							$nome = $produto->getNome();
					
							$str_id = "'p$id'";
					
							echo '<li>					
											<div class="row mb-0 valign-wrapper">
												<div class="col s6">'. $nome .'</div>
												<div class="col s6 center valign-wrapper">
													<div class="row mb-0 valign-wrapper">
														<div class="col s3" style="padding-right: 0">
															<a onclick="remove_qtd('. $str_id .')" class="btn-flat waves-effect product_qtd_btn" ><i class="material-icons pink-text">remove</i></a>
														</div>
														<div class="col s6">
															<input type="number" id="p'. $id .'" name="p'. $id .'" maxlength="3" class="center-align" value="0">
														</div>
														<div class="col s3" style="padding-left: 0"><a onclick="add_qtd('. $str_id .')" class="btn-flat waves-effect product_qtd_btn"><i class="material-icons pink-text">add</i></a></div>
													</div>
												</div>
											</div>
										</li>';
					
						endforeach;
					
					echo '</ul>';
				?>


				<br>
				<div class="row <?php echo $hide_btn; ?>">
					<div class="col s12 center">
						<button id="btn_adicionar" type="button" class="btn waves-effect waves-light pink">Adicionar Pedido</button>
						
						<div id="spinner_btn" class="preloader-wrapper small active" style="display: none">
							<div class="spinner-layer spinner-pink-only">
								<div class="circle-clipper left">
									<div class="circle"></div>
								</div><div class="gap-patch">
									<div class="circle"></div>
								</div><div class="circle-clipper right">
									<div class="circle"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
				
			</div>
		</main>
		
		<!-- Footer -->
		<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/trufas/inc/footer.php"; ?>
		<script src="./adicionar-pedido.js"></script>
		<script>
			var ids = "<?php if ($hide_btn != "hide") echo $ids ?>";
			
			// Adiciona +1 na quantidade do produto clicado
			function add_qtd(id) {
				var qtd = $("#" + id).val();

				if (qtd != 999)
					qtd++;

				$("#" + id).val(qtd);
			}

			// Remove -1 na quantidade do produto clicado
			function remove_qtd(id) {
				var qtd = $("#" + id).val();

				if (qtd != 0)
					qtd--;

				$("#" + id).val(qtd);
			}
		</script>
	</body>
</html>