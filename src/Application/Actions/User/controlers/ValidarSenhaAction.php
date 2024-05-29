<?php
namespace App\Application\Actions\User\controlers;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as response ;
use voku\helper\AntiXSS; 

class ValidarSenhaAction extends Action 
{
    public function action(): Response
    {   $xss = new AntiXSS();

        $senha1 = $xss->xss_clean($_POST['senha1']) ?? null ; 
        $senha2 = $xss->xss_clean($_POST['senha2']) ?? null ; 
        
        if($senha1 == null || $senha2 == null  ){ 
            
            $msg = ['status'=> 'fail', 'msg'=>'os campos senhas nao podem estar vazios'];
            return $this->respondWithData($msg); 
        }
        if ($senha1 != $senha2){ 
            $msg = ['status'=> 'fail', 'msg'=>'As senhas nao são iguais'];
            return $this->respondWithData($msg); 
        }

        

        $msg = ['status'=> 'ok', 'msg'=>'Senha alterar com sucesso!'];
        return $this->respondWithData($msg);
    }
}