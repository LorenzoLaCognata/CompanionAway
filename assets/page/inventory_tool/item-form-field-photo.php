<?php
	$hasPhoto = $editId !== null && itemHasPhoto($db, $editId);

	if ($pendingPhotoB64 !== '') {
		$previewSrc = 'data:image/jpeg;base64,' . $pendingPhotoB64;
	} elseif (!$pendingPhotoRemove && $hasPhoto) {
		$previewSrc = '../assets/page/inventory_tool/photo.php?id=' . (int)$editId;
	} else {
		$previewSrc = null;
	}

	$somethingToRemove = ($hasPhoto || $pendingPhotoB64 !== '') && !$pendingPhotoRemove;
?>
				<div class="hi-field hi-field--full">
					<label><?= $translations['word_photo'] ?></label>
<?php if ($photoActionError): ?>
					<div class="hi-flash hi-flash--err"><?= htmlspecialchars($photoActionError) ?></div>
<?php endif; ?>
<?php if ($pendingPhotoB64 !== ''): ?>
					<div class="hi-flash hi-flash--ok"><?= $translations['photo_pending_fetch_note'] ?></div>
<?php elseif ($pendingPhotoRemove): ?>
					<div class="hi-flash hi-flash--ok"><?= $translations['photo_pending_remove_note'] ?></div>
<?php endif; ?>
<?php if ($previewSrc !== null): ?>
					<div class="hi-field__preview">
						<img src="<?= htmlspecialchars($previewSrc) ?>" alt="">
					</div>
<?php endif; ?>
					<input type="hidden" name="pending_photo_b64" value="<?= htmlspecialchars($pendingPhotoB64) ?>">
					<input type="hidden" name="pending_photo_remove" value="<?= $pendingPhotoRemove ? '1' : '' ?>">
					<input class="hi-input" type="file" name="photo_upload" accept="image/*">
<?php if ($editId !== null): ?>
					<div class="hi-field__actions">
						<button type="submit" name="form_action" value="refetch_photo" class="btn btn--outline btn--sm"><?= $translations['photo_try_web'] ?></button>
<?php if ($somethingToRemove): ?>
						<button type="submit" name="form_action" value="remove_photo" class="btn btn--outline btn--sm"><?= $translations['photo_remove'] ?></button>
<?php endif; ?>
					</div>
					<div class="hi-field__note"><?= $translations['photo_note_edit'] ?></div>
<?php else: ?>
					<div class="hi-field__note"><?= $translations['photo_note_add'] ?></div>
<?php endif; ?>
				</div>
