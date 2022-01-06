<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

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
    $confirm = readline("* Quer mesmo enviar o E-mail {$subject} para {$to} (Y/N):");
    echo "********************************************************************\n";
    echo "\n";

    validateData($to,$name,$subject,$text,$confirm);
}


function validateData($to,$name,$subject,$text,$confirm)
{
    $errors = [];
    if(!valid_email($to)) $errors[] = "* E-mail inválido                                                  *\n";
    if (preg_match("/^([a-zA-Z' ]+)$/",$name) || empty($name)) $errors[] = "* Nome do Remetente está inválido                                  *\n";
    if (preg_match("/^([a-zA-Z' ]+)$/",$subject) || empty($subject)) $errors[] = "* Assunnto do E-mail está inválido                                 *\n";
    if (preg_match("/^([a-zA-Z' ]+)$/",$text) || empty($text)) $errors[] = "* Texto do está inválido                                           *\n";
    if ($confirm == "n" || $confirm = "N") $errors[] = "* Processo cancelado                                               *\n";

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

    return true;
}

function valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function sendEmail()
{
    
}
?>