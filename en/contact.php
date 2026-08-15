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
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$action = $_POST['action'] ?? 'next';

		if ($i === 1) {
			$fields = ['firstName', 'lastName', 'email', 'phone', 'currentLocation', 'message'];
		}
		
		foreach ($fields as $field) {
			if (isset($_POST[$field])) {
				$_SESSION['data'][$field] = trim($_POST[$field]);
			}
		}
		
		if ($action === 'submit') {
			
			if (empty($_POST['website'])) {
				$to = 'companionaway@altervista.org';
				$subject = 'Companion Away - New Relocation: ' . $_SESSION['data']['firstName'] . ' ' . $_SESSION['data']['lastName'];
				$body = "New intake request received:\n\n";
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
					'Cc: giulia.carla20@gmail.com' . "\r\n" .
					'Content-Type: text/plain; charset=UTF-8';
				$sent = mail($to, $subject, $body, $headers);
			}
			
			if ($sent) {
				unset($_SESSION['data']);
				header('Location: ' . $currentPage . '?step=' . ($i+1));
				exit;
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