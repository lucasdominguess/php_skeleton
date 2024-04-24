<?php
namespace App\Application\Actions\User\controlers;

use App\Domain\User\User;
use App\Application\Actions\Action;
use App\Infrastructure\Persistence\User\Sql;
use PhpParser\Node\Stmt\Echo_;
use Psr\Http\Message\ResponseInterface as response;

class ExibiradminsAction extends Action{ 
    protected function action(): response 
    {   
        $url =  $_SERVER['HTTP_REFERER'];

        // if ($_SESSION[User::USER_ID] < 4) {
        //     $resultado = ['status'=>'fail','msg'=>"Permissão Negada!"];
        //     return $this->respondWithData($resultado); 
        // }

        
        // if ($url == null ){

        //             // $resultado = ['location'=>'/'];
        //             return $this->respondWithData($url);
        //     }
    
       if($url == 'http://localhost:9000/admin/exibiradmins'){

        $db =new Sql(); 
        $stmt = $db->query("select * from usuarios");
        $stmt->execute();
        $resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
        
        return $this->respondWithData($resultado);
        
    }
    return $this->respondWithData('nada');
}}