<?php
namespace App\Application\Actions\User\controlers\cadastrar_usuario;

use PhpParser\Node\Stmt\Block;
use App\classes\BloquearAcesso;
use App\Application\Actions\Action;
use App\Infrastructure\Helpers;
use Psr\Http\Message\ResponseInterface;
use App\Infrastructure\Persistence\User\DeleteRepository;
use App\Infrastructure\Persistence\User\UpdateRepository;

class AprovarCadastroAction extends Action 
{
    protected function action(): ResponseInterface
    {
        $token = $this->args['token'];
        $auth = $this->args['auth'];
        

        if(!isset($token) || !isset($auth)) { 
          
            return $this->response->withHeader("location","/")->withStatus(307);

        }
       
        $dadosRedis = $this->redisConn->HGetall($token); 
        // Helpers::dd($dadosRedis);
        if(!isset($dadosRedis['tokenadm'])){
          
            return $this->response->withHeader("location","/")->withStatus(307);

        }
        $update = new UpdateRepository ; 

        if ($auth == 'nao') {
            $dados = json_encode(
                [   
                    'email'=>$dadosRedis['email'], 
                    'subject'=>"Reprovação de cadastro",
                    'body'=>"Infelizmente seu cadastro nao foi aprovado. tente novamente após o periodo de 6 meses "
                ]);
                $block = new BloquearAcesso();
                $block->bloqueioCadastro($this->sql,$dadosRedis['email']);
                
                $this->redisConn->rPush('enviar_email',$dados);
                
                $update->update($this->sql,$dadosRedis['email'],0);
                return $this->response->withHeader("location","/")->withStatus(307);



        }
        if ($auth == 'sim') {
            $dados = json_encode(
                [   
                    'email'=>$dadosRedis['email'], 
                    'subject'=>"Aprovação de cadastro",
                    'body'=>"Olá seu cadastro foi aprovado com sucesso! acesse o link e efetue seu <a href='http://localhost:9000'> login </a>"
                ]);


                
               
                $update->update($this->sql,$dadosRedis['email'],2);
                $this->redisConn->rPush('enviar_email',$dados);
                

                return $this->response->withHeader("location","/")->withStatus(307);
        }

    }
}