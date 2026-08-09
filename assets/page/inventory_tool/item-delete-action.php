<?php
$deleteId = !empty($_POST['id']) ? (int)$_POST['id'] : null;

if ($deleteId !== null && itemById($db, $deleteId) !== null) {
	dbExecute($db, 'DELETE FROM items WHERE id = ? AND user_id = ?', [$deleteId, currentUserId()]);
}

$redirect = 'inventory_tool.php?deleted=1';
$context = listContextQuery();
if ($context !== '') {
	$redirect .= '&' . $context;
}
header('Location: ' . $redirect);
exit;
