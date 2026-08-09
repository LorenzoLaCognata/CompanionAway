<?php
	function ownerAll(mysqli $db): array {
		return dbQuery($db, 'SELECT * FROM owners WHERE user_id = ? ORDER BY name', [currentUserId()]);
	}

	function ownerById(mysqli $db, ?int $id): ?array {
		if ($id === null) return null;
		return dbOne($db, 'SELECT * FROM owners WHERE id = ? AND user_id = ?', [$id, currentUserId()]);
	}

	function ownerCreate(mysqli $db, string $name, string $icon): array {
		return flatEntityCreate($db, 'owners', $name, $icon, '👤');
	}

	function ownerUpdate(mysqli $db, int $id, string $name, string $icon): array {
		return flatEntityUpdate($db, 'owners', $id, $name, $icon, '👤');
	}

	function ownerDelete(mysqli $db, int $id): void {
		flatEntityDelete($db, 'owners', $id);
	}
