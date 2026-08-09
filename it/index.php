<?php
	$lang = basename(__DIR__);
	$currentPage = basename(__FILE__);
	
	$langJson = file_get_contents('home/lang.json');
	$translations = json_decode($langJson, true);

	$pageStylesheet = '/assets/css/home-style.min.css';
?>

<?php include 'head.php'; ?>

<?php include 'header.php'; ?>

<?php include '../assets/page/home/hero.php'; ?>

<?php include '../assets/page/home/manifesto.php'; ?>

<?php include '../assets/page/home/about.php'; ?>

<?php include '../assets/page/home/how_it_works.php'; ?>

<?php include '../assets/page/home/services.php'; ?>

<?php include 'footer.php'; ?>