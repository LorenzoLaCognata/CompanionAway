<?php
define('PHOTO_MAX_DIM', 400);
define('PHOTO_QUALITY', 78);
define('PEXELS_RESULT_POOL_SIZE', 5);

function fetchStockPhotoBytes(string $query, ?string &$error = null, int $poolSize = PEXELS_RESULT_POOL_SIZE): ?string {
	global $translations;
	$error = null;

	if (!defined('PEXELS_API_KEY') || trim(PEXELS_API_KEY) === '') {
		$error = $translations['error_pexels_key_missing'];
		return null;
	}

	$url = 'https://api.pexels.com/v1/search?' . http_build_query([
		'query' => $query,
		'per_page' => $poolSize,
		'orientation' => 'square',
	]);

	$ch = curl_init($url);
	curl_setopt_array($ch, [
		CURLOPT_HTTPHEADER => ['Authorization: ' . PEXELS_API_KEY],
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 8,
	]);
	$response = curl_exec($ch);
	$curlErrno = curl_errno($ch);
	$curlError = curl_error($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	if ($response === false) {
		$error = sprintf($translations['error_pexels_unreachable'], $curlErrno, $curlError);
		return null;
	}
	if ($httpCode !== 200) {
		$error = sprintf($translations['error_pexels_bad_status'], $httpCode);
		return null;
	}

	$json = json_decode($response, true);
	if ($json === null) {
		$error = $translations['error_pexels_invalid_json'];
		return null;
	}

	$photos = $json['photos'] ?? [];
	if (empty($photos)) {
		$error = sprintf($translations['error_pexels_no_results'], $query);
		return null;
	}
	$chosen = $photos[array_rand($photos)];
	$imageUrl = $chosen['src']['medium'] ?? null;
	if ($imageUrl === null) {
		$error = $translations['error_pexels_no_image_url'];
		return null;
	}

	$ch = curl_init($imageUrl);
	curl_setopt_array($ch, [
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 8,
	]);
	$imageData = curl_exec($ch);
	$dlErrno = curl_errno($ch);
	$dlError = curl_error($ch);
	curl_close($ch);

	if ($imageData === false) {
		$error = sprintf($translations['error_pexels_download_failed'], $dlErrno, $dlError);
		return null;
	}

	$img = loadImageFromString($imageData);
	if ($img === null) {
		$error = $translations['error_pexels_unreadable_image'];
		return null;
	}
	$jpegBytes = resizeToJpegBytes($img);
	imagedestroy($img);
	return $jpegBytes;
}

function fetchStockPhoto(mysqli $db, int $id, string $query, ?string &$error = null): bool {
	$bytes = fetchStockPhotoBytes($query, $error, 1);
	if ($bytes === null) {
		return false;
	}
	savePhotoBlob($db, $id, $bytes);
	return true;
}

function itemHasPhoto(mysqli $db, int $id): bool {
	$row = dbOne($db, 'SELECT id FROM items WHERE id = ? AND user_id = ? AND image_data IS NOT NULL', [$id, currentUserId()]);
	return $row !== null;
}

function itemPhotoBlob(mysqli $db, int $id): ?array {
	return dbOne($db, 'SELECT image_data, image_mime FROM items WHERE id = ? AND user_id = ? AND image_data IS NOT NULL', [$id, currentUserId()]);
}

function deleteItemPhoto(mysqli $db, int $id): void {
	dbExecute($db, 'UPDATE items SET image_data = NULL, image_mime = NULL WHERE id = ? AND user_id = ?', [$id, currentUserId()]);
}

function resizeToJpegBytes($srcImage): string {
	$srcW = imagesx($srcImage);
	$srcH = imagesy($srcImage);
	$scale = min(1, PHOTO_MAX_DIM / max($srcW, $srcH));
	$destW = max(1, (int)round($srcW * $scale));
	$destH = max(1, (int)round($srcH * $scale));

	$destImage = imagecreatetruecolor($destW, $destH);
	$white = imagecolorallocate($destImage, 255, 255, 255);
	imagefill($destImage, 0, 0, $white);
	imagecopyresampled($destImage, $srcImage, 0, 0, 0, 0, $destW, $destH, $srcW, $srcH);

	ob_start();
	imagejpeg($destImage, null, PHOTO_QUALITY);
	$bytes = ob_get_clean();
	imagedestroy($destImage);
	return $bytes;
}

function loadImageFromString(string $data) {
	$img = @imagecreatefromstring($data);
	return $img !== false ? $img : null;
}

function savePhotoBlob(mysqli $db, int $id, string $jpegBytes): void {
	dbExecute($db, 'UPDATE items SET image_data = ?, image_mime = ? WHERE id = ? AND user_id = ?',
		[$jpegBytes, 'image/jpeg', $id, currentUserId()]);
}

function saveUploadedPhoto(mysqli $db, int $id, array $file, ?string &$error = null): bool {
	global $translations;
	$error = null;

	if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
		$error = sprintf($translations['error_upload_failed'], $file['error'] ?? 'unknown');
		return false;
	}
	if ($file['size'] > 15 * 1024 * 1024) {
		$error = $translations['error_upload_too_large'];
		return false;
	}
	$data = file_get_contents($file['tmp_name']);
	$img = $data !== false ? loadImageFromString($data) : null;
	if ($img === null) {
		$error = $translations['error_upload_unreadable'];
		return false;
	}
	$jpegBytes = resizeToJpegBytes($img);
	imagedestroy($img);
	savePhotoBlob($db, $id, $jpegBytes);
	return true;
}
