<?php
function resolveLocationFields(mysqli $db, ?array $existing): array {
	if ($existing === null || $existing['location_id'] === null) {
		return [null, null, null];
	}
	$level = locLevel($db, (int)$existing['location_id']);
	if ($level === 0) {
		return [(int)$existing['location_id'], null, null];
	}
	if ($level === 1) {
		$room = locById($db, (int)$existing['location_id']);
		return [(int)$room['parent_id'], (int)$existing['location_id'], null];
	}
	// level === 2
	$cont = locById($db, (int)$existing['location_id']);
	$room = locById($db, (int)$cont['parent_id']);
	return [(int)$room['parent_id'], (int)$cont['parent_id'], (int)$existing['location_id']];
}

function resolveBagFields(mysqli $db, ?array $existing): array {
	if ($existing === null || $existing['bag_id'] === null) {
		return [null, null];
	}
	$level = bagLevel($db, (int)$existing['bag_id']);
	if ($level === 0) {
		return [(int)$existing['bag_id'], null];
	}
	$bag = bagById($db, (int)$existing['bag_id']);
	return [(int)$bag['parent_id'], (int)$existing['bag_id']];
}
