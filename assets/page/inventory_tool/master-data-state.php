<?php
require __DIR__ . '/manage-helpers.php';

$table = $_GET['table'] ?? '';
if (!manageTableIsValid($table)) {
	$table = 'categories';
}
$manageDepth = manageTables()[$table]['depth'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$manageFormAction = $_POST['form_action'] ?? '';
	$manageEditId = !empty($_POST['id']) ? (int)$_POST['id'] : null;
	$manageName = trim($_POST['name'] ?? '');
	$manageIconCustom = trim($_POST['icon_custom'] ?? '');
	$manageIcon = $manageIconCustom !== '' ? $manageIconCustom : trim($_POST['icon_choice'] ?? '');
	$manageParentId = ($_POST['parent_id'] ?? '') !== '' ? (int)$_POST['parent_id'] : null;
	$manage = $manageEditId !== null ? 'edit' : 'add';
	$manageNotFound = false;
} else {
	$manageFormAction = '';
	$manage = $_GET['manage'] ?? 'list';
	$manageEditId = ($manage === 'edit' || $manage === 'delete') && !empty($_GET['mid']) ? (int)$_GET['mid'] : null;
	$manageParentId = !empty($_GET['parent']) ? (int)$_GET['parent'] : null;

	$manageExisting = $manageEditId !== null ? manageEntityById($db, $table, $manageEditId) : null;
	$manageNotFound = $manageEditId !== null && $manageExisting === null;

	$manageName = $manageExisting['name'] ?? '';
	$manageIcon = $manageExisting['icon'] ?? '';
	// On edit, the parent comes from the existing row, not the URL.
	if ($manage === 'edit' && $manageExisting !== null && $manageDepth > 1) {
		$manageParentId = $manageExisting['parent_id'] !== null ? (int)$manageExisting['parent_id'] : null;
	}
}

$manageErrors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $manageFormAction === 'manage_save') {
	require __DIR__ . '/master-data-action-save.php';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $manageFormAction === 'manage_delete_confirmed') {
	require __DIR__ . '/master-data-action-delete.php';
}
