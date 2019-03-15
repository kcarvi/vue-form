<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$name = $_POST['name'];
$phone = $_POST['phone'];

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host = 'smtp.yandex.ru';
    $mail->SMTPAuth = true;
    $mail->Username = 'mail@mail.com';
    $mail->Password = 'password';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('mail@mail.com', 'Mailer');
    $mail->addAddress('mail@mail.com');
    $mail->addReplyTo('mail@mail.com', 'Information');

    $mail->addAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);

    $mail->isHTML(true);
    $mail->Subject = 'subject';
    $mail->Body    = 'Name: ' . $name . '<br> Phone: ' . $phone;

    $mail->send();

    echo 'Message has been sent';

} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}