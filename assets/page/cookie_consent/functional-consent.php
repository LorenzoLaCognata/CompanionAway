<?php
	// POLICY_VERSION here must match the POLICY_VERSION constant in
	// en/footer.php and it/footer.php's inline script — same duplication
	// pattern already used for GA_ID across this codebase.

	function ca_functional_allowed(): bool {
		if (!isset($_COOKIE['ca_consent'])) return false;
		$consent = json_decode($_COOKIE['ca_consent'], true);
		if (!is_array($consent)) return false;
		if (($consent['version'] ?? null) !== 1) return false;
		return !empty($consent['functional']);
	}

	function ca_draft_db(): ?mysqli {
		static $db = null;
		static $tried = false;
		if ($tried) return $db;
		$tried = true;
		require_once __DIR__ . '/../../../private/config.php';
		try {
			$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if ($conn) {
				$conn->set_charset('utf8mb4');
				$db = $conn;
			}
		} catch (\Throwable $e) {
			$db = null;
		}
		return $db;
	}

	function ca_draft_save(string $token, string $type, int $step, array $data): void {
		$db = ca_draft_db();
		if (!$db) return;
		$json = json_encode($data);
		$stmt = mysqli_prepare($db, 'INSERT INTO intake_draft (token, type, step, data) VALUES (?, ?, ?, ?)
			ON DUPLICATE KEY UPDATE step = VALUES(step), data = VALUES(data), updated_at = CURRENT_TIMESTAMP');
		if (!$stmt) return;
		mysqli_stmt_bind_param($stmt, 'ssis', $token, $type, $step, $json);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}

	function ca_draft_load(string $token, string $type): ?array {
		$db = ca_draft_db();
		if (!$db) return null;
		$stmt = mysqli_prepare($db, 'SELECT step, data FROM intake_draft WHERE token = ? AND type = ?');
		if (!$stmt) return null;
		mysqli_stmt_bind_param($stmt, 'ss', $token, $type);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = $result ? mysqli_fetch_assoc($result) : null;
		mysqli_stmt_close($stmt);
		if (!$row) return null;
		$data = json_decode($row['data'], true);
		if (!is_array($data)) return null;
		return ['step' => (int) $row['step'], 'data' => $data];
	}

	function ca_draft_delete(string $token, string $type): void {
		$db = ca_draft_db();
		if (!$db) return;
		$stmt = mysqli_prepare($db, 'DELETE FROM intake_draft WHERE token = ? AND type = ?');
		if (!$stmt) return;
		mysqli_stmt_bind_param($stmt, 'ss', $token, $type);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
