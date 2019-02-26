<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/session/autoload.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Perfil - Trufas</title>
		<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/meta_tags.php"; ?>
	</head>
	<body>
		
		<!-- Header -->
		<?php $title = "Perfil"; require_once $_SERVER['DOCUMENT_ROOT'] . "/trufas/inc/header.php";?>
		
		<!-- Main -->
		<main>
			<div class="container">
			<br>			
			<div class="row">
				<div class="input-field col s12">
					<select id="select_action" >
						<option value="1" selected>Editar meu perfil</option>
						<option value="2">Adicionar um usuário</option>
						<option value="3">Remover um usuário</option>
					</select>
					<label>O que deseja fazer?</label>
				</div>
			</div>
			
			<!-- Editar Perfil -->
			<div id="div_editar">
				<form id="form_atualizar">
				
					<div class="row mb-0">
						<div class="input-field col s12">
							<i class="material-icons prefix grey-text">person</i>
							<input type="text" id="usuario" name="usuario" value="<?php echo $_SESSION["tf_usuario"]; ?>">
							<label for="usuario">Novo nome de usuário</label>
						</div>
					</div>
					
					<div class="row">
						<div class="input-field col s12">
							<i class="material-icons prefix grey-text">lock</i>
							<input type="password" id="senha" name="senha">
							<label for="senha">Nova Senha</label>
							<span class="helper-text">Deixe em branco caso não deseja alterar</span>
						</div>
					</div>
					
				<div class="row">
					<div class="col s12 center">
						<button id="btn_atualizar" type="button" class="btn waves-effect waves-light pink disabled">Atualizar Perfil</button>
						
						<div id="spinner_atualizar" class="preloader-wrapper small active" style="display: none">
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
			
			<!-- Adicionar Usuário -->
			<div id="div_adicionar" style="display: none;">
				<form id="form_adicionar">
				
					<div class="row mb-0">
						<div class="input-field col s12">
							<i class="material-icons prefix grey-text">person</i>
							<input type="text" id="novo_usuario" name="usuario">
							<label for="novo_usuario">Usuário</label>
						</div>
					</div>
					
					<div class="row mb-0">
						<div class="input-field col s12">
							<i class="material-icons prefix grey-text">lock</i>
							<input type="password" id="nova_senha" name="senha">
							<label for="nova_senha">Senha</label>
						</div>
					</div>
					
					<div class="row">
						<div class="input-field col s12">
							<i class="material-icons prefix grey-text">lock</i>
							<input type="password" id="nova_senha2" name="senha2">
							<label for="nova_senha2">Confirme a senha</label>
						</div>
					</div>
					
					<div class="row">
						<div class="col s12 center">
							<button id="btn_adicionar" type="button" class="btn waves-effect waves-light pink">Adicionar Usuário</button>

							<div id="spinner_adicionar" class="preloader-wrapper small active" style="display: none">
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
			
			<!-- Remover Usuário -->
			<div id="div_remover" style="display: none;">
				<form id="form_remover">
				
					 <div class="row">
						<div class="input-field col s12">
							<i class="material-icons prefix grey-text">person</i>
							<input type="text" id="remover_usuario" name="usuario">
							<label for="remover_usuario">Usuário</label>
							<span class="helper-text">Digite o nome do usuário que deseja remover</span>
						</div>
					</div>
					
					<div class="row">
						<div class="col s12 center">
							<button id="btn_remover" type="button" class="btn waves-effect waves-light pink">remover Usuário</button>

							<div id="spinner_remover" class="preloader-wrapper small active" style="display: none">
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
					
				<table class="centered highlight">
					<thead>
						<tr>
								<th class="pink-text">Usuários Cadastrados</th>
						</tr>
					</thead>

					<tbody id="lista_usuarios">
					</tbody>
				</table>
					
			</div>
			
			</div>
		</main>
		
		<!-- Footer -->
		<?php $no_spacer_btn = true; require_once $_SERVER['DOCUMENT_ROOT'] . "/trufas/inc/footer.php"; ?>
		<script src="./perfil.js"></script>
		<script>var original_user = "<?php echo $_SESSION["tf_usuario"]; ?>";</script>
	</body>
</html>