<?php
	$lang = basename(__DIR__);
	$currentPage = basename(__FILE__);
	
	$langJson = file_get_contents('intake_relocation/lang.json');
	$translations = json_decode($langJson, true);

	$pageStylesheet = '/assets/css/intake-style.min.css';
?>

<?php

	session_start();

	require_once '../assets/page/cookie_consent/functional-consent.php';
	require_once '../assets/page/analytics/funnel-log.php';
	require_once '../assets/page/intake_shared/submission-log.php';

	$i = isset($_GET['step']) ? (int) $_GET['step'] : 1;

	if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $i === 1) {
		$_SESSION['form_started_at'] = time();
	}

	if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $i === 1 && empty($_SESSION['data']) && ca_functional_allowed() && isset($_COOKIE['ca_resume_relocation'])) {
		$draft = ca_draft_load($_COOKIE['ca_resume_relocation'], 'relocation');
		if ($draft) {
			$_SESSION['data'] = $draft['data'];
			if ($draft['step'] > 1) {
				header('Location: ' . $currentPage . '?step=' . $draft['step']);
				exit;
			}
		}
	}

	if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $i === 1 && empty($_SESSION['data'])) {
		ca_funnel_log_once('relocation', 1);
	}
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$action = $_POST['action'] ?? 'next';

		if ($i === 1) {
			$fields = ['firstName', 'lastName', 'email', 'phone', 'currentLocation'];
		}
		else if ($i === 2) {
			$fields = ['movingFrom','movingTo','arrivalDate','dateCertainty','whoRelocating','reloLang','reloWorries','reloExtra'];
		}
		else if ($i === 3) {
			$fields = ['howFound','finalNotes'];
		}
		
		foreach ($fields as $field) {
			if (isset($_POST[$field])) {
				$_SESSION['data'][$field] = trim($_POST[$field]);
			}
		}
		
		if ($i === 2) {
			if (isset($_POST['reloTopics']) && is_array($_POST['reloTopics'])) {
				$_SESSION['data']['reloTopics'] = $_POST['reloTopics'];
			}
		}

		if ($action === 'next') {

			ca_funnel_log_once('relocation', $i + 1);

			if (ca_functional_allowed()) {
				if (!isset($_COOKIE['ca_resume_relocation'])) {
					$token = bin2hex(random_bytes(16));
					setcookie('ca_resume_relocation', $token, [
						'expires' => time() + 60 * 60 * 24 * 30,
						'path' => '/',
						'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
						'httponly' => true,
						'samesite' => 'Lax',
					]);
					$_COOKIE['ca_resume_relocation'] = $token;
				}
				ca_draft_save($_COOKIE['ca_resume_relocation'], 'relocation', $i + 1, $_SESSION['data']);
			}

			header('Location: ' . $currentPage . '?step=' . ($i+1));
			exit;
		} elseif ($action === 'prev') {
			header('Location: ' . $currentPage . '?step=' . ($i-1));
			exit;
		} elseif ($action === 'submit') {

			$submitError = false;

			$formStartedAt = $_SESSION['form_started_at'] ?? 0;
			$formElapsed = time() - $formStartedAt;

			if (empty($_POST['website']) && $formStartedAt > 0 && $formElapsed >= 3) {

				$submissionId = ca_submission_save('relocation', $_SESSION['data']);

				$sent = false;
				$to = 'contact@companionaway.com';
				$subject = 'Companion Away - Nuovo Trasferimento: ' . $_SESSION['data']['firstName'] . ' ' . $_SESSION['data']['lastName'];
				$body = "Nuova richiesta di supporto ricevuta:\n\n";
				$body .= '- Name: ' . $_SESSION['data']['firstName'] . ' ' . $_SESSION['data']['lastName'] . "\n";
				$body .= '- Email: ' . $_SESSION['data']['email'] . "\n";
				$body .= '- Phone: ' . $_SESSION['data']['phone'] . "\n";
				$body .= '- Current Location: ' . $_SESSION['data']['currentLocation'] . "\n";
				$body .= '- Moving From: ' . $_SESSION['data']['movingFrom'] . "\n";
				$body .= '- Moving To: ' . $_SESSION['data']['movingTo'] . "\n";
				$body .= '- Arrival Date: ' . $_SESSION['data']['arrivalDate'] . "\n";
				$body .= '- Certainty: ' . $_SESSION['data']['dateCertainty'] . "\n";
				$body .= '- Who: ' . $_SESSION['data']['whoRelocating'] . "\n";
				$body .= '- Topics: ' . checked_labels($_SESSION['data'], 'reloTopics', $translations) . "\n";
				$body .= '- Worries: ' . $_SESSION['data']['reloWorries'] . "\n";
				$body .= '- Extra: ' . $_SESSION['data']['reloExtra'] . "\n";
				$body .= '- How Found: ' . $_SESSION['data']['howFound'] . "\n";
				$body .= '- Final Notes: ' . $_SESSION['data']['finalNotes'] . "\n";
				$headers = 'From: companionaway@altervista.org' . "\r\n" .
					'Reply-To: ' . $_SESSION['data']['email'] . "\r\n" .
					'Cc: companionaway@altervista.org,companionaway@gmail.com' . "\r\n" .
					'Content-Type: text/plain; charset=UTF-8';
				$sent = mail($to, $subject, $body, $headers);

				if ($submissionId !== null) {
					ca_submission_mark_sent($submissionId, $sent);
				} elseif (!$sent) {
					$submitError = true;
				}
			}

			if (!$submitError) {
				ca_funnel_log('relocation', $i + 1, true);
				if (isset($_COOKIE['ca_resume_relocation'])) {
					ca_draft_delete($_COOKIE['ca_resume_relocation'], 'relocation');
					setcookie('ca_resume_relocation', '', [
						'expires' => time() - 3600,
						'path' => '/',
					]);
				}
				unset($_SESSION['data']);
				unset($_SESSION['form_started_at']);
				header('Location: ' . $currentPage . '?step=' . ($i+1));
				exit;
			}
		}
		
	}
	
	function is_checked($key, $value): bool {
		$stored = $_SESSION['data'][$key] ?? [];
		return is_array($stored) && in_array($value, $stored, true);
	}

	function checked_labels(array $data, string $key, array $translations): string {
		$labels = [];
		foreach ($data[$key] ?? [] as $code) {
			$labels[] = match ($code) {
				'housing' => $translations['relo_topic_housing'],
				'ssn' => $translations['relo_topic_ssn'],
				'bank' => $translations['relo_topic_bank'],
				'licence' => $translations['relo_topic_licence'],
				'health' => $translations['relo_topic_health'],
				'community' => $translations['relo_topic_community'],
				'inventory' => $translations['relo_topic_inventory'],
				'school' => $translations['relo_topic_school'],
				'pets' => $translations['relo_topic_pets'],
				'shipping' => $translations['relo_topic_shipping'],
				'language' => $translations['relo_topic_language'],
				'jobsearch' => $translations['relo_topic_jobsearch'],
				'other_relo' => $translations['relo_topic_other'],
				default => null,
			};
		}
		return implode('<br>', array_filter($labels));
	}
?>

<?php include 'head.php'; ?>

<?php include 'header.php'; ?>

<?php include '../assets/page/intake_relocation/hero.php'; ?>

<?php include '../assets/page/intake_relocation/intake_steps.php'; ?>
		
			<div class="intake-form-container">

<?php
	switch ($i) {
	  case 1: include('../assets/page/intake_relocation/relocation_1.php'); break;
	  case 2: include('../assets/page/intake_relocation/relocation_2.php'); break;
	  case 3: include('../assets/page/intake_relocation/relocation_3.php'); break;
	  case 4: include('../assets/page/intake_relocation/relocation_4.php'); break;
	  case 5: include('../assets/page/intake_relocation/relocation_5.php'); break;
	  default: break;
	}
?>

			</div>

<?php include 'footer.php'; ?>