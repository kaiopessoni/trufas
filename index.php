<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/session/autoload.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Pedidos - Trufas</title>
		<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/meta_tags.php"; ?>
	</head>
	<body>
		
		<!-- Header -->
		<?php $title = "Pedidos"; require_once $_SERVER['DOCUMENT_ROOT'] . "/trufas/inc/header.php"; ?>

				<!-- Main -->
		<main>
			<div class="container">
			
				<!-- Filtro -->
				<div class="row mb-0">
					<div class="col s12">
					<form id="form_filtro">
						<div class="input-field col s12">
							<select id="option_filtro" name="option_filtro">
								<option value="ultimo_mes" selected>Últimos 30 dias</option>
								<option value="nenhum_status">Nenhum status</option>
								<option value="status_entregue">Status Entregue</option>
								<option value="status_pago">Status Pago</option>
								<option value="todos">Todos os pedidos</option>
							</select>
							<label>Filtre os pedidos</label>
						</div>
					</form>
					</div>
				</div>
				<!-- FIM Filtro -->
				
				
				<!-- Pedidos -->
				<div class="row">
					<div class="col s12">
					
						<div id="pedidos"></div>
						
						<div class="center" style="margin-top: 50%;">
							<div id="spinner_btn" class="preloader-wrapper small active center" style="display: none">
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
				</div>
				
				
				<!-- Modal Detalhes do Pedido -->
				<div id="modal_detalhes_pedido" class="modal padding-modal"> 
					
					<div id="loading_detalhes" class="center" style="margin-top: .4rem;">
						<div class="preloader-wrapper small active ">
							<div class="spinner-layer spinner-pink-only">
								<div class="circle-clipper left">
									<div class="circle"></div>
								</div>
								<div class="gap-patch">
									<div class="circle"></div>
								</div>
								<div class="circle-clipper right">
									<div class="circle"></div>
								</div>
							</div>
						</div>
						<h6 class="pink-text">Carregando...</h6>
					</div>
				
					<div id="conteudo_detalhes" class="hide"></div>
				</div>
				<!-- FIM Modal Detalhes do Pedido -->
									
				<!-- Modal Confirm entregue -->
				<div id="modal_entregue" class="modal padding-modal confirm">
					<div class="row ">
						<div class="col s12">Deseja realmente mudar o status do pedido para <span class="entregue"><strong>Entregue</strong></span> ?</div>
					</div>
					<div class="row mb-0">
						<div class="col s6 center">
							<a id="btn_entregue" class="btn-flat waves-effect waves-green modal-close">Sim</a>
						</div>
						<div class="col s6 center">
							<a class="btn-flat waves-effect waves-red modal-close">Não</a>
						</div>
					</div>
				</div>
				<!-- FIM Modal Confirm entregue -->
				
				<!-- Modal Confirm pago -->
				<div id="modal_pago" class="modal padding-modal confirm">
					<div class="row ">
						<div class="col s12">Deseja realmente mudar o status do pedido para <span class="pago"><strong>Pago</strong></span> ?</div>
					</div>
					<div class="row mb-0">
						<div class="col s6 center">
							<a id="btn_pago" class="btn-flat waves-effect waves-green modal-close">Sim</a>
						</div>
						<div class="col s6 center">
							<a class="btn-flat waves-effect waves-red modal-close">Não</a>
						</div>
					</div>
				</div>
				<!-- FIM Modal Confirm pago -->
				
				<!-- Modal Confirm Excluir -->
				<div id="modal_excluir" class="modal padding-modal confirm">
					<div class="row ">
						<div class="col s12">Deseja realmente <span class="red-text"><strong>EXCLUIR</strong></span> este pedido?</div>
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
				

				
			</div>
		</main>
		
		<!-- Footer -->
		<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/trufas/inc/footer.php"; ?>
		<script src="/trufas/pedidos/pedidos.js"></script>
	</body>
</html>