<?php
	$manageTopLevel = manageEntityTopLevel($db, $table);
?>
<?php if (empty($manageTopLevel)): ?>
		<div class="hi-empty">
			<div class="hi-empty__icon">🗂️</div>
			<p><?= $translations[manageTables()[$table]['empty']] ?></p>
		</div>
<?php else: ?>
		<table class="hi-table">
			<thead>
				<tr><th></th><th><?= $translations['word_name'] ?></th><?php if ($manageDepth > 1): ?><th></th><?php endif; ?><th></th></tr>
			</thead>
			<tbody>
<?php foreach ($manageTopLevel as $entity): manageRenderEntityRow($db, $table, $currentPage, $translations, $entity, 0, $manageDepth); endforeach; ?>
			</tbody>
		</table>
<?php endif; ?>
