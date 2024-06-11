<?php 
namespace App\Application\Actions\User\controlers\cadastrar_usuario;
use Sql;
use DateTime;

use voku\helper\AntiXSS;
use Monolog\Handler\IFTTTHandler;
use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as response;
use App\Infrastructure\Persistence\User\ReadRepository;
use App\Infrastructure\Persistence\User\CreateRepository;

class VerifyNewUserAction extends Action 
{
    protected function action(): response 
    {   
        $xss = new AntiXSS(); 

        $name = $xss->xss_clean($_POST['name']) ?? null;
        $email = $xss->xss_clean($_POST['new-email']) ?? null;
        $senha1 = $xss->xss_clean($_POST['senha']) ?? null;
        $senha2 = $xss->xss_clean($_POST['confir-senha']) ?? null;
        // $pattern = "/^([a-zàáâãçèéêìíîòóôõùúû'_.]{4,}@[\w]{5,10}\.(sp|com)(.gov)?(.br)?|root)$/im";
       
        if($senha1 == null || $senha2 == null  || $email == null ){ 
            
            $msg = ['status'=> 'fail', 'msg'=>'Preencha todos os campos '];
            return $this->respondWithData($msg); 
        }
        // if(!preg_match($pattern,$email)){
                
        //     $msg = ['status'=> 'fail', 'msg'=>'email invalido'];
        //     return $this->respondWithData($msg); 
        // }

        if ($senha1 != $senha2){ 
            $msg = ['status'=> 'fail', 'msg'=>'As senhas nao são iguais'];
            return $this->respondWithData($msg); 
        }

        $user = new ReadRepository($this->sql);
        $newemail = $user->admFindEmail($email);

        if ($newemail) {
            $msg = ['status'=> 'fail', 'msg'=>'Email ja existe ou invalido👍'];
            return $this->respondWithData($msg); 
        }

        $token = md5(uniqid());
        $dados = json_encode(
        [
            'email'=>$email, 
            'token'=>$token,
            'subject'=>"Confirmação de email",
            'body'=>"<h3> Um registro de cadastro foi solicitado para este email ,caso não seja voçê desconsidere ete Email <br> 
             para seguir com sua solicitaçao Por favor  click no link e a seguir:  <a href='http://localhost:9000/verificar_email_enviado/$token'>Confirmar cadastro</a></h3>"
        ]);
          
      
        
        try {
           $this->redisConn->hset($token,'name',$name);
           $this->redisConn->hset($token,'email',$email);
           $this->redisConn->hset($token,'senha',$senha1);
           $this->redisConn->expire($token,1000);
     
          
           $this->redisConn->rPush('enviar_email',$dados);




            $msg = ['status'=> 'ok', 'msg'=>'Email enviado , confirme seu email!'];
            return $this->respondWithData($msg);
        } catch (\Throwable $th) {
            $msg = ['status'=> 'fail', 'msg'=>'Não foi possivel enviar email!'];
                return $this->respondWithData($msg);
        }
    }
}