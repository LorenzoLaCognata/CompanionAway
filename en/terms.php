<?php
	$lang = basename(__DIR__);
	$currentPage = basename(__FILE__);

	$langJson = file_get_contents('terms/lang.json');
	$translations = json_decode($langJson, true);

	$pageStylesheet = [
		'/assets/css/document-style.min.css',
		'/assets/css/legal-style.min.css'
	];
?>

<?php include 'head.php'; ?>

<?php include 'header.php'; ?>

<?php include '../assets/page/terms/sidebar.php'; ?>

<?php
	if (isset($_GET['section'])) {
		$section = $_GET['section'];
	} else {
		$section = 'tos';
	}

	switch ($section) {
		case 'privacy':
			include '../assets/page/terms/privacy.php';
			break;
		case 'cookies':
			include '../assets/page/terms/cookies.php';
			break;
		case 'tos':
		default:
			include '../assets/page/terms/tos.php';
			break;
	}
?>

<?php include '../assets/page/terms/layout_end.php'; ?>

<?php include 'footer.php'; ?>
