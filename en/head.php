<!DOCTYPE html>
<html lang="<?= $lang ?>">
	<head>
		<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-2KTKK3SNWY"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-2KTKK3SNWY');
		</script>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Companion Away</title>
		<meta name="description" content="CompanionAway — personalised relocation guides and travel plans for Europeans moving to the US. Real guidance, not AI-generated templates.">

<?php
	$enSlug = ($currentPage === 'index.php') ? '/' : '/en/' . $currentPage;
	$itSlug = ($currentPage === 'index.php') ? '/it' : '/it/' . $currentPage;
	$homeSlug = '/';
	$canonicalSlug = $enSlug;
	if ($lang === 'it') {
		$homeSlug = '/it';
		$canonicalSlug = $itSlug;
	}
?>
		<link rel="alternate" hreflang="en" href="https://companionaway.com<?= $enSlug ?>" />
		<link rel="alternate" hreflang="it" href="https://companionaway.com<?= $itSlug ?>" />
		<link rel="alternate" hreflang="x-default" href="https://companionaway.com<?= $enSlug ?>" />
		<link rel="canonical" href="https://companionaway.com<?= $canonicalSlug ?>" />

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&display=swap" rel="stylesheet">

		<link rel="stylesheet" href="../assets/css/style.css">
	</head>
