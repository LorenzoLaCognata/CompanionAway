<?php

	function locById(mysqli $db, ?int $id): ?array {
		if ($id === null) return null;
		return dbOne($db, 'SELECT * FROM locations WHERE id = ? AND user_id = ?', [$id, currentUserId()]);
	}

	function locPlaces(mysqli $db): array {
		return dbQuery($db, 'SELECT * FROM locations WHERE parent_id IS NULL AND user_id = ? ORDER BY id', [currentUserId()]);
	}

	function locChildren(mysqli $db, int $parentId): array {
		return dbQuery($db, 'SELECT * FROM locations WHERE parent_id = ? AND user_id = ? ORDER BY name', [$parentId, currentUserId()]);
	}

	function locDescendants(mysqli $db, int $id): array {
		$ids = [$id];
		foreach (locChildren($db, $id) as $child) {
			foreach (locDescendants($db, (int)$child['id']) as $descId) {
				$ids[] = $descId;
			}
		}
		return $ids;
	}

	function locLevel(mysqli $db, ?int $id): int {
		$loc = locById($db, $id);
		if ($loc === null) return -1;
		if ($loc['parent_id'] === null) return 0;
		$parent = locById($db, (int)$loc['parent_id']);
		if ($parent !== null && $parent['parent_id'] !== null) return 2;
		return 1;
	}

	function locPath(mysqli $db, ?int $id): ?string {
		if ($id === null) return null;
		$loc = locById($db, $id);
		if ($loc === null) return null;
		if ($loc['parent_id'] !== null) {
			$parentPath = locPath($db, (int)$loc['parent_id']);
			return $parentPath !== null ? $parentPath . ' › ' . $loc['name'] : $loc['name'];
		}
		return $loc['name'];
	}

	function locShort(mysqli $db, ?int $id): ?string {
		$path = locPath($db, $id);
		if ($path === null) return null;
		$parts = explode(' › ', $path);
		if (count($parts) > 2) {
			return implode(' › ', array_slice($parts, -2));
		}
		return $path;
	}

	function locCreate(mysqli $db, string $name, string $icon, ?int $parentId): array {
		global $translations;
		if ($parentId !== null && locLevel($db, $parentId) >= 2) {
			return ['ok' => false, 'error' => $translations['manage_max_depth']];
		}
		return treeEntityCreate($db, 'locations', $name, $icon, '📍', $parentId);
	}

	function locUpdate(mysqli $db, int $id, string $name, string $icon): array {
		return treeEntityUpdate($db, 'locations', $id, $name, $icon, '📍');
	}

	function locDelete(mysqli $db, int $id): void {
		treeEntityDelete($db, 'locations', $id);
	}
