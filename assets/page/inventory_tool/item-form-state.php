<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$formAction = $_POST['form_action'] ?? '';
	$itemNotFound = false;
	$editId = !empty($_POST['id']) ? (int)$_POST['id'] : null;
	$name = trim($_POST['name'] ?? '');
	$categoryId = ($_POST['category_id'] ?? '') !== '' ? (int)$_POST['category_id'] : null;
	$ownerId = ($_POST['owner_id'] ?? '') !== '' ? (int)$_POST['owner_id'] : null;
	$fPlace = ($_POST['f_place'] ?? '') !== '' ? (int)$_POST['f_place'] : null;
	$fRoom = ($_POST['f_room'] ?? '') !== '' ? (int)$_POST['f_room'] : null;
	$fCont = ($_POST['f_cont'] ?? '') !== '' ? (int)$_POST['f_cont'] : null;
	$fBagTop = ($_POST['f_bag_top'] ?? '') !== '' ? (int)$_POST['f_bag_top'] : null;
	$fBagCont = ($_POST['f_bag_cont'] ?? '') !== '' ? (int)$_POST['f_bag_cont'] : null;
	$pendingPhotoB64 = $_POST['pending_photo_b64'] ?? '';
	$pendingPhotoRemove = !empty($_POST['pending_photo_remove']);
} else {
	$formAction = '';
	$editId = $formActionMode === 'edit' && !empty($_GET['id']) ? (int)$_GET['id'] : null;
	$existing = $editId !== null ? itemById($db, $editId) : null;

	$itemNotFound = $editId !== null && $existing === null;

	$name = $existing['name'] ?? '';
	$categoryId = $existing['category_id'] ?? null;
	$ownerId = $existing['owner_id'] ?? null;
	[$fPlace, $fRoom, $fCont] = resolveLocationFields($db, $existing);
	[$fBagTop, $fBagCont] = resolveBagFields($db, $existing);
	$pendingPhotoB64 = '';
	$pendingPhotoRemove = false;
}
