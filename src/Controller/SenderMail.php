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
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail.bertil.re';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'dueliste_reunion@msn.com';                     //SMTP username
        $mail->Password   = 'sdzy mbnm vihx pasy';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('zooj384@gmail.com', 'joseZoo');
        $mail->addAddress($email , '');     //Add a recipient
        $mail->addReplyTo('zooj384@gmail.com', 'joseZoo');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        //$mail->msgHTML($description ,__DIR__);
        $mail->Body    = $message;
        //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $this->mailer = $mail;

    }

}