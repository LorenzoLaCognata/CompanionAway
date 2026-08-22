<?php
$manageErrors = [];

if ($manageName === '') {
	$manageErrors[] = $translations['validation_name_required'];
}

if (empty($manageErrors)) {
	$icon = $manageIcon !== '' ? $manageIcon : manageTables()[$table]['icon'];
	$result = manageEntitySave($db, $table, $manageEditId, $manageName, $icon, $manageDepth > 1 ? $manageParentId : null);

	if ($result['ok']) {
		header('Location: ' . manageUrl($currentPage, $table));
		exit;
	}

	$manageErrors[] = $result['error'];
}
