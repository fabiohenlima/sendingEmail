<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

sendingEmail();

function sendingEmail()
{
    echo "*****************************************************************\n";
    echo "* Bem vindo(a) ao envia de E-mails de Fábio Henrique Silva Lima *\n"; 
    echo "*****************************************************************\n";
    
    $to = readline("Qual o E-mail do Destinatário:");
    $name = readline("Qual o Nome do Remetente:");
    $subject = readline("Qual o Assunto do E-mail:");
    $text = readline("Qual o Texto do E-mail:");
    $confirm = readline("Quer mesmo enviar o E-mail {$subject} para {$to} (Y/N):");

}

?>