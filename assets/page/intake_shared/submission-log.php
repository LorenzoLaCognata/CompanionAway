<?php
	function ca_submission_db(): ?mysqli {
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

	function ca_submission_save(string $type, array $data): ?int {
		$db = ca_submission_db();
		if (!$db) return null;
		$json = json_encode($data);
		$stmt = mysqli_prepare($db, 'INSERT INTO intake_submission (type, data, mail_sent) VALUES (?, ?, 0)');
		if (!$stmt) return null;
		mysqli_stmt_bind_param($stmt, 'ss', $type, $json);
		if (!mysqli_stmt_execute($stmt)) {
			mysqli_stmt_close($stmt);
			return null;
		}
		$id = mysqli_insert_id($db);
		mysqli_stmt_close($stmt);
		return $id > 0 ? $id : null;
	}

	function ca_submission_mark_sent(int $id, bool $sent): void {
		$db = ca_submission_db();
		if (!$db) return;
		$sentInt = $sent ? 1 : 0;
		$stmt = mysqli_prepare($db, 'UPDATE intake_submission SET mail_sent = ? WHERE id = ?');
		if (!$stmt) return;
		mysqli_stmt_bind_param($stmt, 'ii', $sentInt, $id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
