<div class="hi-layout">
	<aside class="hi-sidebar">
<?php $total = itemCount($db); ?>
		<div class="hi-sidebar__section">
			<a href="<?= sidebarLink('all') ?>" class="hi-sidebar__link<?= $vtype === 'all' ? ' hi-sidebar__link--active' : '' ?>">
				<span class="hi-sidebar__icon">🏠</span><?= $translations['sidebar_all_items'] ?><span class="hi-sidebar__count"><?= $total ?></span>
			</a>
		</div>
<?php require $dir . '/sidebar-categories.php'; ?>
<?php require $dir . '/sidebar-owners.php'; ?>
<?php require $dir . '/sidebar-locations.php'; ?>
<?php require $dir . '/sidebar-bags.php'; ?>
	</aside>
