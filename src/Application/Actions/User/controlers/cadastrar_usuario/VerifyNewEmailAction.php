<?php
namespace App\Application\Actions\User\controlers\cadastrar_usuario;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\User\CreateRepository;
use App\Infrastructure\Persistence\User\ReadRepository;
use Psr\Http\Message\ResponseInterface as response;

class VerifyNewEmailAction extends Action 
{
    protected function action(): response
    {
        $token = $this->args['token'];

        if(!isset($token)) { 
            $msg = ['status'=> 'fail', 'msg'=>'token invalido!'];
            return $this->response->withHeader("location","/")->withStatus(307);
        }

        $dados = $this->redisConn->HGetall($token); 

        if(!isset($dados)){
            $msg = ['status'=> 'fail', 'msg'=>'token invalido!'];
            return $this->response->withHeader("location","/")->withStatus(307);
        }

        $username = $dados['name'];
        $email =$dados['email'];
        
        $senha = password_hash($dados['senha'], PASSWORD_DEFAULT); 
        $newuser = new  CreateRepository($this->sql);
        $newuser->createAdmin($username,$email,$senha,0);



        $msg = "Mensagem do alem";
        $newmsg = urlencode(json_encode($msg));
        return $this->response->withHeader("location","/?msg=$newmsg")->withStatus(307);


    }
}