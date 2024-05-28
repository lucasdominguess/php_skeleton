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

public function mandar_email()
    {

        
        $mail = new PHPMailer(true);
        $login = 'admin';
        $senha = '';
        $smtp = 'smtpcorp.prodam';
        $port = 25;
        $sender = 'smsdtic@prefeitura.sp.gov.br';
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $smtp;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = false;                                   //Enable SMTP authentication
            $mail->Username   = $login;                     //SMTP username
            $mail->Password   = $senha;                               //SMTP password
            $mail->SMTPSecure = false;            //Enable implicit TLS encryption
            $mail->SMTPAutoTLS = false;
            $mail->Port       = $port;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS
        
            //Recipients
            $mail->setFrom($sender, 'LUCAS');
            // $mail->addAddress('lucasdomingues@prefeitura.sp.gov.br', 'Joe User');     //Add a recipient
            $mail->addAddress('lucasdomingues25.dev@gmail.com', 'Joe User');     //Add a recipient
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
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'teste teste <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}
// $e = new Email ; 
// $e->mandar_email();