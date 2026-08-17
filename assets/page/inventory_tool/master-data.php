		<div class="hi-content">
			<div class="hi-form__title"><?= $translations[manageTables()[$table]['title']] ?></div>
<?php require __DIR__ . '/manage-nav.php'; ?>
<?php
if (($manage === 'add' || $manage === 'edit') && !$manageNotFound) {
	require __DIR__ . '/master-data-form.php';
} elseif ($manage === 'edit' && $manageNotFound) {
	echo '<div class="hi-empty"><div class="hi-empty__icon">📭</div><p>' . htmlspecialchars($translations['error_item_not_found']) . '</p></div>';
} elseif ($manage === 'delete') {
	require __DIR__ . '/master-data-delete-confirm.php';
} else {
	require __DIR__ . '/master-data-list.php';
}
?>
		</div>
