<?php
	$lang = basename(__DIR__);
	$currentPage = basename(__FILE__);
	
	$langJson = file_get_contents('intake_travel/lang.json');
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

	if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $i === 1 && empty($_SESSION['data']) && ca_functional_allowed() && isset($_COOKIE['ca_resume_travel'])) {
		$draft = ca_draft_load($_COOKIE['ca_resume_travel'], 'travel');
		if ($draft) {
			$_SESSION['data'] = $draft['data'];
			if ($draft['step'] > 1) {
				header('Location: ' . $currentPage . '?step=' . $draft['step']);
				exit;
			}
		}
	}

	if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $i === 1 && empty($_SESSION['data'])) {
		ca_funnel_log_once('travel', 1);
	}
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$action = $_POST['action'] ?? 'next';

		if ($i === 1) {
			$fields = ['firstName', 'lastName', 'email', 'phone', 'currentLocation'];
		}
		else if ($i === 2) {
			$fields = ['travelDest','travelDates','tripLength','firstTime','travelGroup','groupSize','travelBudget','pace','chronotype','bookingStyle','specialOccasion','accessibility'];
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
			if (isset($_POST['travelStyle']) && is_array($_POST['travelStyle'])) {
				$_SESSION['data']['travelStyle'] = $_POST['travelStyle'];
			}
			if (isset($_POST['transport']) && is_array($_POST['transport'])) {
				$_SESSION['data']['transport'] = $_POST['transport'];
			}
			if (isset($_POST['accommodation']) && is_array($_POST['accommodation'])) {
				$_SESSION['data']['accommodation'] = $_POST['accommodation'];
			}
		}

		if ($action === 'next') {

			ca_funnel_log_once('travel', $i + 1);

			if (ca_functional_allowed()) {
				if (!isset($_COOKIE['ca_resume_travel'])) {
					$token = bin2hex(random_bytes(16));
					setcookie('ca_resume_travel', $token, [
						'expires' => time() + 60 * 60 * 24 * 30,
						'path' => '/',
						'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
						'httponly' => true,
						'samesite' => 'Lax',
					]);
					$_COOKIE['ca_resume_travel'] = $token;
				}
				ca_draft_save($_COOKIE['ca_resume_travel'], 'travel', $i + 1, $_SESSION['data']);
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

				$submissionId = ca_submission_save('travel', $_SESSION['data']);

				$sent = false;
				$to = 'contact@companionaway.com';
				$subject = 'Companion Away - Nuovo Viaggio: ' . $_SESSION['data']['firstName'] . ' ' . $_SESSION['data']['lastName'];
				$body = "Nuova richiesta di supporto ricevuta:\n\n";
				$body .= '- Name: ' . $_SESSION['data']['firstName'] . ' ' . $_SESSION['data']['lastName'] . "\n";
				$body .= '- Email: ' . $_SESSION['data']['email'] . "\n";
				$body .= '- Phone: ' . $_SESSION['data']['phone'] . "\n";
				$body .= '- Current Location: ' . $_SESSION['data']['currentLocation'] . "\n";
				$body .= '- Travel Destination: ' . $_SESSION['data']['travelDest'] . "\n";
				$body .= '- Travel Dates: ' . $_SESSION['data']['travelDates'] . "\n";
				$body .= '- Trip Length: ' . match($_SESSION['data']['tripLength']) {
												'1' => $translations['travel_length_weekend'],
												'2' => $translations['travel_length_short'],
												'3' => $translations['travel_length_2weeks'],
												'0' => $translations['travel_length_unsure'],
												default => ''
											  } . "\n";
				$body .= '- First Time: ' . $_SESSION['data']['firstTime'] . "\n";
				$body .= '- Travel Group: ' . match($_SESSION['data']['travelGroup']) {
												'solo' => $translations['travel_group_solo'],
												'couple' => $translations['travel_group_couple'],
												'friends' => $translations['travel_group_friends'] . " (" . $_SESSION['data']['groupSize'] . ")",
												'family_young' => $translations['travel_group_family_young'] . " (" . $_SESSION['data']['groupSize'] . ")",
												'family_teen' => $translations['travel_group_family_teen'] . " (" . $_SESSION['data']['groupSize'] . ")",
												'mixed' => $translations['travel_group_mixed'] . " (" . $_SESSION['data']['groupSize'] . ")",
												default => ''
											  } . "\n";
				$body .= '- Travel Budget: ' . $_SESSION['data']['travelBudget'] . "\n";
				$body .= '- Travel Pace: ' . $_SESSION['data']['pace'] . "\n";
				$body .= '- Travel Styles: ' . checked_labels_style($_SESSION['data'], 'travelStyle', $translations) . "\n";
				$body .= '- Logistics: ' . checked_labels_transport($_SESSION['data'], 'transport', $translations) . "\n";
				$body .= '- Accommodation: ' . checked_labels_accommodation($_SESSION['data'], 'accommodation', $translations) . "\n";
				$body .= '- Chronotype: ' . $_SESSION['data']['chronotype'] . "\n";
				$body .= '- Booking Style: ' . $_SESSION['data']['bookingStyle'] . "\n";
				$body .= '- Special Occasion: ' . $_SESSION['data']['specialOccasion'] . "\n";
				$body .= '- Accessibility: ' . $_SESSION['data']['accessibility'] . "\n";
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
				ca_funnel_log('travel', $i + 1, true);
				if (isset($_COOKIE['ca_resume_travel'])) {
					ca_draft_delete($_COOKIE['ca_resume_travel'], 'travel');
					setcookie('ca_resume_travel', '', [
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

	function checked_labels_style(array $data, string $key, array $translations): string {
		$labels = [];
		foreach ($data[$key] ?? [] as $code) {
			$labels[] = match ($code) {
				'slow' => $translations['travel_style_slow'],
				'mix' => $translations['travel_style_mix'],
				'food' => $translations['travel_style_food'],
				'active' => $translations['travel_style_active'],
				'art' => $translations['travel_style_art'],
				'offbeat' => $translations['travel_style_offbeat'],
				'comfort' => $translations['travel_style_comfort'],
				'nightlife' => $translations['travel_style_nightlife'],
				default => null,
			};
		}
		return implode('<br>', array_filter($labels));
	}

	function checked_labels_transport(array $data, string $key, array $translations): string {
		$labels = [];
		foreach ($data[$key] ?? [] as $code) {
			$labels[] = match ($code) {
				'car' => $translations['travel_transport_car'],
				'own_car' => $translations['travel_transport_own_car'],
				'public' => $translations['travel_transport_public'],
				'walking' => $translations['travel_transport_walking'],
				'rideshare' => $translations['travel_transport_rideshare'],
				'train' => $translations['travel_transport_train'],
				'flight' => $translations['travel_transport_flight'],
				'mix' => $translations['travel_transport_mix'],
				default => null,
			};
		}
		return implode('<br>', array_filter($labels));
	}

	function checked_labels_accommodation(array $data, string $key, array $translations): string {
		$labels = [];
		foreach ($data[$key] ?? [] as $code) {
			$labels[] = match ($code) {
				'hotels' => $translations['travel_accommodation_hotels'],
				'airbnb' => $translations['travel_accommodation_airbnb'],
				'boutique' => $translations['travel_accommodation_boutique'],
				'budget' => $translations['travel_accommodation_budget'],
				'glamping' => $translations['travel_accommodation_glamping'],
				'mix' => $translations['travel_accommodation_mix'],
				default => null,
			};
		}
		return implode('<br>', array_filter($labels));
	}

?>

<?php include 'head.php'; ?>

<script>
	document.querySelector('[name="travelGroup"]').addEventListener('change', function() {
		const needs = ['friends','family_young','family_teen','mixed'].includes(this.value);
		document.querySelector('[name="groupSize"]').closest('.intake-field').classList.toggle('intake-hidden', !needs);
	});
</script>

<?php include 'header.php'; ?>

<?php include '../assets/page/intake_travel/hero.php'; ?>

<?php include '../assets/page/intake_travel/intake_steps.php'; ?>
		
			<div class="intake-form-container">

<?php
	switch ($i) {
	  case 1: include('../assets/page/intake_travel/travel_1.php'); break;
	  case 2: include('../assets/page/intake_travel/travel_2.php'); break;
	  case 3: include('../assets/page/intake_travel/travel_3.php'); break;
	  case 4: include('../assets/page/intake_travel/travel_4.php'); break;
	  case 5: include('../assets/page/intake_travel/travel_5.php'); break;
	  default: break;
	}
?>

			</div>

<?php include 'footer.php'; ?>