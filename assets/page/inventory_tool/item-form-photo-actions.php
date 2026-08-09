<?php

$photoActionError = null;

if ($editId !== null && itemById($db, $editId) !== null) {
	if ($formAction === 'remove_photo') {
		$pendingPhotoRemove = true;
		$pendingPhotoB64 = '';
	} elseif ($formAction === 'refetch_photo') {
		$categoryName = catById($db, $categoryId)['name'] ?? null;
		$bytes = fetchStockPhotoBytes($categoryName !== null ? "macro shot, and close-up without other items, of $name $categoryName" : $name, $photoActionError);
		if ($bytes !== null) {
			$pendingPhotoB64 = base64_encode($bytes);
			$pendingPhotoRemove = false;
		}
	}
}
