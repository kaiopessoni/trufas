<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/session/autoload.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Adicionar Produto - Trufas</title>
		<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/meta_tags.php"; ?>
	</head>
	<body>
		
		<!-- Header -->
		<?php $title = "Adicionar Produto"; require_once $_SERVER['DOCUMENT_ROOT'] . "/trufas/inc/header.php";?>
		
		<!-- Main -->
		<main>
			<div class="container">
			
			<br>
			<form id="form_adicionar_produto">
				<div class="row mb-0">
					<div class="input-field col s12">
						<i class="material-icons prefix grey-text">card_giftcard</i>
						<input type="text" id="nome" name="nome">
						<label for="nome">Nome do Produto</label>
						<span class="helper-text">Obrigatório</span>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix grey-text">attach_money</i>
						<input type="text" id="preco" name="preco">
						<label for="preco">Preço do Produto</label>
						<span class="helper-text">Obrigatório</span>
					</div>
				</div>

				<div class="row">
					<div class="col s12 center">
						<button id="btn_adicionar" type="button" class="btn waves-effect waves-light pink">Adicionar Produto</button>
						
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
		<script src="./adicionar-produto.js"></script>
	</body>
</html>