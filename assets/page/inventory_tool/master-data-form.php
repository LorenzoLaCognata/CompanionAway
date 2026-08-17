<?php
	$manageParentPath = null;
	if ($manageDepth > 1 && $manageParentId !== null) {
		$manageParentPath = $table === 'bags' ? bagPath($db, $manageParentId) : locPath($db, $manageParentId);
	}
?>
		<div class="hi-form">
<?php foreach ($manageErrors as $err): ?>
			<div class="hi-flash hi-flash--err"><?= htmlspecialchars($err) ?></div>
<?php endforeach; ?>
<?php if ($manageParentPath !== null): ?>
			<p><?= htmlspecialchars($manageParentPath) ?></p>
<?php endif; ?>
			<form method="post" action="<?= htmlspecialchars(manageUrl($currentPage, $table)) ?>">
				<input type="hidden" name="table" value="<?= htmlspecialchars($table) ?>">
				<input type="hidden" name="id" value="<?= (int)$manageEditId ?>">
				<input type="hidden" name="parent_id" value="<?= $manageParentId !== null ? (int)$manageParentId : '' ?>">
				<div class="hi-form__grid">
					<div class="hi-field hi-field--full">
						<label><?= $translations['word_name'] ?></label>
						<input class="hi-input" type="text" name="name" value="<?= htmlspecialchars($manageName) ?>" required autofocus>
					</div>
					<div class="hi-field">
						<label><?= $translations['manage_icon_placeholder'] ?></label>
						<input class="hi-input" type="text" name="icon" value="<?= htmlspecialchars($manageIcon) ?>" placeholder="<?= htmlspecialchars(manageTables()[$table]['icon']) ?>">
					</div>
				</div>
				<div class="hi-form__actions">
					<a class="btn btn--outline" href="<?= htmlspecialchars(manageUrl($currentPage, $table)) ?>"><?= $translations['action_cancel'] ?></a>
					<button type="submit" name="form_action" value="manage_save" class="btn btn--amber"><?= $translations['manage_save'] ?></button>
				</div>
			</form>
		</div>
