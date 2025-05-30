<?php

namespace Berti\Porfolio\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class SenderMail
{
    private $mailer;
    public function __construct(string $email, string $subject, string $message){


        $mail = new PHPMailer(true);
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        //Enable verbose debug output SMTP::DEBUG_OFF
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $_ENV['SMTP_HOST'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                //Enable SMTP authentication
        $mail->Username   = $_ENV['SMTP_USER'];                     //SMTP username
        $mail->Password   = $_ENV['SMTP_PASSWORD'];                               //SMTP password
        $mail->SMTPSecure = 'ssl';
        //Enable implicit TLS encryption
        $mail->Port       = $_ENV['SMTP_PORT'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('contact@bertil.re', 'contact');
        $mail->addAddress($email , '');     //Add a recipient
        $mail->addReplyTo('contact@bertil.re', 'contact');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        //$mail->msgHTML($description ,__DIR__);
        $mail->Body    = $message;
        //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $this->mailer = $mail;

    }
    public function envoyer():bool
    {
        return  $this->mailer->send();
    }

}