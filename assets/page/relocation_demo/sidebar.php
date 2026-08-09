<?php
	$section = isset($_GET['section']) ? $_GET['section'] : 'overview';
?>
			<div class="layout">

				<nav class="sidebar">
					<div class="sidebar-logo"><?= $translations['sidebar_logo'] ?></div>
					<div class="sidebar-sub"><?= $translations['sidebar_sub'] ?></div>
					<div class="sidebar-label"><?= $translations['sidebar_label_guide'] ?></div>
					<a class="sidebar-link <?php echo ($section === 'overview') ? 'active' : ''; ?>" href="/<?= $lang ?>/relocation_demo.php?section=overview"><span class="num">1</span><?= $translations['sidebar_nav_overview'] ?></a>
					<a class="sidebar-link <?php echo ($section === 'before_arriving') ? 'active' : ''; ?>" href="/<?= $lang ?>/relocation_demo.php?section=before_arriving"><span class="num">2</span><?= $translations['sidebar_nav_before_arriving'] ?></a>
					<a class="sidebar-link <?php echo ($section === 'timeline') ? 'active' : ''; ?>" href="/<?= $lang ?>/relocation_demo.php?section=timeline"><span class="num">3</span><?= $translations['sidebar_nav_timeline'] ?></a>
					<hr class="sidebar-divider">
					<div class="sidebar-label"><?= $translations['sidebar_label_tools'] ?></div>
					<a class="sidebar-link <?php echo ($section === 'master_checklist') ? 'active' : ''; ?>" href="/<?= $lang ?>/relocation_demo.php?section=master_checklist"><span class="num">&#128203;</span><?= $translations['sidebar_nav_checklist'] ?></a>
					<a class="sidebar-link" href="/<?= $lang ?>/inventory_tool_demo.php"><span class="num">&#129523;</span><?= $translations['sidebar_nav_inventory'] ?></a>
					<hr class="sidebar-divider">
					<div class="sidebar-label"><?= $translations['sidebar_label_deep'] ?></div>
					<a class="sidebar-link <?php echo ($section === 'banking') ? 'active' : ''; ?>" href="/<?= $lang ?>/relocation_demo.php?section=banking"><span class="num">4</span><?= $translations['sidebar_nav_banking'] ?></a>
					<a class="sidebar-link <?php echo ($section === 'healthcare') ? 'active' : ''; ?>" href="/<?= $lang ?>/relocation_demo.php?section=healthcare"><span class="num">5</span><?= $translations['sidebar_nav_healthcare'] ?></a>
					<a class="sidebar-link <?php echo ($section === 'housing') ? 'active' : ''; ?>" href="/<?= $lang ?>/relocation_demo.php?section=housing"><span class="num">6</span><?= $translations['sidebar_nav_housing'] ?></a>
					<a class="sidebar-link <?php echo ($section === 'driving_transport') ? 'active' : ''; ?>" href="/<?= $lang ?>/relocation_demo.php?section=driving_transport"><span class="num">7</span><?= $translations['sidebar_nav_driving'] ?></a>
					<a class="sidebar-link <?php echo ($section === 'daily_life') ? 'active' : ''; ?>" href="/<?= $lang ?>/relocation_demo.php?section=daily_life"><span class="num">8</span><?= $translations['sidebar_nav_daily_life'] ?></a>
					<a class="sidebar-link <?php echo ($section === 'community_expat') ? 'active' : ''; ?>" href="/<?= $lang ?>/relocation_demo.php?section=community_expat"><span class="num">9</span><?= $translations['sidebar_nav_community'] ?></a>
					<div class="prog-label"><?= $translations['sidebar_progress_label'] ?></div>
					<div class="progress-track"><div class="progress-fill" id="prog"></div></div>
				</nav>

				<div>
