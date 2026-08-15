<?php
	if (($_COOKIE['ca_lang'] ?? '') === 'it') {
		header('Location: /it');
		exit;
	}

	$lang = 'en';
	$currentPage = basename(__FILE__);

	$langJson = file_get_contents('en/home/lang.json');
	$translations = json_decode($langJson, true);

	$pageStylesheet = '/assets/css/home-style.min.css';
?>

<?php include 'en/head.php'; ?>

<?php include 'en/header.php'; ?>

<?php include 'assets/page/home/hero.php'; ?>

<?php include 'assets/page/home/manifesto.php'; ?>

<?php include 'assets/page/home/about.php'; ?>

<?php include 'assets/page/home/how_it_works.php'; ?>

<?php include 'assets/page/home/services.php'; ?>

<?php include 'en/footer.php'; ?>