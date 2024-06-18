<?php
namespace App\Application\Actions\User\controlers\alterar_senha;

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
        
        if(!isset($token)) { 
            $msg = ['status'=> 'fail', 'msg'=>'token invalido!'];
            return $this->response->withHeader("location","/")->withStatus(307);
        }
        $user = new ReadRepository($this->sql); 
        try {
            $tokenbd =  $user->resetFindAllEmail($token);
            // Helpers::dd($tokenbd);
        
        } catch (\Throwable $th) {
            $msg = ['status'=> 'fail', 'msg'=>'token invalido!'];
            return $this->response->withHeader("location","/")->withStatus(302);
        
        }
        $now = new DateTime();
        $newnow =$now->format("Y-m-d H:i:s");
            
        if($newnow > $tokenbd[0]['date']){
            
            return $this->response->withHeader("location","/")->withStatus(302);
        } 
       
        return $this->response->withHeader("location","/registrar_novasenha/$token")->withStatus(307);
    }
}