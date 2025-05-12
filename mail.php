<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$mail = new PHPMailer(true);

try {
    // Konfiguracja serwera SMTP
    $mail->isSMTP();
    $mail->Host       = 'szkolaprogramowania.cybertree.pl';             // np. smtp.gmail.com, smtp.home.pl
    $mail->SMTPAuth   = true;
    $mail->Username = 'doradztwo@szkolaprogramowania.cybertree.pl';
    $mail->Password = ']7*EPA6?e-oU';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS (bezpieczne szyfrowanie)
    $mail->Port       = 587;

    // Debug (opcjonalnie, tylko do testów)
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    // Nadawca i odbiorca
    $mail->setFrom('doradztwo@szkolaprogramowania.cybertree.pl', 'Doradztwo Zawodowe');
    $mail->addAddress('wiadomosc@mailinator.com', 'Maciej');

    // Treœæ wiadomoœci
    $mail->isHTML(true);
    $mail->Subject = 'Testowa wiadomoœæ';
    $mail->Body    = '<b>To jest testowa wiadomoœæ</b> wys³ana przez PHPMailer.';
    $mail->AltBody = 'To jest testowa wiadomoœæ wys³ana przez PHPMailer (tekst prosty).';

    // Wyœlij
    $mail->send();
    echo 'Wiadomoœæ zosta³a wys³ana.';
} catch (Exception $e) {
    echo "B³¹d przy wysy³aniu: {$mail->ErrorInfo}";
}
?>


