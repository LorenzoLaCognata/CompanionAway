<?php
	$noBagCount = (int)dbOne($db, 'SELECT COUNT(*) n FROM items WHERE bag_id IS NULL AND user_id = ?', [currentUserId()])['n'];
	$topBags = bagTopLevel($db);
?>
		<div class="hi-sidebar__section">
			<div class="hi-sidebar__label">&#129523; <?= $translations['sidebar_bags_label'] ?> · <a href="/<?= $lang ?>/inventory_tool_demo.php?action=master_data&table=bags">⚙️</a></div>
			<a href="<?= sidebarLink('unassigned') ?>" class="hi-sidebar__link<?= $vtype === 'unassigned' ? ' hi-sidebar__link--active' : '' ?>">
				<span class="hi-sidebar__icon">❔</span><?= $translations['word_unassigned'] ?><span class="hi-sidebar__count"><?= $noBagCount ?></span>
			</a>
<?php foreach ($topBags as $bag):
	$bagIds = bagDescendants($db, (int)$bag['id']);
	$placeholders = implode(',', array_fill(0, count($bagIds), '?'));
	$bagCount = (int)dbOne($db, "SELECT COUNT(*) n FROM items WHERE bag_id IN ($placeholders) AND user_id = ?", [...$bagIds, currentUserId()])['n'];
	$conts = bagChildren($db, (int)$bag['id']);
?>
			<a href="<?= sidebarLink('bag', (int)$bag['id']) ?>" class="hi-sidebar__link<?= $vtype === 'bag' && $vfilter == $bag['id'] ? ' hi-sidebar__link--active' : '' ?>">
				<span class="hi-sidebar__icon"><?= htmlspecialchars($bag['icon']) ?></span><?= htmlspecialchars($bag['name']) ?><span class="hi-sidebar__count"><?= $bagCount ?></span>
			</a>
<?php if (!empty($conts)): ?>
			<div class="hi-tree">
<?php foreach ($conts as $cont): $cn = (int)dbOne($db, 'SELECT COUNT(*) n FROM items WHERE bag_id = ? AND user_id = ?', [$cont['id'], currentUserId()])['n']; ?>
				<a href="<?= sidebarLink('bag', (int)$cont['id']) ?>" class="hi-sidebar__link hi-sidebar__link--l1<?= $vtype === 'bag' && $vfilter == $cont['id'] ? ' hi-sidebar__link--active' : '' ?>">
					<span class="hi-sidebar__icon"><?= htmlspecialchars($cont['icon']) ?></span><?= htmlspecialchars($cont['name']) ?><span class="hi-sidebar__count"><?= $cn ?></span>
				</a>
<?php endforeach; ?>
			</div>
<?php endif; ?>
<?php endforeach; ?>
<?php if (empty($topBags)): ?>
			<div class="hi-sidebar__empty"><?= $translations['sidebar_no_bags'] ?></div>
<?php endif; ?>
		</div>
