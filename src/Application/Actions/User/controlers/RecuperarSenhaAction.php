<?php 
namespace App\Application\Actions\User\controlers;

// require '../../../../../vendor/phpmailer/src/SMTP.php';
// require '../../vendor/phpmailer/phpmailer/src/SMTP.php';
// require '../../vendor/phpmailer/phpmailer/src/Exception.php';
// require '../../../../classes/Email.php';

// use App\classes\Email;

use DateTime;
use App\classes\Email;
use voku\helper\AntiXSS;
use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as response;
use App\Infrastructure\Persistence\User\ReadRepository;

class RecuperarSenhaAction extends Action 
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

        $token = password_hash($email, PASSWORD_DEFAULT);

        $date = new DateTime(); 
        $date->modify("+5 minutes");
        $newdata =$date->format("Y-m-d H:i:s");
        
        
        // var_dump($date);
     

        try {
            
            $e = new Email;
            $e->mandar_email($email,$token);
            $msg = ['status'=> 'ok', 'msg'=>'Email enviado com sucesso!'];
            return $this->respondWithData($msg);
        } catch (\Throwable $th) {
            $msg = ['status'=> 'fail', 'msg'=>'Não foi possivel enviar email!'];
            return $this->respondWithData($msg);
        }


    }
}