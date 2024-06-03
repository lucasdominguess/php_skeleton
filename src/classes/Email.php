<?php 
namespace App\classes;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


// require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
// require '../../vendor/phpmailer/phpmailer/src/SMTP.php';
// require '../../vendor/phpmailer/phpmailer/src/Exception.php';
 
class Email 
{ 

public function mandar_email($email,$token_url)
    {
        global $env ; 

        $mail = new PHPMailer(true);
        $username = $env['username'];
        $senha = $env['senha'];
        $smtp = $env['smtp'];
        $port = $env['port'];
        $sender = $env['sender'];
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $smtp ; //'sandbox.smtp.mailtrap.io'; //$smtp;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;  //prodam = false                                 //Enable SMTP authentication
            $mail->Username   =  $username; //'f73cef0376c9d3';  //;                     //SMTP username
            $mail->Password   = $senha;                               //SMTP password
            $mail->SMTPSecure = false;            //Enable implicit TLS encryption
            $mail->SMTPAutoTLS = false;
            $mail->Port  =    $port;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS
        
            //Recipients
            $mail->setFrom($sender, 'teste');
            // $mail->addAddress('lucasdomingues@prefeitura.sp.gov.br', 'Joe User');     //Add a recipient
            $mail->addAddress('lucasdomingues25.dev@gmail.com', 'Admin Lucas');     //Add a recipient
            /*
             *$mail->addAddress('ellen@example.com');               //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');
        
            //Attachments
            $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name 
             */
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Alteracao de senha Solicitada';
            $mail->Body    = "para seguir com a alteracao click no link : <a href='http://localhost:9000/validar_tokenuser?token=$token_url&email=$email'>alterar Senha</a>";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->CharSet ='UTF-8';
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}
// $e = new Email ; 
// $e->mandar_email();