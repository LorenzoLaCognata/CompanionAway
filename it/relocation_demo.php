<?php
	$lang = basename(__DIR__);
	$currentPage = basename(__FILE__);
	
	$langJson = file_get_contents('relocation_demo/lang.json');
	$translations = json_decode($langJson, true);

	$pageStylesheet = [
		'/assets/css/shared-demo.min.css',
		'/assets/css/document-style.min.css'
	];
?>

<?php include 'head.php'; ?>

<?php include '../assets/page/relocation_demo/header.php'; ?>

<?php include '../assets/page/relocation_demo/sidebar.php'; ?>

<?php
	if (isset($_GET['section'])) {
		$section = $_GET['section'];
	} else {
		$section = 'overview';
	}

	switch ($section) {
		case 'overview':
			include '../assets/page/relocation_demo/overview.php';
			break;
		case 'before_arriving':
			include '../assets/page/relocation_demo/before_arriving.php';
			break;
		case 'timeline':
			include '../assets/page/relocation_demo/timeline.php';
			break;
		case 'banking':
			include '../assets/page/relocation_demo/banking.php';
			break;
		case 'healthcare':
			include '../assets/page/relocation_demo/healthcare.php';
			break;
		case 'housing':
			include '../assets/page/relocation_demo/housing.php';
			break;
		case 'driving_transport':
			include '../assets/page/relocation_demo/driving_transport.php';
			break;
		case 'daily_life':
			include '../assets/page/relocation_demo/daily_life.php';
			break;
		case 'community_expat':
			include '../assets/page/relocation_demo/community_expat.php';
			break;
		case 'master_checklist':
			include '../assets/page/relocation_demo/master_checklist.php';
			break;
		default:
			break;
	}
?>

<?php include '../assets/page/relocation_demo/locked.php'; ?>

<?php include 'footer.php'; ?>
