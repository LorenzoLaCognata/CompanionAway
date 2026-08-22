<?php
	$noLocationCount = (int)dbOne($db, 'SELECT COUNT(*) n FROM items WHERE location_id IS NULL AND user_id = ?', [currentUserId()])['n'];
	$places = locPlaces($db);
?>
		<div class="hi-sidebar__section">
			<div class="hi-sidebar__label">&#127760; <?= $translations['sidebar_locations_label'] ?> · <a href="/<?= $lang ?>/<?= $currentPage ?>?action=master_data&table=locations">⚙️</a></div>
			<a href="<?= sidebarLink('location_none') ?>" class="hi-sidebar__link<?= $vtype === 'location_none' ? ' hi-sidebar__link--active' : '' ?>">
				<span class="hi-sidebar__icon">❔</span><?= $translations['word_unassigned'] ?><span class="hi-sidebar__count"><?= $noLocationCount ?></span>
			</a>
<?php foreach ($places as $place):
	$placeIds = locDescendants($db, (int)$place['id']);
	$placeholders = implode(',', array_fill(0, count($placeIds), '?'));
	$placeCount = (int)dbOne($db, "SELECT COUNT(*) n FROM items WHERE location_id IN ($placeholders) AND user_id = ?", [...$placeIds, currentUserId()])['n'];
	$rooms = locChildren($db, (int)$place['id']);
?>
			<a href="<?= sidebarLink('location', (int)$place['id']) ?>" class="hi-sidebar__link<?= $vtype === 'location' && $vfilter == $place['id'] ? ' hi-sidebar__link--active' : '' ?>">
				<span class="hi-sidebar__icon"><?= htmlspecialchars($place['icon']) ?></span><?= htmlspecialchars($place['name']) ?><span class="hi-sidebar__count"><?= $placeCount ?></span>
			</a>
<?php if (!empty($rooms)): ?>
			<div class="hi-tree">
<?php foreach ($rooms as $room):
		$roomIds = locDescendants($db, (int)$room['id']);
		$placeholders = implode(',', array_fill(0, count($roomIds), '?'));
		$roomCount = (int)dbOne($db, "SELECT COUNT(*) n FROM items WHERE location_id IN ($placeholders) AND user_id = ?", [...$roomIds, currentUserId()])['n'];
		$conts = locChildren($db, (int)$room['id']);
?>
				<a href="<?= sidebarLink('location', (int)$room['id']) ?>" class="hi-sidebar__link hi-sidebar__link--l1<?= $vtype === 'location' && $vfilter == $room['id'] ? ' hi-sidebar__link--active' : '' ?>">
					<span class="hi-branch">↳</span><span class="hi-sidebar__icon"><?= htmlspecialchars($room['icon']) ?></span><?= htmlspecialchars($room['name']) ?><span class="hi-sidebar__count"><?= $roomCount ?></span>
				</a>
<?php if (!empty($conts)): ?>
				<div class="hi-tree hi-tree--l2">
<?php foreach ($conts as $cont): $contCount = (int)dbOne($db, 'SELECT COUNT(*) n FROM items WHERE location_id = ? AND user_id = ?', [$cont['id'], currentUserId()])['n']; ?>
					<a href="<?= sidebarLink('location', (int)$cont['id']) ?>" class="hi-sidebar__link hi-sidebar__link--l2<?= $vtype === 'location' && $vfilter == $cont['id'] ? ' hi-sidebar__link--active' : '' ?>">
						<span class="hi-branch">↳</span><span class="hi-sidebar__icon"><?= htmlspecialchars($cont['icon']) ?></span><?= htmlspecialchars($cont['name']) ?><span class="hi-sidebar__count"><?= $contCount ?></span>
					</a>
<?php endforeach; ?>
				</div>
<?php endif; ?>
<?php endforeach; ?>
			</div>
<?php endif; ?>
<?php endforeach; ?>
<?php if (empty($places)): ?>
			<div class="hi-sidebar__empty"><?= $translations['sidebar_no_locations'] ?></div>
<?php endif; ?>
		</div>
