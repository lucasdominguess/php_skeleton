<?php 
namespace App\Application\Actions\User\controlers;

// require '../../../../../vendor/phpmailer/src/SMTP.php';
// require '../../vendor/phpmailer/phpmailer/src/SMTP.php';
// require '../../vendor/phpmailer/phpmailer/src/Exception.php';
// require '../../../../classes/Email.php';

// use App\classes\Email;

use App\Infrastructure\Persistence\User\CreateRepository;
use DateTime;
use App\classes\Email;
use voku\helper\AntiXSS;
use App\Application\Actions\Action;
use App\classes\SendEmail;
use App\Infrastructure\Helpers;
use Psr\Http\Message\ResponseInterface as response;
use App\Infrastructure\Persistence\User\ReadRepository;

class ValidUserAction extends Action 
{
    public function action(): response 
    {   
       
        $xss = new AntiXSS(); 

        $email = $xss->xss_clean($_POST['rec-email']) ?? null;

        if ($email == null){ 
            $msg = ['status'=> 'fail', 'msg'=>'o campo email nao pode estar em branco!'];
            return $this->respondWithData($msg);
        }

        $banco = new ReadRepository($this->sql); 
        $user= $banco->admFindEmail($email);

        if(!$user){
            $msg = ['status'=> 'fail', 'msg'=>'serviço indisponivel'];
            return $this->respondWithData($msg);
        }
        
        // $token = password_hash($email, PASSWORD_DEFAULT);
        $token = md5(uniqid());

        // $token_url = urlencode($token);
        // Helpers::dd($token_url);
        // $decoded = urldecode($token_url); 

       
        $date = new DateTime(); 
        $date->modify("+10 minutes");
        $newdata =$date->format("Y-m-d H:i:s");
        
        $insert = new CreateRepository($this->sql);
        $insert->createResetSenha($newdata,$email,$token);
        // var_dump($date);
     

        // try {
            
        //     $e = new Email;
        //     $e->mandar_email($email,$token);
        //     $msg = ['status'=> 'ok', 'msg'=>'Email enviado com sucesso!'];
        //     return $this->respondWithData($msg);
        // } catch (\Throwable $th) {
        //     $msg = ['status'=> 'fail', 'msg'=>'Não foi possivel enviar email!'];
        //     return $this->respondWithData($msg);
        // }
        try {
            // $sendEmail = new SendEmail();
            // $sendEmail->fila("enviar_email",$email);

            $this->redisConn->rPush('enviar_email',$email);
        } catch (\Throwable $th) {
            $msg = ['status'=> 'fail', 'msg'=>'Não foi possivel enviar email!'];
                return $this->respondWithData($msg);
        }


    }
}