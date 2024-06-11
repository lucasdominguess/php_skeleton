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
            // $msg = "Token Invalido";
            $msg = ['status'=> 'fail', 'msg'=>'Token Invalido!'];
            $newmsg = urlencode(json_encode($msg));
            return $this->response->withHeader("location","/?msg=$newmsg")->withStatus(307);

        }

        $dados = $this->redisConn->HGetall($token); 

        if(!isset($dados['email'])){
            $msg = json_encode(['status'=> 'fail', 'msg'=>'Token Expirado!']);
            $newmsg = urlencode($msg);
            return $this->response->withHeader("location","/?msg=$newmsg")->withStatus(307);

        }

        $username = $dados['name'];
        $email =$dados['email'];
        
        $senha = password_hash($dados['senha'], PASSWORD_DEFAULT); 
        $newuser = new  CreateRepository($this->sql);
        $newuser->createAdmin($username,$email,$senha,0);


        $msg = json_encode(['status'=> 'ok', 'msg'=>'Cadastro realizado! Aguarde aprovação de um administrador para logar ']);
       
        $newmsg = urlencode($msg);
        return $this->response->withHeader("location","/?msg=$newmsg")->withStatus(307);


    }
}