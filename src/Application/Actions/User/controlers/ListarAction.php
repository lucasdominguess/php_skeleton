<?php 
namespace App\Application\Actions\User\controlers;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\User\Sql;
use Psr\Http\Message\ResponseInterface as response;

class ListarAction extends Action { 

    protected function action(): response 
    {   
        $db = new Sql();
        // $rota = $_GET['rota'] ; 

        // if($rota == 'html_admhome' || $rota == 'html_userhome'){ 
            
            $stmt = $db->query("SELECT * FROM estagiarios;");
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $this->respondWithData($resultado);
        }

    //     if($rota == 'html_exibiradmins') { 
    //         $stmt = $db->query("SELECT id_adm,nome,email FROM usuarios");
    //         $stmt->execute();
    //         $resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
            
    //         return $this->respondWithData($resultado);
    //     }

    //     if($rota == 'html_tentativas_acesso'){ 
    //         $stmt = $db->query("SELECT * FROM tentativa");
    //         $stmt->execute();
    //         $resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
            
    //         return $this->respondWithData($resultado);
    //     }

        
    // }
    
}