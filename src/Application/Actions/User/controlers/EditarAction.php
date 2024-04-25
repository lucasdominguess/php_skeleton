<?php
namespace App\Application\Actions\User\controlers;

use App\Domain\User\User;
use App\Application\Actions\Action;
use App\Infrastructure\Persistence\User\ReadRepository;
use App\Infrastructure\Persistence\User\Sql;
use PhpParser\Node\Stmt\Return_;
use Psr\Http\Message\ResponseInterface as response;

class EditarAction extends Action{ 
    protected function action(): response 
    {   
        if ($_SESSION[User::USER_ID] < 4) {
            $resultado = ['status'=>'fail','msg'=>"Permissão Negada!"];
            return $this->respondWithData($resultado); 
        }

        $id = $_GET['id'] ; 
        $db =new Sql(); 
        $url =  $_SERVER['HTTP_REFERER'] ?? null ;
        $user = new ReadRepository($db); 

        if($url == URL_EXIBIR_ADMIN){
          
            $newuser =  $user->admFindId($id);
            return $this->respondWithData($newuser); 
        
        }   
        if($url == URL_HOMEADM || $url == URL_HOMEUSER){
      
            $newuser =  $user->estagisFindId($id);
            return $this->respondWithData($newuser); 
        
        }   
        if($url == URL_TENTA_ACESSO){
         
           $newuser = $user->tentativasFindId($id);
            return $this->respondWithData($newuser); 
        
        }   
    }
}