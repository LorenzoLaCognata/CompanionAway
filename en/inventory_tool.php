<?php
	$lang = basename(__DIR__);
	$currentPage = basename(__FILE__);
	
	$langJson = file_get_contents('inventory_tool/lang.json');
	$translations = json_decode($langJson, true);

	$pageStylesheet = '/assets/css/inventory-style.min.css';
?>

<?php
require_once __DIR__ . '/../assets/page/inventory_tool/bootstrap.php';
require_once __DIR__ . '/../assets/page/inventory_tool/list-context.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form_action'] ?? '') === 'delete_confirmed') {
	require __DIR__ . '/../assets/page/inventory_tool/item-delete-action.php';
}

require_once __DIR__ . '/../assets/page/inventory_tool/query-params.php';

$action = $_GET['action'] ?? 'list';

if ($action === 'add' || $action === 'edit') {
	require __DIR__ . '/../assets/page/inventory_tool/item-form-helpers.php';
	$formActionMode = $action;
	require __DIR__ . '/../assets/page/inventory_tool/item-form-state.php';

	$photoActionError = null;

	if ($itemNotFound) {
		$errors = [];
	} elseif ($formAction === 'save') {
		require __DIR__ . '/../assets/page/inventory_tool/item-form-actions.php';
	} else {
		$errors = [];
		if (in_array($formAction, ['refetch_photo', 'remove_photo'], true)) {
			require __DIR__ . '/../assets/page/inventory_tool/item-form-photo-actions.php';
		}
	}

	require __DIR__ . '/../assets/page/inventory_tool/item-form-select-options.php';
}
else if ($action === 'master_data') {
	require __DIR__ . '/../assets/page/inventory_tool/master-data-state.php';
}
?>

<?php require __DIR__ . '/head.php'; ?>
<?php require __DIR__ . '/header.php'; ?>
<?php require __DIR__ . '/../assets/page/inventory_tool/toolbar.php'; ?>
<?php require __DIR__ . '/../assets/page/inventory_tool/sidebar.php'; ?>
<?php if (isset($_GET['deleted'])): ?>
		<div class="hi-flash hi-flash--ok"><?= $translations['flash_item_deleted'] ?></div>
<?php endif; ?>
<?php if (isset($_GET['saved'])): ?>
		<div class="hi-flash hi-flash--ok"><?= $translations['flash_item_saved'] ?></div>
<?php endif; ?>
<?php if (isset($_GET['photo_error'])): ?>
		<div class="hi-flash hi-flash--err"><?= sprintf($translations['flash_photo_error_prefix'], htmlspecialchars($_GET['photo_error'])) ?></div>
<?php endif; ?>
<?php
if (($action === 'add' || $action === 'edit') && !$itemNotFound) {
	require __DIR__ . '/../assets/page/inventory_tool/item-form.php';
} elseif ($action === 'edit' && $itemNotFound) {
	echo '<div class="hi-empty"><div class="hi-empty__icon">📭</div><p>' . htmlspecialchars($translations['error_item_not_found']) . '</p></div>';
} elseif ($action === 'delete') {
	require __DIR__ . '/../assets/page/inventory_tool/item-delete-confirm.php';
} elseif ($action === 'master_data') {
	require __DIR__ . '/../assets/page/inventory_tool/master-data.php';
} else {
	require __DIR__ . '/../assets/page/inventory_tool/view-dispatch.php';
}
?>
	</main>
</div>
	
<?php require __DIR__ . '/footer.php'; ?>
