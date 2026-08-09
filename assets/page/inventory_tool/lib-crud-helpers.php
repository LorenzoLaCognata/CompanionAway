<?php
	function flatEntityCreate(mysqli $db, string $table, string $name, string $icon, string $defaultIcon): array {
		global $translations;
		$name = trim($name);
		if ($name === '') {
			return ['ok' => false, 'error' => $translations['validation_name_required']];
		}
		$existing = dbOne($db, "SELECT id FROM $table WHERE user_id = ? AND name = ?", [currentUserId(), $name]);
		if ($existing !== null) {
			return ['ok' => false, 'error' => $translations['manage_name_taken']];
		}
		dbExecute($db, "INSERT INTO $table (user_id, name, icon) VALUES (?,?,?)", [currentUserId(), $name, $icon !== '' ? $icon : $defaultIcon]);
		return ['ok' => true, 'error' => null];
	}

	function flatEntityUpdate(mysqli $db, string $table, int $id, string $name, string $icon, string $defaultIcon): array {
		global $translations;
		$name = trim($name);
		if ($name === '') {
			return ['ok' => false, 'error' => $translations['validation_name_required']];
		}
		$existing = dbOne($db, "SELECT id FROM $table WHERE user_id = ? AND name = ? AND id != ?", [currentUserId(), $name, $id]);
		if ($existing !== null) {
			return ['ok' => false, 'error' => $translations['manage_name_taken']];
		}
		dbExecute($db, "UPDATE $table SET name = ?, icon = ? WHERE id = ? AND user_id = ?", [$name, $icon !== '' ? $icon : $defaultIcon, $id, currentUserId()]);
		return ['ok' => true, 'error' => null];
	}

	function flatEntityDelete(mysqli $db, string $table, int $id): void {
		dbExecute($db, "DELETE FROM $table WHERE id = ? AND user_id = ?", [$id, currentUserId()]);
	}

	function treeEntityCreate(mysqli $db, string $table, string $name, string $icon, string $defaultIcon, ?int $parentId): array {
		global $translations;
		$name = trim($name);
		if ($name === '') {
			return ['ok' => false, 'error' => $translations['validation_name_required']];
		}
		dbExecute($db, "INSERT INTO $table (user_id, name, icon, parent_id) VALUES (?,?,?,?)", [currentUserId(), $name, $icon !== '' ? $icon : $defaultIcon, $parentId]);
		return ['ok' => true, 'error' => null];
	}

	function treeEntityUpdate(mysqli $db, string $table, int $id, string $name, string $icon, string $defaultIcon): array {
		global $translations;
		$name = trim($name);
		if ($name === '') {
			return ['ok' => false, 'error' => $translations['validation_name_required']];
		}
		dbExecute($db, "UPDATE $table SET name = ?, icon = ? WHERE id = ? AND user_id = ?", [$name, $icon !== '' ? $icon : $defaultIcon, $id, currentUserId()]);
		return ['ok' => true, 'error' => null];
	}

	function treeEntityDelete(mysqli $db, string $table, int $id): void {
		dbExecute($db, "DELETE FROM $table WHERE id = ? AND user_id = ?", [$id, currentUserId()]);
	}
