<?php
namespace App\Application\Actions\User\controlers;

use App\Domain\User\User;
use App\classes\CreateLogger;
use App\Application\Actions\Action;
use App\Infrastructure\Persistence\User\Sql;
use Psr\Http\Message\ResponseInterface as response;
use App\Infrastructure\Persistence\User\DeleteRepository;

class ExcluirAction extends Action
{ 
    protected function action(): response 
    {   
        //Precisa ser atualizada ...
        //correção : criar rotas individuais para cada consulta no banco de dados 

        
        $id = $_GET['id']; 
        $url = URI_SERVER ;

        $db =new Sql(); 
        $user = new DeleteRepository($db) ;
        $logger = new CreateLogger ;
       
        
        if(URI_SERVER == URL_HOMEADM){ 
            
            
            try{
                $user->Delete_EstagiariosOfId($id); 
                $logger->logger("DELETE","Admin: " .$_SESSION[User::USER_NAME]." Deletou um Usuario");
            }catch(\Throwable $e){
                return $this->respondWithData($e);
    
            }
        }

        if(URI_SERVER == URL_EXIBIR_ADMIN){
 
            try{
                $user->Delete_AdminsOfId($id);
                $logger->logger("DELETE","Admin: " .$_SESSION[User::USER_NAME]." Deletou um Administrador");
                $this->createLogger->logTelegran('Usuario: ' .$_SESSION[User::USER_NAME]. ' Deletou um Administrador',"warning");

            }catch(\Throwable $e){
                return $this->respondWithData($e);
    
            }
       }
       if(URI_SERVER == URL_TENTA_ACESSO){ 
            try{
                $user->Delete_TentativasOfId($id);
                $logger->logger("DELETE","Admin: " .$_SESSION[User::USER_NAME]." Deletou um Email em tentativas de acesso");
            }catch(\Throwable $e){
                return $this->respondWithData($e);

            }
        }
       if(URI_SERVER == URL_ARQUIVOS_ADM){ 
            try{
                $user->Delete_ArquivosOfId($id);
                $logger->logger("DELETE","Admin: " .$_SESSION[User::USER_NAME]." Deletou um arquivo em na tabela arquivos");
            }catch(\Throwable $e){
                return $this->respondWithData($e);

            }
        }
        
        
        $resposta =['status'=>'ok','msg'=>"Dados Excluidos com Sucesso!"];

       
        
        return $this->respondWithData($resposta);
        
    }
}