<?php
	require_once 'config.php';

	session_start();

	$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)
		or die('Error connecting to the database.');
	$db->set_charset("utf8mb4");
