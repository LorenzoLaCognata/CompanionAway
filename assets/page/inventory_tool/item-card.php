<?php
	$locLbl = $item['location_id'] !== null ? locShort($db, (int)$item['location_id']) : null;
	$fullPath = $item['location_id'] !== null ? locPath($db, (int)$item['location_id']) : null;
	$bagLbl = $item['bag_id'] !== null ? bagPath($db, (int)$item['bag_id']) : null;
	$listCtx = listContextQuery();
	$editUrl = $currentPage . '?action=edit&id=' . (int)$item['id'] . ($listCtx !== '' ? '&' . $listCtx : '');
	$deleteUrl = $currentPage . '?action=delete&id=' . (int)$item['id'] . ($listCtx !== '' ? '&' . $listCtx : '');
?>
				<div class="hi-card">
					<a class="hi-card__photo" href="<?= htmlspecialchars($editUrl) ?>">
<?php if ($item['has_photo']): ?>
						<img src="../assets/page/inventory_tool/photo.php?id=<?= (int)$item['id'] ?>" alt="<?= htmlspecialchars($item['name']) ?>">
<?php elseif ($item['cat_icon']): ?>
						<span class="hi-card__photo-icon"><?= htmlspecialchars($item['cat_icon']) ?></span>
<?php else: ?>
						<span>📷</span>
<?php endif; ?>
					</a>
					<div class="hi-card__body">
						<div class="hi-card__name" title="<?= htmlspecialchars($item['name']) ?>"><?= htmlspecialchars($item['name']) ?></div>
						<div class="hi-card__meta">
<?php if ($item['cat_name'] || $item['owner_name']): ?>
							<div class="hi-card__meta-row">
<?php if ($item['cat_name']): ?>
								<span class="hi-tag"><?= htmlspecialchars($item['cat_icon'] ?? '') ?> <?= htmlspecialchars($item['cat_name']) ?></span>
<?php endif; ?>
<?php if ($item['owner_name']): ?>
								<span class="hi-tag hi-tag--owner"><?= htmlspecialchars($item['owner_icon'] ?? '👤') ?> <?= htmlspecialchars($item['owner_name']) ?></span>
<?php endif; ?>
							</div>
<?php endif; ?>
<?php if ($locLbl): ?>
							<div class="hi-card__meta-row"><span class="hi-tag hi-tag--loc" title="<?= htmlspecialchars($fullPath ?? '') ?>">📍 <?= htmlspecialchars($locLbl) ?></span></div>
<?php endif; ?>
<?php if ($bagLbl): ?>
							<div class="hi-card__meta-row"><span class="hi-tag hi-tag--bag">🧳 <?= htmlspecialchars($bagLbl) ?></span></div>
<?php endif; ?>
						</div>
					</div>
					<div class="hi-card__actions">
						<a class="hi-card__action" href="<?= htmlspecialchars($editUrl) ?>">✏️ <?= $translations['action_edit'] ?></a>
						<a class="hi-card__action hi-card__action--danger" href="<?= htmlspecialchars($deleteUrl) ?>">🗑 <?= $translations['action_delete'] ?></a>
					</div>
				</div>
