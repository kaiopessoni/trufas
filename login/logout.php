<?php 

	session_save_path($_SERVER["DOCUMENT_ROOT"] . '/trufas/inc/session/session_files');

	if (session_status() == PHP_SESSION_NONE)
    session_start();

	unset($_SESSION["tf_user_active"]);
	header("Location: /trufas/login");

?>