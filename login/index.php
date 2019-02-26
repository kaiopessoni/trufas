<?php 

	session_save_path($_SERVER["DOCUMENT_ROOT"] . '/trufas/inc/session/session_files');
	if (session_status() == PHP_SESSION_NONE)
    session_start();

	if (isset($_SESSION["tf_user_active"]))
		header("Location: /trufas");

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<title>Login - Trufas</title>
		<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/meta_tags.php"; ?>
	</head>
	<body>
		
		<!-- Header -->
		<header>
			<nav class="pink">
				<div class="nav-wrapper">
					<a class="brand-logo center" style="font-size: 1.5rem">Login - Trufas</a>
				</div>
			</nav>
		</header>
		
		<!-- Main -->
		<main>
			<div class="container">
			
			<form id="form_login" style="margin-top: 10%">
				<div class="row mb-0">
					<div class="input-field col s12">
						<i class="material-icons prefix grey-text">person</i>
						<input type="text" id="usuario" name="usuario">
						<label for="usuario">Usuário</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix grey-text">lock</i>
						<input type="password" id="senha" name="senha">
						<label for="senha">Senha</label>
					</div>
				</div>

				<div class="row">
					<div class="col s12 center">
						<button id="btn_login" type="button" class="btn waves-effect waves-light pink">Fazer Login</button>
						
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
		<script src="./login.js"></script>
	</body>
</html>