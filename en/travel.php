<?php
	$lang = basename(__DIR__);
	$currentPage = basename(__FILE__);
	
	$langJson = file_get_contents('travel/lang.json');
	$translations = json_decode($langJson, true);

	// REVIEW TO OPTIMIZE
	$pageStylesheet = '/assets/css/style.css';
?>

<?php include 'head.php'; ?>

<?php include 'header.php'; ?>

<?php include '../assets/page/travel/hero.php'; ?>

<?php include '../assets/page/travel/what_you_get.php'; ?>

<?php include '../assets/page/travel/how_it_works.php'; ?>

<?php include '../assets/page/travel/pricing.php'; ?>

<?php include '../assets/page/travel/faq.php'; ?>

<?php include '../assets/page/travel/questionnaire.php'; ?>

<?php include 'footer.php'; ?>