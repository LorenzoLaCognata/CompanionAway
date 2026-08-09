<?php
	$unownedCount = (int)dbOne($db, 'SELECT COUNT(*) n FROM items WHERE owner_id IS NULL AND user_id = ?', [currentUserId()])['n'];
	$owners = ownerAll($db);
?>
		<div class="hi-sidebar__section">
			<div class="hi-sidebar__label">&#128100; <?= $translations['sidebar_owners_label'] ?> · <a href="/<?= $lang ?>/inventory_tool.php?action=master_data&table=owners">⚙️</a></div>
			<a href="<?= sidebarLink('owner_none') ?>" class="hi-sidebar__link<?= $vtype === 'owner_none' ? ' hi-sidebar__link--active' : '' ?>">
				<span class="hi-sidebar__icon">❔</span><?= $translations['word_unassigned'] ?><span class="hi-sidebar__count"><?= $unownedCount ?></span>
			</a>
<?php foreach ($owners as $o): $cnt = (int)dbOne($db, 'SELECT COUNT(*) n FROM items WHERE owner_id = ? AND user_id = ?', [$o['id'], currentUserId()])['n']; ?>
			<a href="<?= sidebarLink('owner', (int)$o['id']) ?>" class="hi-sidebar__link<?= $vtype === 'owner' && $vfilter == $o['id'] ? ' hi-sidebar__link--active' : '' ?>">
				<span class="hi-sidebar__icon"><?= htmlspecialchars($o['icon']) ?></span><?= htmlspecialchars($o['name']) ?><span class="hi-sidebar__count"><?= $cnt ?></span>
			</a>
<?php endforeach; ?>
		</div>
