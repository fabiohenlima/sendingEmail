<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

sendingEmail();

function sendingEmail()
{
    echo "********************************************************************\n";
    echo "*  Bem vindo(a) ao envia de E-mails de Fábio Henrique Silva Lima   *\n"; 
    echo "*------------------------------------------------------------------*\n";
    
    $to = readline("* Qual o E-mail do Destinatário:");
    $name = readline("* Qual o Nome do Remetente:");
    $subject = readline("* Qual o Assunto do E-mail:");
    $text = readline("* Qual o Texto do E-mail:");
    $attachments = readline("* Diretório de Anexo:");
    $confirm = readline("* Quer mesmo enviar o E-mail {$subject} para {$to} (Y/N):");
    echo "********************************************************************\n";
    echo "\n";

    $confirm = validateData($to,$name,$subject,$text,$confirm);

    if($confirm == "y" || $confirm == "Y" || $confirm == "yeas" || $confirm == "YEAS")
    {
        sendEmail($to,$name,$subject,$text,$attachments);
    }
}


function validateData($to,$name,$subject,$text,$confirm)
{
    $errors = [];
    if(!valid_email($to)) $errors[] = "* E-mail inválido                                                  *\n";
    if (empty($name)) $errors[] = "* Nome do Remetente está inválido                                  *\n";
    if (empty($subject)) $errors[] = "* Assunnto do E-mail está inválido                                 *\n";
    if (empty($text)) $errors[] = "* Texto do está inválido                                           *\n";
    if ($confirm == 'n' || $confirm == 'N' || empty($confirm)) $errors[] = "* Processo cancelado                                               *\n";
    echo  $confirm;
    if (!empty($errors)) {

        echo "********************************************************************\n";
        echo "* Error :( Atenção Repita Todo Processo Novamente com Mais Atenção *\n"; 
        echo "*------------------------------------------------------------------*\n";
        foreach($errors as $error) {
            echo $error;
        }
        echo "********************************************************************\n";        
        echo "\n";

        exit;
    }

    return $confirm;
}

function valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function sendEmail($to,$name,$subject,$text,$attachments)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'email@exemple';                     //SMTP username
        $mail->Password   = 'secret';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('fabiohenlima@gmail.com', $name);
        $mail->addAddress($to, 'Joe User');   
        // home/fabiolima/Pictures/fut.jpeg
        if(!empty($attachments)) {
            $mail->addAttachment($attachments);    
        }
            
        $mail->Subject = $subject;
        $mail->Body    = $text;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo "********************************************************************\n";
        echo "*                E-mail Enviado com Sucessso :)                    *\n"; 
        echo "********************************************************************\n";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>