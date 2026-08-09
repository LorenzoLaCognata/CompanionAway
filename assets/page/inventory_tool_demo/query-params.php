<?php
	$vtype = $_GET['type'] ?? 'all';
	$vfilter = isset($_GET['filter']) ? (int)$_GET['filter'] : null;
	$search = trim($_GET['q'] ?? '');
	$sort = $_GET['sort'] ?? 'name';
	$view = $_GET['view'] ?? 'cards';

	$extra = [
		'cat' => !empty($_GET['fcat']) ? (int)$_GET['fcat'] : null,
		'owner' => !empty($_GET['fowner']) ? (int)$_GET['fowner'] : null,
		'loc' => !empty($_GET['floc']) ? (int)$_GET['floc'] : null,
		'bag' => !empty($_GET['fbag']) ? (int)$_GET['fbag'] : null,
	];

	$countTotal = count(getItems($db, $vtype, $vfilter, $search, $extra, $sort));
