<div class="hi-layout">
	<aside class="hi-sidebar">
<?php $total = itemCount($db); ?>
		<div class="hi-sidebar__section">
			<a href="<?= sidebarLink('all') ?>" class="hi-sidebar__link<?= $vtype === 'all' ? ' hi-sidebar__link--active' : '' ?>">
				<span class="hi-sidebar__icon">🏠</span><?= $translations['sidebar_all_items'] ?><span class="hi-sidebar__count"><?= $total ?></span>
			</a>
		</div>
<?php require 'sidebar-categories.php'; ?>
<?php require 'sidebar-owners.php'; ?>
<?php require 'sidebar-locations.php'; ?>
<?php require 'sidebar-bags.php'; ?>
	</aside>
