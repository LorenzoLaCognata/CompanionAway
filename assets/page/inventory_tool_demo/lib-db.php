<?php

	function slugify(string $s): string {
		return preg_replace('/\s+/', '_', trim($s));
	}

	function dbQuery(mysqli $db, string $sql, array $params = []): array {
		$stmt = mysqli_prepare($db, $sql);
		if ($stmt === false) {
			die('Query prepare failed: ' . mysqli_error($db) . ' | SQL: ' . $sql);
		}
		if ($params) {
			$types = str_repeat('s', count($params));
			mysqli_stmt_bind_param($stmt, $types, ...$params);
		}
		$ok = mysqli_stmt_execute($stmt);
		if (!$ok) {
			die('Query execute failed: ' . mysqli_stmt_error($stmt) . ' | SQL: ' . $sql);
		}
		$result = mysqli_stmt_get_result($stmt);
		$rows = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
		mysqli_stmt_close($stmt);
		return $rows;
	}

	function dbOne(mysqli $db, string $sql, array $params = []): ?array {
		$rows = dbQuery($db, $sql, $params);
		return $rows[0] ?? null;
	}

	function dbExecute(mysqli $db, string $sql, array $params = []): void {
		$stmt = mysqli_prepare($db, $sql);
		if ($stmt === false) {
			die('Query prepare failed: ' . mysqli_error($db) . ' | SQL: ' . $sql);
		}
		if ($params) {
			$types = str_repeat('s', count($params));
			mysqli_stmt_bind_param($stmt, $types, ...$params);
		}
		$ok = mysqli_stmt_execute($stmt);
		if (!$ok) {
			die('Query execute failed: ' . mysqli_stmt_error($stmt) . ' | SQL: ' . $sql);
		}
		mysqli_stmt_close($stmt);
	}
