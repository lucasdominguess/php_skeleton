<?php
namespace App\Application\Actions\User\controlers;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\User\Sql;
use Psr\Http\Message\ResponseInterface as response;

class ExcluirAction extends Action{ 
    protected function action(): response 
    {
        $id = $_GET['id']; 
        $db =new Sql(); 
        $stmt = $db->prepare("delete from estagiarios where id = :id");
        $stmt->bindValue(":id",$id); 
        $stmt->execute();
        $resposta =['status'=>'ok','msg'=>"Dados Excluidos com Sucesso!"];
       
        
        return $this->respondWithData($resposta);
        
    }
}