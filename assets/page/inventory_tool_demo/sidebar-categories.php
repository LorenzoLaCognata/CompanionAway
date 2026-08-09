<?php
	$uncategorizedCount = (int)dbOne($db, 'SELECT COUNT(*) n FROM items WHERE category_id IS NULL AND user_id = ?', [currentUserId()])['n'];
	$categories = catAll($db);
?>
		<div class="hi-sidebar__section">
			<div class="hi-sidebar__label">&#128193; <?= $translations['sidebar_categories_label'] ?> · <a href="/<?= $lang ?>/inventory_tool_demo.php?action=master_data&table=categories">⚙️</a></div>
			<a href="<?= sidebarLink('category_none') ?>" class="hi-sidebar__link<?= $vtype === 'category_none' ? ' hi-sidebar__link--active' : '' ?>">
				<span class="hi-sidebar__icon">❔</span><?= $translations['word_unassigned'] ?><span class="hi-sidebar__count"><?= $uncategorizedCount ?></span>
			</a>
<?php foreach ($categories as $c): $cnt = (int)dbOne($db, 'SELECT COUNT(*) n FROM items WHERE category_id = ? AND user_id = ?', [$c['id'], currentUserId()])['n']; ?>
			<a href="<?= sidebarLink('category', (int)$c['id']) ?>" class="hi-sidebar__link<?= $vtype === 'category' && $vfilter == $c['id'] ? ' hi-sidebar__link--active' : '' ?>">
				<span class="hi-sidebar__icon"><?= htmlspecialchars($c['icon']) ?></span><?= htmlspecialchars($c['name']) ?><span class="hi-sidebar__count"><?= $cnt ?></span>
			</a>
<?php endforeach; ?>
<?php if (empty($categories)): ?>
			<div class="hi-sidebar__empty"><?= $translations['sidebar_no_categories'] ?></div>
<?php endif; ?>
		</div>
