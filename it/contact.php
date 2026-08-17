<?php
	$lang = basename(__DIR__);
	$currentPage = basename(__FILE__);
	
	$langJson = file_get_contents('contact/lang.json');
	$translations = json_decode($langJson, true);

	$pageStylesheet = '/assets/css/intake-style.min.css';
?>

<?

	session_start();

	$i = isset($_GET['step']) ? (int) $_GET['step'] : 1;
	$submissionError = false;
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$action = $_POST['action'] ?? 'next';

		if ($i === 1) {
			$fields = ['firstName', 'lastName', 'email', 'phone', 'currentLocation', 'message'];
		} else {
			$fields = [];
		}
		
		foreach ($fields as $field) {
			if (isset($_POST[$field])) {
				$_SESSION['data'][$field] = trim($_POST[$field]);
			}
		}
		
		if ($action === 'submit') {

			if (empty($_POST['website'])) {

				$firstName = $_SESSION['data']['firstName'] ?? '';
				$lastName = $_SESSION['data']['lastName'] ?? '';
				$email = $_SESSION['data']['email'] ?? '';
				$phone = $_SESSION['data']['phone'] ?? '';
				$currentLocation = $_SESSION['data']['currentLocation'] ?? '';
				$message = $_SESSION['data']['message'] ?? '';

				$dbSaved = false;
				$type = 'contact';
				$data = json_encode([
					'firstName' => $firstName,
					'lastName' => $lastName,
					'email' => $email,
					'phone' => $phone,
					'currentLocation' => $currentLocation,
					'message' => $message,
				]);

				require_once __DIR__ . '/../private/config.php';

				$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
				if ($db) {
					$db->set_charset('utf8mb4');
					$stmt = $db->prepare('INSERT INTO intake_submission (type, data) VALUES (?, ?)');
					if ($stmt) {
						$stmt->bind_param('ss', $type, $data);
						$dbSaved = $stmt->execute();
						$stmt->close();
					}
				}

				$to = 'companionaway@altervista.org';
				$subject = 'Companion Away - Nuovo Messaggio di Contatto: ' . $firstName . ' ' . $lastName;
				$body = "Nuovo messaggio dal modulo di contatto ricevuto:\n\n";
				$body .= '- Name: ' . $firstName . ' ' . $lastName . "\n";
				$body .= '- Email: ' . $email . "\n";
				$body .= '- Phone: ' . $phone . "\n";
				$body .= '- Current Location: ' . $currentLocation . "\n";
				$body .= '- Message: ' . $message . "\n";
				$headers = 'From: companionaway@altervista.org' . "\r\n" .
					'Reply-To: ' . $email . "\r\n" .
					'Cc: giulia.carla20@gmail.com' . "\r\n" .
					'Content-Type: text/plain; charset=UTF-8';
				$mailSent = @mail($to, $subject, $body, $headers);

				if ($db) {
					if ($dbSaved && $mailSent) {
						$db->query('UPDATE intake_submission SET mail_sent = 1 WHERE id = ' . $db->insert_id);
					}
					$db->close();
				}

				if ($dbSaved || $mailSent) {
					unset($_SESSION['data']);
					header('Location: ' . $currentPage . '?step=' . ($i+1));
					exit;
				} else {
					$submissionError = true;
				}
			}
		}
		
	}
?>

<?php include 'head.php'; ?>

<?php include 'header.php'; ?>

<?php include '../assets/page/contact/hero.php'; ?>
	
			<div class="intake-form-container">

<?php
	switch ($i) {
	  case 1: include('../assets/page/contact/intake_1.php'); break;
	  case 2: include('../assets/page/contact/intake_2.php'); break;
	  default: break;
	}
?>

			</div>

<?php include 'footer.php'; ?>
