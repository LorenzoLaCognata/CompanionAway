<?php
	$lang = basename(__DIR__);
	$currentPage = basename(__FILE__);
	
	$langJson = file_get_contents('travel_demo/lang.json');
	$translations = json_decode($langJson, true);

	// REVIEW TO OPTIMIZE
	$pageStylesheet = '/assets/css/style.css';
?>

<?php include 'head.php'; ?>

<?php include '../assets/page/travel_demo/header.php'; ?>

<?php include '../assets/page/travel_demo/sidebar.php'; ?>

<?php
	if (isset($_GET['section'])) {
		$section = $_GET['section'];
	} else {
		$section = 'day_1';
	}

	switch ($section) {
		case 'day_1':
			include '../assets/page/travel_demo/travel_info.php';
			break;
		default:
			break;
	}
?>

<?php include '../assets/page/travel_demo/locked.php'; ?>

<?php include 'footer.php'; ?>
