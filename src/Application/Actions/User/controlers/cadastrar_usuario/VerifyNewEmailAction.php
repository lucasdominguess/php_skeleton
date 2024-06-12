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
        
        //cadastrando no banco usuario com nivel 0 (sem acesso)
        $senha = password_hash($dados['senha'], PASSWORD_DEFAULT); 
        $newuser = new  CreateRepository($this->sql);
        $newuser->createAdmin($username,$email,$senha,0);

        //mandando email para o adm 
        $tokenadm = md5(uniqid());
        $dados = json_encode(
            [   
                'email'=>'lucasdomingues@prefeitura.sp.gov.br', 
                'token'=>$tokenadm,
                
                'subject'=>"Aprovação de cadastro ",
                'body'=>"<h3> Uma aprovação de cadastro foi solicitada para o email $email em nome de $username,caso queira prosseguir com a aprovação click em  <a href='http://localhost:9000/aprovar_cadastro/$tokenadm/sim'>Aprovar cadastro</a> <br> 
                 para Reprovar a ativação do cadastro click no link e a seguir: <a href='http://localhost:9000/aprovar_cadastro/$tokenadm/nao'>Reprovar Cadastro</a></h3>"
            ]);
        $this->redisConn->rPush('enviar_email',$dados);
        $this->redisConn->hset($tokenadm,'tokenadm',$tokenadm);
        $this->redisConn->hset($tokenadm,'email',$email);

        

        $msg = json_encode(['status'=> 'ok', 'msg'=>'Cadastro realizado! Aguarde aprovação de um administrador para logar ']);
        
        $newmsg = urlencode($msg);
        return $this->response->withHeader("location","/?msg=$newmsg")->withStatus(307);


    }
}