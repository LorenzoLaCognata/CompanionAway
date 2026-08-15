<?php
	// Internal-only report. Protected with HTTP Basic Auth against
	require_once __DIR__ . '/private/config.php';

	if (!defined('REPORT_PASSWORD') || REPORT_PASSWORD === '') {
		http_response_code(500);
		echo 'REPORT_PASSWORD is not configured.';
		exit;
	}

	$user = $_SERVER['PHP_AUTH_USER'] ?? '';
	$pass = $_SERVER['PHP_AUTH_PW'] ?? '';

	if ($pass !== REPORT_PASSWORD) {
		header('WWW-Authenticate: Basic realm="Companion Away report"');
		http_response_code(401);
		echo 'Authentication required.';
		exit;
	}

	$db = null;
	try {
		$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	} catch (\Throwable $e) {
		$db = null;
	}

	$dbError = !$db;
	if ($db) $db->set_charset('utf8mb4');

	$days = isset($_GET['days']) ? max(1, (int) $_GET['days']) : 30;
	$includeSelf = isset($_GET['self']) && $_GET['self'] === '1';
	$selfClause = $includeSelf ? '' : 'AND self = 0';

	function fetchAll(?mysqli $db, string $sql): array {
		if (!$db) return [];
		$result = mysqli_query($db, $sql);
		if (!$result) return [];
		$rows = [];
		while ($row = mysqli_fetch_assoc($result)) $rows[] = $row;
		return $rows;
	}

	// --- Cookie consent stats ---
	$consentEvents = fetchAll($db, "
		SELECT event, COUNT(*) AS cnt
		FROM cookie_consent_log
		WHERE created_at > NOW() - INTERVAL $days DAY $selfClause
		GROUP BY event
	");
	$eventCounts = ['shown' => 0, 'choice' => 0, 'return' => 0];
	foreach ($consentEvents as $row) {
		$eventCounts[$row['event']] = (int) $row['cnt'];
	}

	$choiceSplit = fetchAll($db, "
		SELECT functional, analytics, COUNT(*) AS cnt
		FROM cookie_consent_log
		WHERE event = 'choice' AND created_at > NOW() - INTERVAL $days DAY $selfClause
		GROUP BY functional, analytics
		ORDER BY cnt DESC
	");

	function choiceLabel(array $row): string {
		if ($row['functional'] == 1 && $row['analytics'] == 1) return 'Accept all';
		if ($row['functional'] == 0 && $row['analytics'] == 0) return 'Essential only';
		if ($row['functional'] == 1 && $row['analytics'] == 0) return 'Functional only';
		return 'Analytics only';
	}

	// --- Intake funnel ---
	function funnelForType(?mysqli $db, string $type, int $days, string $selfClause): array {
		$rows = fetchAll($db, "
			SELECT step, completed, COUNT(*) AS cnt
			FROM intake_funnel_log
			WHERE type = '$type' AND created_at > NOW() - INTERVAL $days DAY $selfClause
			GROUP BY step, completed
			ORDER BY step
		");
		$steps = [];
		$completed = 0;
		foreach ($rows as $row) {
			if ((int) $row['completed'] === 1) {
				$completed += (int) $row['cnt'];
			} else {
				$steps[(int) $row['step']] = ($steps[(int) $row['step']] ?? 0) + (int) $row['cnt'];
			}
		}
		ksort($steps);
		return ['steps' => $steps, 'completed' => $completed];
	}

	$relocationFunnel = funnelForType($db, 'relocation', $days, $selfClause);
	$travelFunnel = funnelForType($db, 'travel', $days, $selfClause);

	// --- Submission delivery ---
	$failedSends = fetchAll($db, "
		SELECT id, type, created_at
		FROM intake_submission
		WHERE mail_sent = 0 AND created_at > NOW() - INTERVAL $days DAY
		ORDER BY created_at DESC
	");
	$totalSubmissions = fetchAll($db, "
		SELECT COUNT(*) AS cnt FROM intake_submission
		WHERE created_at > NOW() - INTERVAL $days DAY
	");
	$totalSubmissionsCount = (int) ($totalSubmissions[0]['cnt'] ?? 0);

	function renderFunnel(string $title, array $funnel): string {
		$out = "<h3>$title</h3>";
		if (empty($funnel['steps']) && $funnel['completed'] === 0) {
			return $out . '<p class="muted">No data yet.</p>';
		}
		$top = reset($funnel['steps']) ?: 1;
		$out .= '<table><tr><th>Reached</th><th>Sessions</th><th>% of step 1</th></tr>';
		foreach ($funnel['steps'] as $step => $cnt) {
			$pct = $top > 0 ? round(($cnt / $top) * 100) : 0;
			$out .= "<tr><td>Step $step</td><td>$cnt</td><td>{$pct}%</td></tr>";
		}
		$pctCompleted = $top > 0 ? round(($funnel['completed'] / $top) * 100) : 0;
		$out .= "<tr class=\"highlight\"><td>Completed</td><td>{$funnel['completed']}</td><td>{$pctCompleted}%</td></tr>";
		$out .= '</table>';
		return $out;
	}

	$otherDays = $includeSelf ? "days=$days" : "days=$days&self=1";
	$otherDaysLabel = $includeSelf ? 'Exclude self' : 'Include self';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Companion Away — Report</title>
	<meta name="robots" content="noindex, nofollow">
	<style>
		body { font-family: -apple-system, "Segoe UI", sans-serif; max-width: 720px; margin: 40px auto; padding: 0 20px; color: #1a2340; background: #fdf6ec; }
		h1 { font-weight: 600; margin-bottom: 4px; }
		h2 { margin-top: 40px; border-bottom: 1px solid #e3d9c8; padding-bottom: 8px; }
		h3 { margin-top: 24px; margin-bottom: 8px; }
		p.muted { color: #8a8478; font-size: 14px; }
		table { width: 100%; border-collapse: collapse; margin-bottom: 16px; font-size: 14px; }
		th, td { text-align: left; padding: 6px 10px; border-bottom: 1px solid #eee; }
		th { color: #8a8478; font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; }
		tr.highlight td { font-weight: 600; color: #c1502e; }
		.controls { font-size: 14px; margin-top: 8px; }
		.controls a { color: #c1502e; text-decoration: none; margin-right: 16px; }
		.controls a:hover { text-decoration: underline; }
		.summary { display: flex; gap: 24px; margin: 16px 0; flex-wrap: wrap; }
		.summary div { background: #fff; border-radius: 8px; padding: 12px 18px; }
		.summary .num { font-size: 28px; font-weight: 600; }
		.summary .label { font-size: 12px; color: #8a8478; text-transform: uppercase; letter-spacing: 0.05em; }
	</style>
</head>
<body>

	<h1>Companion Away — Report</h1>
	<p class="muted">Last <?= $days ?> days · <?= $includeSelf ? 'including' : 'excluding' ?> your own tagged visits</p>
	<div class="controls">
		<a href="?days=7<?= $includeSelf ? '&self=1' : '' ?>">7 days</a>
		<a href="?days=30<?= $includeSelf ? '&self=1' : '' ?>">30 days</a>
		<a href="?days=90<?= $includeSelf ? '&self=1' : '' ?>">90 days</a>
		<a href="?<?= $otherDays ?>"><?= $otherDaysLabel ?></a>
	</div>

	<?php if ($dbError): ?>
		<p class="muted">Could not connect to the database.</p>
	<?php else: ?>

		<h2>Cookie consent</h2>
		<div class="summary">
			<div><div class="num"><?= $eventCounts['shown'] ?></div><div class="label">Shown, no decision</div></div>
			<div><div class="num"><?= $eventCounts['choice'] ?></div><div class="label">Decisions made</div></div>
			<div><div class="num"><?= $eventCounts['return'] ?></div><div class="label">Return, already decided</div></div>
		</div>

		<?php if (!empty($choiceSplit)): ?>
			<table>
				<tr><th>Choice</th><th>Count</th></tr>
				<?php foreach ($choiceSplit as $row): ?>
					<tr><td><?= choiceLabel($row) ?></td><td><?= (int) $row['cnt'] ?></td></tr>
				<?php endforeach; ?>
			</table>
		<?php else: ?>
			<p class="muted">No decisions logged yet.</p>
		<?php endif; ?>

		<h2>Intake funnel</h2>
		<?= renderFunnel('Relocation', $relocationFunnel) ?>
		<?= renderFunnel('Travel', $travelFunnel) ?>

		<h2>Submission delivery</h2>
		<p class="muted"><?= $totalSubmissionsCount ?> submission<?= $totalSubmissionsCount === 1 ? '' : 's' ?> saved in the last <?= $days ?> days.</p>
		<?php if (!empty($failedSends)): ?>
			<table>
				<tr><th>Type</th><th>When</th><th>Note</th></tr>
				<?php foreach ($failedSends as $row): ?>
					<tr class="highlight">
						<td><?= htmlspecialchars($row['type']) ?></td>
						<td><?= htmlspecialchars($row['created_at']) ?></td>
						<td>Email did not send — check <code>intake_submission</code> id <?= (int) $row['id'] ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php else: ?>
			<p class="muted">No failed sends in this period.</p>
		<?php endif; ?>

	<?php endif; ?>

</body>
</html>
