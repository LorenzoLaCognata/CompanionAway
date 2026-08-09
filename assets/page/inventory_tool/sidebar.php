<div class="hi-layout">
	<aside class="hi-sidebar">
<?php $total = itemCount($db); ?>
		<div class="hi-sidebar__section">
			<a href="<?= sidebarLink('all') ?>" class="hi-sidebar__link<?= $vtype === 'all' ? ' hi-sidebar__link--active' : '' ?>">
				<span class="hi-sidebar__icon">🏠</span><?= $translations['sidebar_all_items'] ?><span class="hi-sidebar__count"><?= $total ?></span>
			</a>
		</div>
<?php require __DIR__ . '/sidebar-categories.php'; ?>
<?php require __DIR__ . '/sidebar-owners.php'; ?>
<?php require __DIR__ . '/sidebar-locations.php'; ?>
<?php require __DIR__ . '/sidebar-bags.php'; ?>
	</aside>
