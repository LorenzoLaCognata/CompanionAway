<?php
	function itemById(mysqli $db, int $id): ?array {
		return dbOne($db, 'SELECT id, user_id, name, category_id, location_id, bag_id, owner_id, created_at
			FROM items WHERE id = ? AND user_id = ?', [$id, currentUserId()]);
	}

	function itemCount(mysqli $db): int {
		return (int)dbOne($db, 'SELECT COUNT(*) n FROM items WHERE user_id = ?', [currentUserId()])['n'];
	}
