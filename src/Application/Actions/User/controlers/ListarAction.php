<?php 
namespace App\Application\Actions\User\controlers;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\User\Sql;
use Psr\Http\Message\ResponseInterface as response;

class ListarAction extends Action { 

    protected function action(): response 
    {
        $db1 = new Sql();
        $stmt = $db1->query("SELECT * FROM estagiarios;");
        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $this->respondWithData($resultado);
        
    }
    
}