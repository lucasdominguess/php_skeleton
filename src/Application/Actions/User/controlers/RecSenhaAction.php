<?php

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\User\ReadRepository;
use Psr\Http\Message\ResponseInterface as response;
class RecSenhaAction extends Action  
{ 

    public function action(): response 
    {   
        $token = $_GET['token'] ?? null ; 
        if(!isset($token)) { 
            $msg = ['status'=> 'fail', 'msg'=>'token invalido!'];
            return $this->respondWithData($msg);
        }
        $user = new ReadRepository($this->sql); 
        $user->resetFindAllEmail($token); 
        //pegar a hora 

        $msg = ['status'=> 'fail', 'msg'=>'o campo email nao pode estar em branco!'];
       return $this->respondWithData($msg);
    }
}