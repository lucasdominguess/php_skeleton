<?php
namespace App\Application\Actions\User\controlers;

use DateTime;
use voku\helper\AntiXSS; 
use App\Infrastructure\Helpers;
use App\Application\Actions\Action;
use App\Infrastructure\Persistence\User\CreateRepository;
use Psr\Http\Message\ResponseInterface as response ;
use App\Infrastructure\Persistence\User\ReadRepository;

class ValidPassAction extends Action 
{
    public function action(): Response
    {   
        $xss = new AntiXSS();
 
        $senha1 = $xss->xss_clean($_POST['senha1']) ?? null ; 
        $senha2 = $xss->xss_clean($_POST['senha2']) ?? null ; 
        $token = $xss->xss_clean($_POST['token']) ?? null ; 
        $pattern = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#_])[0-9a-zA-Z$*&@#_]{8,19}/';
        // $data = $this->request->getParsedBody();
   
        
        if($senha1 == null || $senha2 == null  ){ 
            
            $msg = ['status'=> 'fail', 'msg'=>'os campos senhas nao podem estar vazios'];
            return $this->respondWithData($msg); 
        }
        if (!preg_match($pattern,($senha1||$senha2))){ 
            $msg = ['status'=> 'fail', 'msg'=>'A senha nao atende o padrao especificado'];
            return $this->respondWithData($msg); 
        }


        if ($senha1 != $senha2){ 
            $msg = ['status'=> 'fail', 'msg'=>'As senhas nao são iguais'];
            return $this->respondWithData($msg); 
        }
        if ($token == null) {
            return $this->response->withHeader("location","/")->withStatus(302);
        }
        
        $user = new ReadRepository($this->sql); 
        
        $tokenbd =  $user->resetFindAllEmail($token);

        if(!$tokenbd){

            $msg = ['status'=> 'fail', 'msg'=>"Token Invalido!",'location'=>'/'];
            return $this->respondWithData($msg);
          
        }
        $now = new DateTime();
        $newnow =$now->format("Y-m-d H:i:s");
            
        if($newnow > $tokenbd[0]['date']){
            $msg = ['status'=> 'fail', 'msg'=>"Token Expirou!",'location'=>'/'];
            // return $this->response->withHeader("location","/")->withStatus(302);
        } 
        
        $altsenha = new CreateRepository($this->sql);
        $senhaCodif = password_hash($senha1, PASSWORD_DEFAULT); 
        $altsenha->updateSenha($tokenbd[0]['email'],$senhaCodif);

        $msg = ['status'=> 'ok', 'msg'=>"Senha alterada com Sucesso",'location'=>'/'];
        return $this->respondWithData($msg);
        
    
        }
        

    }
