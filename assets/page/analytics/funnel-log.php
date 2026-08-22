<?php
	function ca_funnel_db(): ?mysqli {
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

	function ca_funnel_log(string $type, int $step, bool $completed = false): void {
		$db = ca_funnel_db();
		if (!$db) return;
		$self = (($_COOKIE['ca_self'] ?? '0') === '1') ? 1 : 0;
		$completedInt = $completed ? 1 : 0;
		$stmt = mysqli_prepare($db, 'INSERT INTO intake_funnel_log (type, step, completed, self) VALUES (?, ?, ?, ?)');
		if (!$stmt) return;
		mysqli_stmt_bind_param($stmt, 'siii', $type, $step, $completedInt, $self);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}

	function ca_funnel_log_once(string $type, int $step, bool $completed = false): void {
		if (!isset($_SESSION['funnelLoggedSteps']) || !is_array($_SESSION['funnelLoggedSteps'])) {
			$_SESSION['funnelLoggedSteps'] = [];
		}
		$key = $type . ':' . $step;
		if (in_array($key, $_SESSION['funnelLoggedSteps'], true)) return;
		$_SESSION['funnelLoggedSteps'][] = $key;
		ca_funnel_log($type, $step, $completed);
	}
