<?php

namespace Berti\Porfolio\Controller;

use mysql_xdevapi\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class SenderMail
{
    private $mailer;
    private string $messageReponse;
    public function __construct(){

        $mail = new PHPMailer(true);
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        //Enable verbose debug output SMTP::DEBUG_OFF,SMTP::DEBUG_SERVER
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $_ENV['SMTP_HOST'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                //Enable SMTP authentication
        $mail->Username   = $_ENV['SMTP_USER'];                     //SMTP username
        $mail->Password   = $_ENV['SMTP_PASSWORD'];                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        //Enable implicit TLS encryption
        $mail->Port       = (int) $_ENV['SMTP_PORT'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // enleve la verification SSL
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        // *** CONFIGURATION IMPORTANTE POUR UTF-8 ***
        $mail->CharSet = 'UTF-8';                    // Encodage des caractères
        $mail->Encoding = 'base64';                  // Encodage du message (optionnel mais recommandé)
        $mail->setLanguage('fr', 'vendor/phpmailer/phpmailer/language/'); // Langue française
        $this->mailer = $mail;

    }
    public function envoyer():bool
    {
        return  $this->mailer->send();
    }
    public function setEmail(string $email, string $subject, string $message, string $name){

        $mail= $this->mailer;
        //Recipients
        $mail->setFrom('contact@bertil.re', "Portefolio contact de $name");// celui qui envois le message
        $mail->addAddress('contact@bertil.re' , $name);     // ceux qui recois le message
        $mail->addReplyTo( $email, $name); // vers qui repondre au message envoyer

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        //$mail->msgHTML($description ,__DIR__);
        $mail->Body    = $message;
        //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $this->mailer = $mail;
    }
    public function setNoReply(string $email, string $name , string $subject){

        $mail= $this->mailer;
        //Recipients
        $mail->setFrom('contact@bertil.re', "bertil louigy");// celui qui envois le message
        $mail->addAddress($email , $name);     // ceux qui recois le message
        $mail->addReplyTo( 'contact@bertil.re' , 'bertil louigy'); // vers qui repondre au message envoyer

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Re : $subject";
        //$mail->msgHTML($description ,__DIR__);
        $mail->Body    = $this->MessageReponse($email, $name ,$subject);
        //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $this->mailer = $mail;
    }
    private function MessageReponse(string $email ,string $name ,string $subject):string
    {
        $date = date('d/ m/ Y');
        return $this->messageReponse =<<<HTML
       
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Réponse Email</title>
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }
        
                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    line-height: 1.6;
                    color: #333;
                    background-color: #f5f5f5;
                    padding: 20px;
                }
        
                .email-container {
                    max-width: 700px;
                    margin: 0 auto;
                    background: white;
                    border-radius: 10px;
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                    overflow: hidden;
                }
        
                .email-header {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    padding: 25px;
                    text-align: center;
                }
        
                .email-header h1 {
                    font-size: 24px;
                    font-weight: 300;
                    margin-bottom: 5px;
                }
        
                .email-meta {
                    background-color: #f8f9fa;
                    padding: 15px 25px;
                    border-bottom: 1px solid #e9ecef;
                }
        
                .meta-row {
                    display: flex;
                    margin-bottom: 8px;
                    align-items: center;
                }
        
                .meta-row:last-child {
                    margin-bottom: 0;
                }
        
                .meta-label {
                    font-weight: 600;
                    color: #495057;
                    min-width: 80px;
                    font-size: 14px;
                }
        
                .meta-value {
                    color: #6c757d;
                    font-size: 14px;
                }
        
                .email-content {
                    padding: 30px 25px;
                }
        
                .greeting {
                    font-size: 16px;
                    margin-bottom: 20px;
                    color: #495057;
                }
        
                .message-body {
                    font-size: 15px;
                    line-height: 1.7;
                    margin-bottom: 25px;
                    text-align: justify;
                }
        
                .message-body p {
                    margin-bottom: 15px;
                }
        
                .signature {
                    border-top: 2px solid #e9ecef;
                    padding-top: 20px;
                    margin-top: 30px;
                }
        
                .signature-name {
                    font-weight: 600;
                    font-size: 16px;
                    color: #495057;
                    margin-bottom: 5px;
                }
        
                .signature-title {
                    color: #6c757d;
                    font-size: 14px;
                    margin-bottom: 10px;
                }
        
                .signature-contact {
                    font-size: 13px;
                    color: #868e96;
                    line-height: 1.4;
                }
        
                .highlight {
                    background-color: #fff3cd;
                    padding: 15px;
                    border-left: 4px solid #ffc107;
                    margin: 20px 0;
                    border-radius: 0 5px 5px 0;
                }
        
                .footer {
                    background-color: #f8f9fa;
                    padding: 15px 25px;
                    text-align: center;
                    font-size: 12px;
                    color: #868e96;
                    border-top: 1px solid #e9ecef;
                }
        
                @media (max-width: 600px) {
                    body {
                        padding: 10px;
                    }
                    
                    .email-container {
                        border-radius: 5px;
                    }
                    
                    .email-header, .email-content {
                        padding: 20px 15px;
                    }
                    
                    .meta-row {
                        flex-direction: column;
                        align-items: flex-start;
                    }
                    
                    .meta-label {
                        margin-bottom: 2px;
                    }
                }
            </style>
        </head>
        <body>
            <div class="email-container">
                <!-- En-tête de l'email -->
                <div class="email-header">
                    <h1>Réponse à votre message</h1>
                    <p>Merci pour votre contact</p>
                </div>
        
                <!-- Métadonnées de l'email -->
                <div class="email-meta">
                    <div class="meta-row">
                        <span class="meta-label">De :</span>
                        <span class="meta-value">contact@bertil.re</span>
                    </div>
                    <div class="meta-row">
                        <span class="meta-label">À :</span>
                        <span class="meta-value">$email</span>
                    </div>
                    <div class="meta-row">
                        <span class="meta-label">Objet :</span>
                        <span class="meta-value">Re: $subject</span>
                    </div>
                    <div class="meta-row">
                        <span class="meta-label">Date :</span>
                        <span class="meta-value" id="current-date">$date</span>
                    </div>
                </div>
        
                <!-- Contenu principal -->
                <div class="email-content">
                    <div class="greeting">
                        Bonjour $name,
                    </div>
        
                    <div class="message-body">
                        <p>Je vous remercie pour votre message concernant $subject.</p>
                        
                        <p>J'ai bien pris connaissance de votre demande et je suis ravi de pouvoir vous apporter une réponse.</p>
        
                        <!-- Zone de contenu personnalisable -->
                        <div class="highlight">
                            <strong>N'hésitez pas</strong> à me recontacter si vous avez besoin d'apporter des précisions supplémentaires ou si vous souhaitez aborder d'autres points.
                        </div>

                    </div>
                    <!-- Signature -->
                    <div class="signature">
                        <div class="signature-name">Bertil Louigy</div>
                        <div class="signature-title">Developpeur web & web Mobile</div>
                        <div class="signature-contact">
                            Email : contact@bertil.re<br>
                            Site web : <a href="https://www.betil.re" target="_blank">Portfolio</a>
                        </div>
                    </div>
                </div>
        
                <!-- Pied de page -->
                <div class="footer">
                    Ce message est confidentiel. Si vous l'avez reçu par erreur, merci de le supprimer.
                </div>
            </div>
        </body>
        </html>
HTML;
    }


}