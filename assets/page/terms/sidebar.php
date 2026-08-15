<?php
	$section = isset($_GET['section']) ? $_GET['section'] : 'tos';
?>
			<div class="layout">

				<nav class="sidebar">
					<div class="sidebar-logo"><?= $translations['sidebar_logo'] ?></div>
					<div class="sidebar-sub"><?= $translations['sidebar_sub'] ?></div>
					<div class="sidebar-label"><?= $translations['sidebar_label'] ?></div>
					<a class="sidebar-link <?php echo ($section === 'tos') ? 'active' : ''; ?>" href="/<?= $lang ?>/terms.php?section=tos"><span class="num">1</span><?= $translations['sidebar_nav_tos'] ?></a>
					<a class="sidebar-link <?php echo ($section === 'privacy') ? 'active' : ''; ?>" href="/<?= $lang ?>/terms.php?section=privacy"><span class="num">2</span><?= $translations['sidebar_nav_privacy'] ?></a>
					<a class="sidebar-link <?php echo ($section === 'cookies') ? 'active' : ''; ?>" href="/<?= $lang ?>/terms.php?section=cookies"><span class="num">3</span><?= $translations['sidebar_nav_cookies'] ?></a>
				</nav>

				<div>
