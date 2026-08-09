<?php

	function getItems(mysqli $db, string $type, ?int $filter, string $search, array $extra, string $sort): array {
		$sql = 'SELECT i.id, i.user_id, i.name, i.category_id, i.location_id, i.bag_id, i.owner_id, i.created_at,
					   (i.image_data IS NOT NULL) AS has_photo,
					   c.name cat_name, c.icon cat_icon,
					   l.name loc_name, b.name bag_name, b.icon bag_icon,
					   o.name owner_name, o.icon owner_icon
				FROM items i
				LEFT JOIN categories c ON i.category_id = c.id AND c.user_id = i.user_id
				LEFT JOIN locations l ON i.location_id = l.id AND l.user_id = i.user_id
				LEFT JOIN bags b ON i.bag_id = b.id AND b.user_id = i.user_id
				LEFT JOIN owners o ON i.owner_id = o.id AND o.user_id = i.user_id
				WHERE i.user_id = ?';
		$params = [currentUserId()];

		applyTypeFilter($db, $sql, $params, $type, $filter);
		applyExtraFilters($db, $sql, $params, $extra);

		$search = trim($search);
		if ($search !== '') {
			$sql .= ' AND i.name LIKE ?';
			$params[] = '%' . $search . '%';
		}

		$orderBy = match ($sort) {
			'cat' => 'c.name',
			'loc' => 'l.name',
			'bag' => 'b.name',
			'owner' => 'o.name',
			default => 'i.name',
		};
		$sql .= " ORDER BY $orderBy IS NULL, $orderBy";

		return dbQuery($db, $sql, $params);
	}

	function applyTypeFilter(mysqli $db, string &$sql, array &$params, string $type, ?int $filter): void {
		if ($type === 'category' && $filter !== null) {
			$sql .= ' AND i.category_id = ?';
			$params[] = $filter;
		} elseif ($type === 'category_none') {
			$sql .= ' AND i.category_id IS NULL';
		} elseif ($type === 'bag' && $filter !== null) {
			$ids = bagDescendants($db, $filter);
			$placeholders = implode(',', array_fill(0, count($ids), '?'));
			$sql .= " AND i.bag_id IN ($placeholders)";
			array_push($params, ...$ids);
		} elseif ($type === 'unassigned') {
			$sql .= ' AND (i.bag_id IS NULL)';
		} elseif ($type === 'owner_none') {
			$sql .= ' AND i.owner_id IS NULL';
		} elseif ($type === 'owner' && $filter !== null) {
			$sql .= ' AND i.owner_id = ?';
			$params[] = $filter;
		} elseif ($type === 'location' && $filter !== null) {
			$ids = locDescendants($db, $filter);
			$placeholders = implode(',', array_fill(0, count($ids), '?'));
			$sql .= " AND i.location_id IN ($placeholders)";
			array_push($params, ...$ids);
		} elseif ($type === 'location_none') {
			$sql .= ' AND i.location_id IS NULL';
		}
	}

	function applyExtraFilters(mysqli $db, string &$sql, array &$params, array $extra): void {
		if (!empty($extra['cat'])) {
			$sql .= ' AND i.category_id = ?';
			$params[] = $extra['cat'];
		}
		if (!empty($extra['owner'])) {
			$sql .= ' AND i.owner_id = ?';
			$params[] = $extra['owner'];
		}
		if (!empty($extra['loc'])) {
			$ids = locDescendants($db, $extra['loc']);
			$placeholders = implode(',', array_fill(0, count($ids), '?'));
			$sql .= " AND i.location_id IN ($placeholders)";
			array_push($params, ...$ids);
		}
		if (!empty($extra['bag'])) {
			$ids = bagDescendants($db, $extra['bag']);
			$placeholders = implode(',', array_fill(0, count($ids), '?'));
			$sql .= " AND i.bag_id IN ($placeholders)";
			array_push($params, ...$ids);
		}
	}
