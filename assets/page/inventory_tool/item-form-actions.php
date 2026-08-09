<?php
$errors = [];

if ($name === '') {
	$errors[] = $translations['validation_name_required'];
}

if (empty($errors)) {
	$locationId = $fCont ?? $fRoom ?? $fPlace ?? null;
	$bagId = $fBagCont ?? $fBagTop ?? null;
	$isNewItem = $editId === null;

	if ($categoryId !== null && catById($db, $categoryId) === null) $categoryId = null;
	if ($ownerId !== null && ownerById($db, $ownerId) === null) $ownerId = null;
	if ($locationId !== null && locById($db, $locationId) === null) $locationId = null;
	if ($bagId !== null && bagById($db, $bagId) === null) $bagId = null;

	if ($editId !== null) {
		dbExecute($db, 'UPDATE items SET name=?, category_id=?, location_id=?, bag_id=?, owner_id=? WHERE id=? AND user_id=?',
			[$name, $categoryId, $locationId, $bagId, $ownerId, $editId, currentUserId()]);
		$itemId = $editId;
	} else {
		dbExecute($db, 'INSERT INTO items (user_id, name, category_id, location_id, bag_id, owner_id) VALUES (?,?,?,?,?,?)',
			[currentUserId(), $name, $categoryId, $locationId, $bagId, $ownerId]);
		$itemId = (int)mysqli_insert_id($db);
	}

	$uploadError = null;
	$uploadedFile = $_FILES['photo_upload'] ?? null;
	if ($uploadedFile !== null && ($uploadedFile['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
		saveUploadedPhoto($db, $itemId, $uploadedFile, $uploadError);
	} elseif ($pendingPhotoB64 !== '') {
		$bytes = base64_decode($pendingPhotoB64, true);
		if ($bytes !== false) {
			savePhotoBlob($db, $itemId, $bytes);
		}
	} elseif ($pendingPhotoRemove) {
		deleteItemPhoto($db, $itemId);
	} elseif ($isNewItem) {
		$categoryName = catById($db, $categoryId)['name'] ?? null;
		fetchStockPhoto($db, $itemId, $categoryName !== null ? "macro shot, and close-up without other items, of $name $categoryName" : $name);
	}

	$redirect = 'inventory_tool.php?saved=1';
	if ($uploadError !== null) {
		$redirect .= '&photo_error=' . urlencode($uploadError);
	}
	$context = listContextQuery();
	if ($context !== '') {
		$redirect .= '&' . $context;
	}
	header('Location: ' . $redirect);
	exit;
}
