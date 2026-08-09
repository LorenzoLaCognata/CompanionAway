<?php
	$locLbl = $item['location_id'] !== null ? locShort($db, (int)$item['location_id']) : null;
	$fullPath = $item['location_id'] !== null ? locPath($db, (int)$item['location_id']) : null;
	$listCtx = listContextQuery();
	$editUrl = 'inventory_tool.php?action=edit&id=' . (int)$item['id'] . ($listCtx !== '' ? '&' . $listCtx : '');
	$deleteUrl = 'inventory_tool.php?action=delete&id=' . (int)$item['id'] . ($listCtx !== '' ? '&' . $listCtx : '');
?>
				<tr>
					<td>
						<a class="hi-table__thumb" href="<?= htmlspecialchars($editUrl) ?>">
<?php if ($item['has_photo']): ?>
							<img src="../assets/page/inventory_tool/photo.php?id=<?= (int)$item['id'] ?>" alt="">
<?php elseif ($item['cat_icon']): ?>
							<?= htmlspecialchars($item['cat_icon']) ?>
<?php else: ?>
							📷
<?php endif; ?>
						</a>
					</td>
					<td><span class="hi-table__name"><?= htmlspecialchars($item['name']) ?></span></td>
					<td>
<?php if ($item['cat_name']): ?>
						<span class="hi-tag"><?= htmlspecialchars($item['cat_icon'] ?? '') ?> <?= htmlspecialchars($item['cat_name']) ?></span>
<?php else: ?>
						<span class="hi-table__dash">—</span>
<?php endif; ?>
					</td>
					<td>
<?php if ($locLbl): ?>
						<span class="hi-tag hi-tag--loc" title="<?= htmlspecialchars($fullPath ?? '') ?>">📍 <?= htmlspecialchars($locLbl) ?></span>
<?php else: ?>
						<span class="hi-table__dash">—</span>
<?php endif; ?>
					</td>
					<td>
<?php if ($item['owner_name']): ?>
						<span class="hi-tag hi-tag--owner"><?= htmlspecialchars($item['owner_icon'] ?? '👤') ?> <?= htmlspecialchars($item['owner_name']) ?></span>
<?php else: ?>
						<span class="hi-table__dash">—</span>
<?php endif; ?>
					</td>
					<td>
<?php if ($item['bag_name']): ?>
						<span class="hi-tag hi-tag--bag"><?= htmlspecialchars($item['bag_icon'] ?? '') ?> <?= htmlspecialchars($item['bag_name']) ?></span>
<?php else: ?>
						<span class="hi-table__dash">—</span>
<?php endif; ?>
					</td>
					<td>
						<div class="hi-row-actions">
							<a class="hi-row-actions__btn" href="<?= htmlspecialchars($editUrl) ?>">✏️</a>
							<a class="hi-row-actions__btn hi-row-actions__btn--danger" href="<?= htmlspecialchars($deleteUrl) ?>">🗑</a>
						</div>
					</td>
				</tr>
