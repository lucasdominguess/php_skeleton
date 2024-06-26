<?php 
namespace App\Application\Actions\User\controlers\alterar_senha;

// require '../../../../../vendor/phpmailer/src/SMTP.php';
// require '../../vendor/phpmailer/phpmailer/src/SMTP.php';
// require '../../vendor/phpmailer/phpmailer/src/Exception.php';
// require '../../../../classes/Email.php';

// use App\classes\Email;


use App\Infrastructure\Persistence\User\CreateRepository;
use DateTime;

use voku\helper\AntiXSS;
use App\Application\Actions\Action;

use Psr\Http\Message\ResponseInterface as response;
use App\Infrastructure\Persistence\User\ReadRepository;

use function App\classes\verificarFila;

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

        if(!$user){ //mensagem caso o usuario nao exista ... correção de segurança (mentir para um suposto atacante )
            $msg = ['status'=> 'fail', 'msg'=>'Email enviado'];
            return $this->respondWithData($msg);
        }
        
        // $token = password_hash($email, PASSWORD_DEFAULT);
        $token = md5(uniqid());
        

    
        // Helpers::dd($token_url);
        // $decoded = urldecode($token_url); 

       
        $date = new DateTime(); 
        $date->modify("+10 minutes");
        $newdata =$date->format("Y-m-d H:i:s");
        
        $insert = new CreateRepository($this->sql);
        $insert->createResetSenha($newdata,$email,$token);
        // var_dump($date);
        
       
        $dados = json_encode(
            [
                'email'=>$email, 
                'token'=>$token,
                'subject'=>"Confirmação de email",
                'body'=>" <h3> Alteração de senha solicitada , caso desconheça essa solicitação desconsidere este email <br> 
             para seguir com sua solicitaçao Por favor  click no link e a seguir:  <a href='http://localhost:9000/validar_tokenuser/$token'>alterar Senha</a></h3>" 
            ]);
        // }
        try {
            //criando fila no redis 
                   
            $this->redisConn->rPush('enviar_email',$dados);
            $msg = ['status'=> 'ok', 'msg'=>'Email enviado!'];
            return $this->respondWithData($msg);
        } catch (\Throwable $th) {
            $msg = ['status'=> 'fail', 'msg'=>'Não foi possivel enviar email!'];
                return $this->respondWithData($msg);
        }


    }
}