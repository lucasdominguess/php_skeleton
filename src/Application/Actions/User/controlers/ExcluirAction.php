<?php
namespace App\Application\Actions\User\controlers;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\User\DeleteRepository;
use App\Infrastructure\Persistence\User\Sql;
use Psr\Http\Message\ResponseInterface as response;

class ExcluirAction extends Action{ 
    protected function action(): response 
    {
        $id = $_GET['id']; 
        $url =  $_SERVER['HTTP_REFERER'] ?? null ;
        $db =new Sql(); 
        $user = new DeleteRepository($db) ;
       
        
        if($url == URL_HOMEADM ){ 
            
            
            try{
                $user->Delete_EstagiariosOfId($id); 
            }catch(\Throwable $e){
                return $this->respondWithData($e->getMessage());
    
            }
        }

        if($url == URL_EXIBIR_ADMIN){
 
            try{
                $user->Delete_AdminsOfId($id);
            }catch(\Throwable $e){
                return $this->respondWithData($e->getMessage());
    
            }
       }
       if($url == URL_TENTA_ACESSO){ 
            try{
                $user->Delete_TentativasOfId($id);
            }catch(\Throwable $e){
                return $this->respondWithData($e->getMessage());

            }
        }
        
        
        $resposta =['status'=>'ok','msg'=>"Dados Excluidos com Sucesso!"];

       
        
        return $this->respondWithData($resposta);
        
    }
}