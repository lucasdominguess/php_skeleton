<?php
namespace App\Application\Actions\User\controlers;

use voku\helper\AntiXSS; 
use App\Infrastructure\Helpers;
use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as response ;
use App\Infrastructure\Persistence\User\ReadRepository;

class ValidPassAction extends Action 
{
    public function action(): Response
    {   $xss = new AntiXSS();

        // $get = $_GET['token']; 
        
        // Helpers::dd($get);

        $senha1 = $xss->xss_clean($_POST['senha1']) ?? null ; 
        $senha2 = $xss->xss_clean($_POST['senha2']) ?? null ; 
        $token = $xss->xss_clean($_POST['token']) ?? null ; 

        
        if($senha1 == null || $senha2 == null  ){ 
            
            $msg = ['status'=> 'fail', 'msg'=>'os campos senhas nao podem estar vazios'];
            return $this->respondWithData($msg); 
        }
        if ($senha1 != $senha2){ 
            $msg = ['status'=> 'fail', 'msg'=>'As senhas nao são iguais'];
            return $this->respondWithData($msg); 
        }
        if ($token == null) {
            return $this->response->withHeader("location","/")->withStatus(302);
        }
        // $user = new ReadRepository($this->sql); 
        
        // $tokenbd =  $user->resetFindAllEmail($token);


        $msg = ['status'=> 'ok', 'msg'=>"$token "];
        return $this->respondWithData($msg); 
            // Helpers::dd($tokenbd);
            //cohel...
    //     } catch (\Throwable $th) {
    //         $msg = ['status'=> 'fail', 'msg'=>'token invalido!'];
    //         // return $this->response->withHeader("location","/")->withStatus(302);
    //         return $this->respondWithData($msg);
    // }
        }
        

    }
