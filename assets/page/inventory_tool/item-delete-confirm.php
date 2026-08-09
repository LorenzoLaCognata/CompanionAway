<?php
	$deleteId = !empty($_GET['id']) ? (int)$_GET['id'] : null;
	$deleteItem = $deleteId !== null ? itemById($db, $deleteId) : null;

	if ($deleteItem === null) {
		echo '<div class="hi-empty"><div class="hi-empty__icon">📭</div><p>' . htmlspecialchars($translations['error_item_not_found']) . '</p></div>';
		return;
	}
	$listCtx = listContextQuery();
	$returnTarget = $currentPage . ($listCtx !== '' ? '?' . $listCtx : '');
?>
		<div class="hi-form">
			<div class="hi-form__title"><?= $translations['delete_confirm_title'] ?></div>
			<p><?= sprintf($translations['delete_confirm_body'], htmlspecialchars($deleteItem['name'])) ?></p>
			<form method="post" action="<?= htmlspecialchars($returnTarget) ?>">
				<input type="hidden" name="id" value="<?= (int)$deleteItem['id'] ?>">
				<input type="hidden" name="form_action" value="delete_confirmed">
				<div class="hi-form__actions">
					<a class="btn btn--outline" href="<?= htmlspecialchars($returnTarget) ?>"><?= $translations['action_cancel'] ?></a>
					<button type="submit" class="btn btn--danger"><?= $translations['action_delete_permanently'] ?></button>
				</div>
			</form>
		</div>
