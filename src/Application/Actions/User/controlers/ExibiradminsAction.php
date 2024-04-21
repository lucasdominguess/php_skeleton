<?php
namespace App\Application\Actions\User\controlers;

use App\Domain\User\User;
use App\Application\Actions\Action;
use App\Infrastructure\Persistence\User\Sql;
use Psr\Http\Message\ResponseInterface as response;

class ExibiradminsAction extends Action{ 
    protected function action(): response 
    {   
        if ($_SESSION[User::USER_ID] < 4) {
            $resultado = ['status'=>'fail','msg'=>"Permissão Negada!"];
            return $this->respondWithData($resultado); 
        }

        
        $db =new Sql(); 
        $stmt = $db->prepare("select * from usuarios");
        $stmt->execute();
        $resultado=$stmt->fetch(\PDO::FETCH_ASSOC); 
        
        return $this->respondWithData($resultado);
        
    }
}