<?php
	$manageParentPath = null;
	if ($manageDepth > 1 && $manageParentId !== null) {
		$manageParentPath = $table === 'bags' ? bagPath($db, $manageParentId) : locPath($db, $manageParentId);
	}
	$manageIcons = manageIconChoices($table);
	// Preselect the table's default icon on a fresh add form (no icon chosen yet).
	$manageIconSelected = $manageIcon !== '' ? $manageIcon : manageTables()[$table]['icon'];
	$manageIconIsCustom = !in_array($manageIconSelected, $manageIcons, true);
	// Radios are just a quick-pick; the custom text box (if filled) always wins server-side,
	// so it's fine for a preset to stay checked even while a custom icon is prefilled.
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
					<div class="hi-field hi-field--full">
						<label><?= $translations['manage_icon_placeholder'] ?></label>
						<div class="hi-icon-picker">
<?php foreach ($manageIcons as $iconChoice): ?>
							<label class="hi-icon-picker__option">
								<input type="radio" name="icon_choice" value="<?= htmlspecialchars($iconChoice) ?>"<?= (!$manageIconIsCustom && $manageIconSelected === $iconChoice) ? ' checked' : '' ?>>
								<span><?= htmlspecialchars($iconChoice) ?></span>
							</label>
<?php endforeach; ?>
							<div class="hi-icon-picker__option hi-icon-picker__option--custom<?= $manageIconIsCustom ? ' is-active' : '' ?>">
								<input class="hi-input" type="text" name="icon_custom" value="<?= htmlspecialchars($manageIconIsCustom ? $manageIconSelected : '') ?>" placeholder="✏️" maxlength="4">
							</div>
						</div>
					</div>
				</div>
				<div class="hi-form__actions">
					<a class="btn btn--outline" href="<?= htmlspecialchars(manageUrl($currentPage, $table)) ?>"><?= $translations['action_cancel'] ?></a>
					<button type="submit" name="form_action" value="manage_save" class="btn btn--amber"><?= $translations['manage_save'] ?></button>
				</div>
			</form>
		</div>
