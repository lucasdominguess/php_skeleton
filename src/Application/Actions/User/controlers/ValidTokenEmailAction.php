<?php
namespace App\Application\Actions\User\controlers;

use DateTime;
use App\Application\Actions\Action;
use App\Infrastructure\Helpers;
use Psr\Http\Message\ResponseInterface as response;
use App\Infrastructure\Persistence\User\ReadRepository;

class ValidTokenEmailAction extends Action  
{ 

    public function action(): response 
    {   
        // $token = $_GET['token'] ?? null ; 
        $token = $this->args['token'];
        // Helpers::dd($token);
        $email = $_GET['email'] ?? null ; 
        if(!isset($token)) { 
            $msg = ['status'=> 'fail', 'msg'=>'token invalido!'];
            return $this->response->withHeader("location","/")->withStatus(307);
        }
        $user = new ReadRepository($this->sql); 
        try {
            $tokenbd =  $user->resetFindAllEmail($token);
            // Helpers::dd($tokenbd);
            //cohel...
        } catch (\Throwable $th) {
            $msg = ['status'=> 'fail', 'msg'=>'token invalido!'];
            return $this->response->withHeader("location","/")->withStatus(302);
        
        }
        $now = new DateTime();
        $newnow =$now->format("Y-m-d H:i:s");
        // Helpers::dd($newnow);
        // Helpers::dd($tokenbd[0]['date']);

        
        if($newnow > $tokenbd[0]['date']){
            
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

           
        $token_url = rawurlencode($token);
        // Helpers::dd($token_url);
        return $this->response->withHeader("location","/registrar_novasenha/$token")->withStatus(307);
    }
}