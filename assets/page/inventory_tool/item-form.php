		<div class="hi-form">
			<div class="hi-form__title"><?= $editId !== null ? $translations['form_title_edit'] : $translations['form_title_add'] ?></div>
<?php foreach ($errors as $err): ?>
			<div class="hi-flash hi-flash--err"><?= htmlspecialchars($err) ?></div>
<?php endforeach; ?>
<?php
	$listCtx = listContextQuery();
	$formTarget = $currentPage . '?action=' . ($editId !== null ? 'edit&id=' . $editId : 'add') . ($listCtx !== '' ? '&' . $listCtx : '');
	$cancelTarget = $currentPage . ($listCtx !== '' ? '?' . $listCtx : '');
?>
			<form method="post" action="<?= htmlspecialchars($formTarget) ?>" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?= (int)$editId ?>">
				<div class="hi-form__grid">
<?php require 'item-form-field-basic.php'; ?>
<?php require 'item-form-field-location.php'; ?>
<?php require 'item-form-field-bag.php'; ?>
<?php require 'item-form-field-photo.php'; ?>
				</div>
				<div class="hi-form__actions">
					<a class="btn btn--outline" href="<?= htmlspecialchars($cancelTarget) ?>"><?= $translations['action_cancel'] ?></a>
					<button type="submit" name="form_action" value="save" class="btn btn--amber"><?= $translations['action_save_item'] ?></button>
				</div>
			</form>
		</div>
