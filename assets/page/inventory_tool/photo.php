<?php
require_once $dir . '/bootstrap.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$photo = itemPhotoBlob($db, $id);

if ($photo === null) {
	http_response_code(404);
	exit;
}

header('Content-Type: ' . $photo['image_mime']);
header('Content-Length: ' . strlen($photo['image_data']));
header('Cache-Control: private, no-cache, must-revalidate');
echo $photo['image_data'];
