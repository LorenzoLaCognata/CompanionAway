<?php

	function catAll(mysqli $db): array {
		return dbQuery($db, 'SELECT * FROM categories WHERE user_id = ? ORDER BY name', [currentUserId()]);
	}

	function catById(mysqli $db, ?int $id): ?array {
		if ($id === null) return null;
		return dbOne($db, 'SELECT * FROM categories WHERE id = ? AND user_id = ?', [$id, currentUserId()]);
	}

	function catCreate(mysqli $db, string $name, string $icon): array {
		return flatEntityCreate($db, 'categories', $name, $icon, '📦');
	}

	function catUpdate(mysqli $db, int $id, string $name, string $icon): array {
		return flatEntityUpdate($db, 'categories', $id, $name, $icon, '📦');
	}

	function catDelete(mysqli $db, int $id): void {
		flatEntityDelete($db, 'categories', $id);
	}
