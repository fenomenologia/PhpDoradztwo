<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

session_start();

$email = $_SESSION['new_email'];
$pass = $_SESSION['new_pass'];
$kogoDodac = $_SESSION['kogo_dodac'];

unset($_SESSION['new_email'], $_SESSION['new_pass'], $_SESSION['kogo_dodac']);

$mail = new PHPMailer(true);

if ($kogoDodac == 'klient')
{
	try
	{
		// Konfiguracja serwera SMTP
		$mail->isSMTP();
		$mail->Host = 'szkolaprogramowania.cybertree.pl';             // np. smtp.gmail.com, smtp.home.pl
		$mail->SMTPAuth = true;
		$mail->Username = 'doradztwo@szkolaprogramowania.cybertree.pl';
		$mail->Password = ']7*EPA6?e-oU';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS (bezpieczne szyfrowanie)
		$mail->Port = 587;

		// Debug (opcjonalnie, tylko do testów)
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

		// Nadawca i odbiorca
		$mail->setFrom('doradztwo@szkolaprogramowania.cybertree.pl', 'Doradztwo Zawodowe');
		$mail->addAddress($email);

		// Treść wiadomości
		$mail->isHTML(true);
		$mail->CharSet = 'UTF-8';
		$mail->Subject = "Twoje konto zostało utworzone - IBCU";
		$mail->Body = "<html>
							<head>
								<meta charset='UTF-8'>
								<title>Witamy w serwisie doradztwa IBCU!</title>
							</head>
							<body>
								<p>Witaj,</p>
								<p>Twoje konto w systemie doradztw IBCU zostało utworzone.</p>
								<p><strong>Login:</strong> $email<br>
								<strong>Hasło tymczasowe:</strong> $pass</p>
								<p>Zaloguj się do systemu i zmień hasło przy pierwszym logowaniu.</p>
								<p><a href='http://localhost:48069/index.php'>Zaloguj się tutaj</a></p>
								<br>
								<p>Pozdrawiamy,<br>Zespół IBCU</p>
							</body>
						</html>";
		$mail->AltBody = "Witaj,

			Twoje konto w systemie doradztwa IBCU zostało utworzone.

			Login: $email
			Hasło tymczasowe: $pass

			Zaloguj się do systemu i zmień hasło przy pierwszym logowaniu.

			Link do logowania: http://localhost:48069/index.php

			Pozdrawiamy,
			Zespół IBCU";

		// Wyślij
		$mail->send();
		$_SESSION['dodano'] = true;
		header("Location: dodaj_klienta.php");
		exit();
	}
	catch (Exception $e)
	{
		$_SESSION['mailError'] = $mail->ErrorInfo;
		header("Location: dodaj_klienta.php");
		exit();
	}
}
else if ($kogoDodac == 'doradca')
{
	try
	{
		// Konfiguracja serwera SMTP
		$mail->isSMTP();
		$mail->Host = 'szkolaprogramowania.cybertree.pl';             // np. smtp.gmail.com, smtp.home.pl
		$mail->SMTPAuth = true;
		$mail->Username = 'doradztwo@szkolaprogramowania.cybertree.pl';
		$mail->Password = ']7*EPA6?e-oU';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS (bezpieczne szyfrowanie)
		$mail->Port = 587;

		// Debug (opcjonalnie, tylko do testów)
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

		// Nadawca i odbiorca
		$mail->setFrom('doradztwo@szkolaprogramowania.cybertree.pl', 'Doradztwo Zawodowe');
		$mail->addAddress($email);

		// Treść wiadomości
		$mail->isHTML(true);
		$mail->CharSet = 'UTF-8';
		$mail->Subject = "Twoje konto zostało utworzone - IBCU";
		$mail->Body = "<html>
							<head>
								<meta charset='UTF-8'>
								<title>Witamy w serwisie doradztwa IBCU!</title>
							</head>
							<body>
								<p>Witaj,</p>
								<p>Twoje konto doradcy w systemie doradztw IBCU zostało utworzone.</p>
								<p><strong>Login:</strong> $email<br>
								<strong>Hasło tymczasowe:</strong> $pass</p>
								<p>Zaloguj się do systemu i zmień hasło przy pierwszym logowaniu.</p>
								<p><a href='http://localhost:48069/index.php'>Zaloguj się tutaj</a></p>
								<br>
								<p>Pozdrawiamy,<br>Zespół IBCU</p>
							</body>
						</html>";
		$mail->AltBody = "Witaj,

			Twoje konto doradcy w systemie doradztwa IBCU zostało utworzone.

			Login: $email
			Hasło tymczasowe: $pass

			Zaloguj się do systemu i zmień hasło przy pierwszym logowaniu.

			Link do logowania: http://localhost:48069/index.php

			Pozdrawiamy,
			Zespół IBCU";

		// Wyślij
		$mail->send();
		$_SESSION['dodano'] = true;
		header("Location: admin_doradcy.php");
		exit();
	}
	catch (Exception $e)
	{
		$_SESSION['mailError'] = $mail->ErrorInfo;
		header("Location: admin_doradcy.php");
		exit();
	}
}
?>


