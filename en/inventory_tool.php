<?php
	$lang = basename(__DIR__);
	$currentPage = basename(__FILE__);
	
	$langJson = file_get_contents('inventory_tool/lang.json');
	$translations = json_decode($langJson, true);

	// REVIEW TO OPTIMIZE
	$pageStylesheet = '/assets/css/style.css';
?>

<?php
require_once '../assets/page/inventory_tool/bootstrap.php';
require_once '../assets/page/inventory_tool/list-context.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form_action'] ?? '') === 'delete_confirmed') {
	require '../assets/page/inventory_tool/item-delete-action.php';
}

require_once '../assets/page/inventory_tool/query-params.php';

$action = $_GET['action'] ?? 'list';

if ($action === 'add' || $action === 'edit') {
	require '../assets/page/inventory_tool/item-form-helpers.php';
	$formActionMode = $action;
	require '../assets/page/inventory_tool/item-form-state.php';

	$photoActionError = null;

	if ($itemNotFound) {
		$errors = [];
	} elseif ($formAction === 'save') {
		require '../assets/page/inventory_tool/item-form-actions.php';
	} else {
		$errors = [];
		if (in_array($formAction, ['refetch_photo', 'remove_photo'], true)) {
			require '../assets/page/inventory_tool/item-form-photo-actions.php';
		}
	}

	require '../assets/page/inventory_tool/item-form-select-options.php';
}
else if ($action === 'master_data') {
	header('Location: https://companionaway.com/en/coming_soon.php');
	exit;
}
?>

<?php require 'head.php'; ?>
<?php require 'header.php'; ?>
<?php require '../assets/page/inventory_tool/toolbar.php'; ?>
<?php require '../assets/page/inventory_tool/sidebar.php'; ?>
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
	require '../assets/page/inventory_tool/item-form.php';
} elseif ($action === 'edit' && $itemNotFound) {
	echo '<div class="hi-empty"><div class="hi-empty__icon">📭</div><p>' . htmlspecialchars($translations['error_item_not_found']) . '</p></div>';
} elseif ($action === 'delete') {
	require '../assets/page/inventory_tool/item-delete-confirm.php';
} else {
	require '../assets/page/inventory_tool/view-dispatch.php';
}
?>
	</main>
</div>
	
<?php require 'footer.php'; ?>