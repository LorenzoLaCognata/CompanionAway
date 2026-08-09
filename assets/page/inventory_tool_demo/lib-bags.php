<?php

	function bagById(mysqli $db, ?int $id): ?array {
		if ($id === null) return null;
		return dbOne($db, 'SELECT * FROM bags WHERE id = ? AND user_id = ?', [$id, currentUserId()]);
	}

	function bagTopLevel(mysqli $db): array {
		return dbQuery($db, 'SELECT * FROM bags WHERE parent_id IS NULL AND user_id = ? ORDER BY id', [currentUserId()]);
	}

	function bagChildren(mysqli $db, int $parentId): array {
		return dbQuery($db, 'SELECT * FROM bags WHERE parent_id = ? AND user_id = ? ORDER BY name', [$parentId, currentUserId()]);
	}

	function bagDescendants(mysqli $db, int $id): array {
		$ids = [$id];
		foreach (bagChildren($db, $id) as $child) {
			foreach (bagDescendants($db, (int)$child['id']) as $descId) {
				$ids[] = $descId;
			}
		}
		return $ids;
	}

	function bagLevel(mysqli $db, ?int $id): int {
		$bag = bagById($db, $id);
		if ($bag === null) return -1;
		return $bag['parent_id'] === null ? 0 : 1;
	}

	function bagPath(mysqli $db, ?int $id): ?string {
		if ($id === null) return null;
		$bag = bagById($db, $id);
		if ($bag === null) return null;
		if ($bag['parent_id'] !== null) {
			$parentPath = bagPath($db, (int)$bag['parent_id']);
			return $parentPath !== null ? $parentPath . ' › ' . $bag['name'] : $bag['name'];
		}
		return $bag['name'];
	}

	function bagCreate(mysqli $db, string $name, string $icon, ?int $parentId): array {
		global $translations;
		if ($parentId !== null && bagLevel($db, $parentId) >= 1) {
			return ['ok' => false, 'error' => $translations['manage_max_depth']];
		}
		return treeEntityCreate($db, 'bags', $name, $icon, '🧳', $parentId);
	}

	function bagUpdate(mysqli $db, int $id, string $name, string $icon): array {
		return treeEntityUpdate($db, 'bags', $id, $name, $icon, '🧳');
	}

	function bagDelete(mysqli $db, int $id): void {
		treeEntityDelete($db, 'bags', $id);
	}
