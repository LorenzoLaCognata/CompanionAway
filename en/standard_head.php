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

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Companion Away — Something exciting is coming</title>
		<meta name="description" content="Companion Away is almost here. Personalised relocation guides and travel itineraries, built around your story. Be the first to know when we launch.">
		<meta name="keywords" content="relocation guide personalised, expat guide moving abroad, custom travel itinerary, moving to a new country guide, personalised travel planning">
		<meta property="og:title" content="Companion Away — Your companion for every journey">
		<meta property="og:description" content="Personalised relocation guides and travel itineraries — built around your story, not copied from a template. Real guidance from a real person.">
		<meta property="og:image" content="https://www.companionaway.com/assets/img/hero.svg">
		<meta property="og:type" content="website" />
		<meta property="og:url" content="https://companionaway.com<?= $canonicalSlug ?>" />

		<link rel="alternate" hreflang="en" href="https://www.companionaway.com<?= $enSlug ?>" />
		<link rel="alternate" hreflang="it" href="https://www.companionaway.com<?= $itSlug ?>" />
		<link rel="alternate" hreflang="x-default" href="https://www.companionaway.com<?= $enSlug ?>" />
		<link rel="canonical" href="https://www.companionaway.com<?= $canonicalSlug ?>" />
		<link rel="icon" type="image/png" sizes="48x48" href="/favicon.ico">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&display=swap" rel="stylesheet">

		<link rel="stylesheet" href="/assets/css/main-style.min.css">
		<link rel="stylesheet" href="/assets/css/home-style.min.css">
		<link rel="stylesheet" href="/assets/css/cookie-consent-style.min.css">
	</head>
