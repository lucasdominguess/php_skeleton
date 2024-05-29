<?php
namespace App\Application\Actions\User\controlers;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\User\ReadRepository;
use Psr\Http\Message\ResponseInterface as response;
class RecSenhaAction extends Action  
{ 

    public function action(): response 
    {   
        $token = $_GET['token'] ?? null ; 
        $email = $_GET['email'] ?? null ; 
        if(!isset($token)) { 
            $msg = ['status'=> 'fail', 'msg'=>'token invalido!'];
            return $this->response->withHeader("location","/")->withStatus(307);
        }
        $user = new ReadRepository($this->sql); 
        try {
            $tokenbd =  $user->resetFindAllEmail($token);
            //code...
        } catch (\Throwable $th) {
            $msg = ['status'=> 'fail', 'msg'=>'token invalido!'];
            return $this->response->withHeader("location","/")->withStatus(302);
            
        }
        if(!$GLOBALS['datefullForm'] > $tokenbd[0]['date']){
            
            return $this->response->withHeader("location","/")->withStatus(302);
        } 
        // var_dump($token); 
        // var_dump($email); 
        // var_dump($user); 
        
        // $tokenbd[0]['date'];
  

        // if(!isset($user)) { 
        //     $msg = ['status'=> 'fail', 'msg'=>'token invalido!'];
        //     return $this->respondWithData($msg);
        // }



        
        return $this->response->withHeader("location","/recuperar_senha")->withStatus(307);
    }
}