<?php 
namespace App\Application\Actions\User\controlers;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\User\ReadRepository;
use App\Infrastructure\Persistence\User\Sql;
use Psr\Http\Message\ResponseInterface as response;

class ListarAction extends Action { 

    protected function action(): response 
    {   
        $db = new Sql();
        $user = new ReadRepository($db);

        $url =  $_SERVER['HTTP_REFERER'] ?? null ;

        
        if ($url == null ){

                    // $resultado = ['location'=>'/'];
                    return $this->respondWithData($url);
            }

            
        if($url == URL_EXIBIR_ADMIN){
 
            $resultado =$user->admsFindAll();
                
                return $this->respondWithData($resultado);
        }

        if($url == URL_HOMEADM || URL_HOMEUSER){ 
            
            $resultado = $user->estagisFindAll();

            return $this->respondWithData($resultado);
        }
   
                    
        if($url == URL_TENTA_ACESSO){ 
         $user->tentativasFindAll();
            
            return $this->respondWithData($user);
        }

        
    // }
    
}}