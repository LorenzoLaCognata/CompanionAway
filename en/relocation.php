<?php
	$lang = basename(__DIR__);
	$currentPage = basename(__FILE__);
	
	$langJson = file_get_contents('relocation/lang.json');
	$translations = json_decode($langJson, true);

	$pageStylesheet = '/assets/css/travel-relocation-style.css';
?>

<?php include 'head.php'; ?>

<?php include 'header.php'; ?>

<?php include '../assets/page/relocation/hero.php'; ?>

<?php include '../assets/page/relocation/what_you_get.php'; ?>

<?php include '../assets/page/relocation/inventory.php'; ?>

<?php include '../assets/page/relocation/pricing.php'; ?>

<?php include '../assets/page/relocation/how_it_works.php'; ?>

<?php include '../assets/page/relocation/faq.php'; ?>

<?php include '../assets/page/relocation/questionnaire.php'; ?>

<?php include 'footer.php'; ?>