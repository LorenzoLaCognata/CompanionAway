<?php
if ($manageEditId !== null && manageEntityById($db, $table, $manageEditId) !== null) {
	manageEntityDelete($db, $table, $manageEditId);
}

header('Location: ' . manageUrl($currentPage, $table));
exit;
