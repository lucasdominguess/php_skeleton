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

        // $url =  $_SERVER['HTTP_REFERER'] ?? null ;
        // $url =  $_SERVER['SCRIPT_URI'] ?? null ;
       
        
        if(URI_SERVER == URL_HOMEUSER){ 
            
            $resultado = $user->estagisFindAll();

            return $this->respondWithData($resultado);
           
        }
        if(URI_SERVER == URL_HOMEADM){ 
            
            $resultado = $user->estagisFindAll();

            return $this->respondWithData($resultado);
           
        }
            
        if(URI_SERVER == URL_EXIBIR_ADMIN){
 
            $resultado = $user->admsFindAll();
                
                return $this->respondWithData($resultado);
                // return $this->respondWithData($url);
        }

                
        if(URI_SERVER == URL_TENTA_ACESSO){ 
        $resultado = $user->tentativasFindAll();

        return $this->respondWithData($resultado);
        }
        
        if(URI_SERVER == URL_ARQUIVOS_ADM){
            $pasta = "C:/Users/x492420/OneDrive - rede.sp/Área de Trabalho/php_skeleton/src/Application/files/arquivos ";
            // $pasta = 'arquivos';
            // $pasta = __DIR__ ."arquivos";
            // $pasta=  "C:/Users/lucas domingues/OneDrive/Documentos/Lucas Backup/repositorios_git/php_slim/src/Application/files/arquivos";
            $arquivos = scandir($pasta);
            array_shift($arquivos);
            array_shift($arquivos);
            return $this->respondWithData($arquivos);
            
        }
    
        return $this->respondWithData(['msg'=>'Erro']);
    // }
    
}
}