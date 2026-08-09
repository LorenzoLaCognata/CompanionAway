		<div class="hi-content">
<?php
	$items = getItems($db, $vtype, $vfilter, $search, $extra, $sort);
	if (!count($items)):
?>
			<div class="hi-empty">
				<div class="hi-empty__icon">📭</div>
				<p><?= $translations['empty_no_items'] ?></p>
			</div>
<?php elseif ($view === 'list'): ?>
<?php include 'view-list.php'; ?>
<?php else: ?>
<?php include 'view-cards.php'; ?>
<?php endif; ?>
		</div>
