<?php 

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

	session_save_path($_SERVER["DOCUMENT_ROOT"] . '/trufas/inc/session/session_files');

	if (session_status() == PHP_SESSION_NONE)
    session_start();

	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/session/session_start.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/trufas/inc/session/session_expiration.php";