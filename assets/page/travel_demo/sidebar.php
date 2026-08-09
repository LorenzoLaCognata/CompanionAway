<?php
	$section = isset($_GET['section']) ? $_GET['section'] : 'day_1';
?>
			<div class="layout">

				<nav class="sidebar">
					<div class="sidebar-logo"><?= $translations['sidebar_logo'] ?></div>
					<div class="sidebar-sub"><?= $translations['sidebar_sub'] ?></div>
					<div class="sidebar-label"><?= $translations['sidebar_label_guide'] ?></div>
					<a class="sidebar-link <?php echo ($section === 'day_1') ? 'active' : ''; ?>" href="/<?= $lang ?>/travel_demo.php?section=day_1"><span class="num">1</span><?= $translations['sidebar_nav_day_1'] ?></a>
					<a class="sidebar-link <?php echo ($section === 'day_2') ? 'active' : ''; ?>" href="/<?= $lang ?>/travel_demo.php?section=day_2"><span class="num">2</span><?= $translations['sidebar_nav_day_2'] ?></a>
					<a class="sidebar-link <?php echo ($section === 'day_3') ? 'active' : ''; ?>" href="/<?= $lang ?>/travel_demo.php?section=day_3"><span class="num">3</span><?= $translations['sidebar_nav_day_3'] ?></a>
				</nav>

				<div>
