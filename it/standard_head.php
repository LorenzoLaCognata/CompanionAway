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
		<title>Companion Away — Qualcosa di entusiasmante sta per arrivare</title>
		<meta name="description" content="Sta arrivando qualcosa di nuovo da Companion Away — guide di trasferimento personalizzate e itinerari di viaggio, costruiti attorno alla tua storia. In arrivo a breve.">
		<meta name="keywords" content="guida al trasferimento personalizzata, guida per espatriati, itinerario di viaggio su misura, guida per trasferirsi in un nuovo paese, pianificazione di viaggi personalizzata">
		<meta property="og:title" content="Companion Away — Il tuo compagno per ogni viaggio">
		<meta property="og:description" content="Guide al trasferimento e itinerari di viaggio personalizzati — costruiti attorno alla tua storia, non copiati da un modello. Un supporto autentico da una persona reale.">
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
