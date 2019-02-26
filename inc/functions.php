<?php

	date_default_timezone_set("America/Sao_Paulo");


	function finish($status, $message, $code = null) {
		echo json_encode(array(
			"status" 	=> $status,
			"message" => $message,
			"code" 		=> $code
		));
		exit();
	}


	function block_direct_access($name, $type = "GET") {
		
		switch ($type) {
			case "GET":
				if ($_GET[$name] !== "true")
			    header("Location: /trufas");
				break;
			case "POST":
				if ($_POST[$name] !== "true")
			    header("Location: /trufas");
				break;
			default:
				header("Location: /trufas");
		}
		
	}

	function check_session() {
		
		session_save_path($_SERVER["DOCUMENT_ROOT"] . '/trufas/inc/session/session_files');
		if (session_status() == PHP_SESSION_NONE)
			session_start();
		
		$max_time_session = 60 * 60;

		if (time() - $_SESSION['tf_last_time_access'] > $max_time_session) {
			finish("error", "Sessão expirada! Por favor, recarregue a página e logue novamente.");
		}
	}


?>