<?php
	$manageDeleteItem = $manageEditId !== null ? manageEntityById($db, $table, $manageEditId) : null;

	if ($manageDeleteItem === null) {
		echo '<div class="hi-empty"><div class="hi-empty__icon">📭</div><p>' . htmlspecialchars($translations['error_item_not_found']) . '</p></div>';
		return;
	}
	$manageBodyKey = $manageDepth > 1 ? 'manage_delete_confirm_body' : 'manage_delete_confirm_body_flat';
?>
		<div class="hi-form">
			<div class="hi-form__title"><?= $translations['manage_delete_confirm_title'] ?></div>
			<p><?= sprintf($translations[$manageBodyKey], htmlspecialchars($manageDeleteItem['name'])) ?></p>
			<form method="post" action="<?= htmlspecialchars(manageUrl($currentPage, $table)) ?>">
				<input type="hidden" name="table" value="<?= htmlspecialchars($table) ?>">
				<input type="hidden" name="id" value="<?= (int)$manageDeleteItem['id'] ?>">
				<input type="hidden" name="form_action" value="manage_delete_confirmed">
				<div class="hi-form__actions">
					<a class="btn btn--outline" href="<?= htmlspecialchars(manageUrl($currentPage, $table)) ?>"><?= $translations['action_cancel'] ?></a>
					<button type="submit" class="btn btn--danger"><?= $translations['action_delete_permanently'] ?></button>
				</div>
			</form>
		</div>
