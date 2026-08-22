<!DOCTYPE html>
<html lang="<?= $lang ?>">
	<head>
		<!-- Google tag (gtag.js) — only loaded once analytics cookies are accepted, see footer.php -->
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('consent', 'default', {
				analytics_storage: 'denied',
				ad_storage: 'denied',
				ad_user_data: 'denied',
				ad_personalization: 'denied'
			});
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
		<title><?= $translations['head_title'] ?></title>
		<meta name="description" content="<?= $translations['head_meta_description'] ?>">
		<meta name="keywords" content="<?= $translations['head_meta_keywords'] ?>">
		<meta property="og:title" content="<?= $translations['head_og_title'] ?>">
		<meta property="og:description" content="<?= $translations['head_og_description'] ?>">
		<meta property="og:image" content="https://www.companionaway.com/assets/img/hero.svg">
		<meta property="og:type" content="website" />
		<meta property="og:url" content="https://www.companionaway.com<?= $canonicalSlug ?>" />

		<link rel="alternate" hreflang="en" href="https://www.companionaway.com<?= $enSlug ?>" />
		<link rel="alternate" hreflang="it" href="https://www.companionaway.com<?= $itSlug ?>" />
		<link rel="alternate" hreflang="x-default" href="https://www.companionaway.com<?= $enSlug ?>" />
		<link rel="canonical" href="https://www.companionaway.com<?= $canonicalSlug ?>" />
		<link rel="icon" type="image/png" sizes="48x48" href="/favicon.ico">

		<link rel="stylesheet" href="/assets/css/main-style.min.css">
		<link rel="stylesheet" href="/assets/css/cookie-consent-style.min.css">
<?php foreach ((array) $pageStylesheet as $sheet) { ?>
		<link rel="stylesheet" href="<?= $sheet ?>">
<?php } ?>
	</head>
