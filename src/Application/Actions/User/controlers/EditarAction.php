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
        if ($_SESSION[User::USER_NIVEL] != 5) {
            $response = new response;
            return $response->withHeader('Location', '/')->withStatus(302);
        }

        $id = $_GET['id'] ; 
        $db =new Sql(); 
        $url =  $_SERVER['HTTP_REFERER'] ?? null ;
        $user = new ReadRepository($db); 

        if($url == URL_HOMEADM || $url == URL_HOMEUSER){
            
            $newuser =  [$user->estagisFindId($id),'code'=>'usuario'];
            return $this->respondWithData($newuser); 
        
        }   
        if($url == URL_EXIBIR_ADMIN){
          
            $newuser =  [$user->admFindId($id),'code'=>'admin'];
            return $this->respondWithData($newuser); 
        
        }   
        if($url == URL_TENTA_ACESSO){
      
           $newuser =  [$user->tentativasFindId($id),'code'=>'3'];
            return $this->respondWithData($newuser); 
        
        }   
    }
}