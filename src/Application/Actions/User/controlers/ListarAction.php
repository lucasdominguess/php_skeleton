<?php 
namespace App\Application\Actions\User\controlers;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\User\Sql;
use Psr\Http\Message\ResponseInterface as response;

class ListarAction extends Action { 

    protected function action(): response 
    {   
        $db = new Sql();
        $url =  $_SERVER['HTTP_REFERER'] ?? null ;

        
        if ($url == null ){

                    // $resultado = ['location'=>'/'];
                    return $this->respondWithData($url);
            }

            
        if($url == 'http://localhost:9000/admin/exibiradmins'){
 
                $stmt = $db->query("select * from usuarios");
                $stmt->execute();
                $resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
                
                return $this->respondWithData($resultado);
        }

        if($url == 'http://localhost:9000/admin/acessoadm'){ 
            
            $stmt = $db->query("SELECT * FROM estagiarios;");
            $stmt->execute();
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $this->respondWithData($resultado);
        }
        if($url == 'http://localhost:9000/user/acessouser'){
            $stmt = $db->query("SELECT * FROM estagiarios;");
            $stmt->execute();
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
    
}}