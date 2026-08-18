<?php
	// Whitelist of manageable tables and their static config.
	// depth: number of levels (1 = flat, 2 = bags, 3 = locations).
	function manageTables(): array {
		return [
			'categories' => [
				'depth' => 1, 'title' => 'manage_categories_title', 'empty' => 'sidebar_no_categories', 'icon' => '📦',
				'icons' => ['📦', '🧢', '👕', '🛠️', '💻', '📚', '🎧', '🧴', '⚽', '🎮'],
			],
			'owners' => [
				'depth' => 1, 'title' => 'manage_owners_title', 'empty' => 'manage_no_owners', 'icon' => '👤',
				'icons' => ['👤', '👨', '👩', '🧑', '👦', '👧', '👴', '👵'],
			],
			'bags' => [
				'depth' => 2, 'title' => 'manage_bags_title', 'empty' => 'sidebar_no_bags', 'icon' => '🧳',
				'icons' => ['🧳', '🎒', '👜', '💼', '🛍️', '🧰', '👝', '🎽'],
			],
			'locations' => [
				'depth' => 3, 'title' => 'manage_locations_title', 'empty' => 'sidebar_no_locations', 'icon' => '📍',
				'icons' => ['📍', '🏠', '🚪', '🗄️', '🛏️', '🚗', '🏢', '🗃️'],
			],
		];
	}

	function manageIconChoices(string $table): array {
		return manageTables()[$table]['icons'] ?? [];
	}

	function manageTableIsValid(string $table): bool {
		return array_key_exists($table, manageTables());
	}

	function manageEntityById(mysqli $db, string $table, ?int $id): ?array {
		return match ($table) {
			'categories' => catById($db, $id),
			'owners' => ownerById($db, $id),
			'bags' => bagById($db, $id),
			'locations' => locById($db, $id),
			default => null,
		};
	}

	function manageEntityTopLevel(mysqli $db, string $table): array {
		return match ($table) {
			'categories' => catAll($db),
			'owners' => ownerAll($db),
			'bags' => bagTopLevel($db),
			'locations' => locPlaces($db),
			default => [],
		};
	}

	function manageEntityChildren(mysqli $db, string $table, int $parentId): array {
		return match ($table) {
			'bags' => bagChildren($db, $parentId),
			'locations' => locChildren($db, $parentId),
			default => [],
		};
	}

	// Level of an existing entity: 0-based from the root. -1 if $id is null (i.e. "no parent" / root).
	function manageEntityLevel(mysqli $db, string $table, ?int $id): int {
		if ($id === null) return -1;
		return match ($table) {
			'bags' => bagLevel($db, $id),
			'locations' => locLevel($db, $id),
			default => -1,
		};
	}

	function manageEntitySave(mysqli $db, string $table, ?int $id, string $name, string $icon, ?int $parentId): array {
		if ($id !== null) {
			return match ($table) {
				'categories' => catUpdate($db, $id, $name, $icon),
				'owners' => ownerUpdate($db, $id, $name, $icon),
				'bags' => bagUpdate($db, $id, $name, $icon),
				'locations' => locUpdate($db, $id, $name, $icon),
				default => ['ok' => false, 'error' => null],
			};
		}
		return match ($table) {
			'categories' => catCreate($db, $name, $icon),
			'owners' => ownerCreate($db, $name, $icon),
			'bags' => bagCreate($db, $name, $icon, $parentId),
			'locations' => locCreate($db, $name, $icon, $parentId),
			default => ['ok' => false, 'error' => null],
		};
	}

	function manageEntityDelete(mysqli $db, string $table, int $id): void {
		match ($table) {
			'categories' => catDelete($db, $id),
			'owners' => ownerDelete($db, $id),
			'bags' => bagDelete($db, $id),
			'locations' => locDelete($db, $id),
			default => null,
		};
	}

	// Translation key for the "+ Add ..." button, given the level of the parent it will be added under.
	// $parentLevel: -1 for root, 0 for a level-0 parent, 1 for a level-1 parent.
	function manageAddLabelKey(string $table, int $parentLevel): string {
		if ($table === 'bags') {
			return $parentLevel === -1 ? 'manage_add_bag' : 'manage_add_case';
		}
		if ($table === 'locations') {
			return match ($parentLevel) {
				-1 => 'manage_add_place',
				0 => 'manage_add_room',
				default => 'manage_add_container',
			};
		}
		return $table === 'owners' ? 'manage_add_owner' : 'manage_add_category';
	}

	// The add-button translations carry a parenthetical example, e.g. "+ Add Room
	// (kitchen, bedroom…)" — that's fine in the roomy toolbar but wraps awkwardly
	// in a narrow table cell, so row-level buttons use just the part before " (".
	function manageShortLabel(string $label): string {
		$pos = mb_strpos($label, ' (');
		return $pos !== false ? mb_substr($label, 0, $pos) : $label;
	}

	// Renders <tr> rows for one entity and, recursively, all of its descendants.
	// $level is this entity's 0-based depth (0 = root). Row indent and the
	// "+ Add ..." button under the last non-leaf level are derived from it.
	function manageRenderEntityRow(mysqli $db, string $table, string $currentPage, array $translations, array $entity, int $level, int $maxDepth): void {
		$id = (int)$entity['id'];
		$indentClass = $level > 0 ? ' hi-table__indent-' . min($level, 2) : '';
		$editUrl = manageUrl($currentPage, $table, 'edit', $id);
		$deleteUrl = manageUrl($currentPage, $table, 'delete', $id);
		$isLastLevel = $level >= $maxDepth - 1;
		?>
		<tr>
			<td><?= htmlspecialchars($entity['icon']) ?></td>
			<td class="hi-table__name<?= $indentClass ?>"><?= $level > 0 ? '<span class="hi-table__branch">↳</span> ' : '' ?><?= htmlspecialchars($entity['name']) ?></td>
<?php if ($maxDepth > 1): ?>
			<td>
<?php if (!$isLastLevel): $addUrl = manageUrl($currentPage, $table, 'add', null, $id); ?>
				<a class="hi-row-actions__btn" href="<?= htmlspecialchars($addUrl) ?>"><?= htmlspecialchars(manageShortLabel($translations[manageAddLabelKey($table, $level)])) ?></a>
<?php endif; ?>
			</td>
<?php endif; ?>
			<td>
				<div class="hi-row-actions">
					<a class="hi-row-actions__btn" href="<?= htmlspecialchars($editUrl) ?>" title="<?= htmlspecialchars($translations['action_edit']) ?>">✏️</a>
					<a class="hi-row-actions__btn hi-row-actions__btn--danger" href="<?= htmlspecialchars($deleteUrl) ?>" title="<?= htmlspecialchars($translations['action_delete']) ?>">🗑</a>
				</div>
			</td>
		</tr>
<?php
		if (!$isLastLevel) {
			foreach (manageEntityChildren($db, $table, $id) as $child) {
				manageRenderEntityRow($db, $table, $currentPage, $translations, $child, $level + 1, $maxDepth);
			}
		}
	}

	function manageUrl(string $currentPage, string $table, string $manage = 'list', ?int $mid = null, ?int $parent = null): string {
		$url = $currentPage . '?action=master_data&table=' . urlencode($table);
		if ($manage !== 'list') $url .= '&manage=' . urlencode($manage);
		if ($mid !== null) $url .= '&mid=' . $mid;
		if ($parent !== null) $url .= '&parent=' . $parent;
		return $url;
	}
