<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/session/autoload.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Ajuda - Trufas</title>
		<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/meta_tags.php"; ?>
	</head>
	<body>
		
		<!-- Header -->
		<?php $title = "Ajuda"; require_once $_SERVER['DOCUMENT_ROOT'] . "/trufas/inc/header.php";?>
		
		<!-- Main -->
		<main>
			<div class="container">
			<br><p style="margin-bottom: 1.5rem">Clique em algum tópico para saber mais.</p>
			<ul class="collapsible">
				<!-- Adicionar Pedido -->
				<li>
					<div class="collapsible-header"><i class="material-icons pink-text">add</i>Adicionar Pedido</div>
					<div class="collapsible-body">
						<p>Para adicionar um pedido, é necessário informar o <strong>nome do cliente</strong>, a <strong>quantidade de cada item</strong> e se quiser o <strong>telefone do cliente</strong> também.</p> 
						<p>Uma lista dos produtos existentes irá aparecer, você deve <strong>adicionar a quantidade</strong> desejada de cada produto.</p>
						<p><strong>Aviso:</strong> A lista dos produtos só aparecerá caso haja produtos cadastrados.</p>
					</div>
				</li>
				<!-- Ver Pedidos -->
				<li>
					<div class="collapsible-header"><i class="material-icons pink-text">view_list</i>Ver Pedidos</div>
					<div class="collapsible-body">
						<p>Ao clicar no ícone de <strong>ver pedidos</strong>, todos os pedidos são mostrados.</p>
						<p>Cada card de pedido possui 4 botões: <strong>remover</strong>, <strong>ver detalhes</strong>, <strong>entregue</strong> e <strong>pago</strong>.</p>
						<p>
							<ul>
								<li class="valign-wrapper"><i class="fas fa-trash-alt fa-sm red-text"></i>&nbsp;<strong class="red-text">Remover:</strong>&nbsp;remove o pedido.</li>
								<li><i class="fas fa-eye fa-sm pink-text"></i>&nbsp;<strong class="pink-text">Ver detalhes:</strong> abre uma janela mostrando os detalhes do pedidos e os itens do pedido.</li>
								<li><i class="fas fa-truck fa-sm entregue"></i>&nbsp;<strong class="entregue">Entregue:</strong> muda o status do pedido para <strong>entregue</strong>.</li>
								<li><i class="fas fa-check fa-sm pago"></i>&nbsp;<strong class="pago">Pago:</strong> muda o status do pedido para <strong>pago</strong>.</li>
							</ul>
						</p>
					</div>
				</li>
				<!-- Ver Produtos -->
				<li>
					<div class="collapsible-header"><i class="material-icons pink-text">card_giftcard</i>Ver Produtos</div>
					<div class="collapsible-body">
						<p>Ao clicar no ícone de <strong>ver produtos</strong>, todos os produtos são mostrados.</p>
						<p>Cada card de produto possui 2 botões: <strong>remover</strong> e <strong>editar</strong>.</p>
						<p>
							<ul>
								<li class="valign-wrapper"><i class="fas fa-trash-alt fa-sm red-text"></i>&nbsp;<strong class="red-text">Remover:</strong>&nbsp;remove o produto.</li>
								<li><i class="fas fa-pencil-alt fa-sm indigo-text"></i>&nbsp;<strong class="indigo-text">Editar:</strong> é redirecionado para outra tela onde poderá editar o <strong>nome</strong> e o <strong>preço</strong> do produto escolhido.</li>
							</ul>
						</p>
					</div>
				</li>
				<!-- Adicionar Produto -->
				<li>
					<div class="collapsible-header"><i class="material-icons pink-text">add_shopping_cart</i>Adicionar Produto</div>
					<div class="collapsible-body">
						<p>Para adicionar um produto, é necessário informar o <strong>nome</strong> e o <strong>preço</strong> do produto.</p> 
						<p><strong>Aviso:</strong> não é permitido produtos com o mesmo nome.</p> 
					</div>
				</li>
				<!-- Perfil -->
				<li>
					<div class="collapsible-header"><i class="material-icons pink-text">person</i>Perfil</div>
					<div class="collapsible-body">
						<p>Aqui você tem três opções:</p>
						<ul>
							<li><strong>&#8226;	Editar meu perfil:</strong> você pode trocar a sua senha e o seu nome de usuário.</li>
							<li><strong>&#8226;	Adicionar um usuário:</strong> você adiciona um novo usuário, é necessário informar o <strong>nome</strong> e a <strong>senha</strong>  do usuário.</li>
							<li><strong>&#8226;	Remover um usuário:</strong> para remover um usuário é necessário digitar o <strong>nome</strong> do usuário que deseja remover e clicar no botão de <strong>remover usuário</strong>.</li>
						</ul>
					</div>
				</li>
				<!-- Sair -->
				<li>
					<div class="collapsible-header"><i class="material-icons pink-text">exit_to_app</i>Sair</div>
					<div class="collapsible-body">
						<p>Ao clicar no ícone de <strong>sair</strong>, você deslogará e será redirecionado para a tela de login.</p>
					</div>
				</li>
			</ul>

			<br><p class="center">Desenvolvido por <strong>Kaio Pessoni</strong>.</p>
							
			</div>
		</main>
		
		<!-- Footer -->
		<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/trufas/inc/footer.php"; ?>
	</body>
</html>