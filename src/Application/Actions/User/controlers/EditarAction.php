<?php
namespace App\Application\Actions\User\controlers;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\User\ReadRepository;
use Psr\Http\Message\ResponseInterface as response;

class EditarAction extends Action{ 
    protected function action(): response 
    {   
        //Precisa ser atualizada ...
        //correção : criar rotas individuais para cada consulta no banco de dados 

        // if ($_SESSION[User::USER_NIVEL] != 5) {
        //     $response = new response;
        //     return $response->withHeader('Location', '/')->withStatus(302);
        // }

        $id = $_GET['id'] ; 
       
    
        $user = new ReadRepository($this->sql); 

        if(URI_SERVER == URL_HOMEADM){
            
            $newuser =  [$user->estagisFindId($id),'code'=>'usuario'];
            return $this->respondWithData($newuser); 
        
        }   
        if(URI_SERVER == URL_EXIBIR_ADMIN){
          
            $newuser =  [$user->admFindId($id),'code'=>'admin'];
            return $this->respondWithData($newuser); 
        
        }   
        if(URI_SERVER == URL_TENTA_ACESSO){
      
           $newuser =  [$user->tentativasFindId($id),'code'=>'3'];
            return $this->respondWithData($newuser); 
        
        }
        $response = new response;
        return $response->withHeader('Location', '/')->withStatus(302);
    }
}