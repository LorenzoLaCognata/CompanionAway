<?php
	require_once __DIR__ . '/private/config.php';

	header('Content-Type: application/json');

	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		http_response_code(405);
		exit;
	}

	$raw = file_get_contents('php://input');
	$payload = json_decode($raw, true);

	if (!is_array($payload) || !isset($payload['event'])) {
		http_response_code(400);
		exit;
	}

	$event = $payload['event'];

	if (!in_array($event, ['shown', 'choice', 'return'], true)) {
		http_response_code(400);
		exit;
	}

	$self = !empty($payload['self']) ? 1 : 0;

	$functional = null;
	$analytics = null;

	if ($event === 'choice') {
		$functional = !empty($payload['functional']) ? 1 : 0;
		$analytics  = !empty($payload['analytics']) ? 1 : 0;
	}

	$db = null;
	try {
		$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	} catch (\Throwable $e) {
		$db = null;
	}

	if ($db) {
		$db->set_charset('utf8mb4');
		$stmt = mysqli_prepare($db, 'INSERT INTO cookie_consent_log (event, functional, analytics, self) VALUES (?, ?, ?, ?)');
		if ($stmt) {
			mysqli_stmt_bind_param($stmt, 'siii', $event, $functional, $analytics, $self);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		mysqli_close($db);
	}

	http_response_code(204);
