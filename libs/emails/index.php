<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

class EmailSender
{
    private $sender = "alwasit.real.estate@gmail.com";
    private $receiver;
    private $body;
    private $subject;

    public function __construct($receiver, $subject,  $body)
    {
        $this->subject = $subject;
        $this->receiver = $receiver;
        $this->body = $body;
    }

    public function sendEmail()
    {
        // Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP(); // Send using SMTP
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'alwasit.real.estate@gmail.com'; // SMTP username
            $mail->Password = 'jbolapzdxepuwnet'; // SMTP password
            $mail->Port = 587; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Recipients
            $mail->setFrom($this->sender, 'Alwasit');
            $mail->addAddress($this->receiver); // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            $mail->CharSet = 'UTF-8'; // Set the character encoding to UTF-8
            $mail->setLanguage('ar', 'path/to/PHPMailer/language/'); // Set the language to Arabic

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $this->subject;
            $mail->Body = $this->body;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
        } catch (Exception $e) {
                
        }
    }
}

