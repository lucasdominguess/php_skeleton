<?php 
namespace App\Application\Actions\User\controlers;
use App\Application\Actions\Action;
use Slim\Psr7\Response as response ; 
use App\Infrastructure\Persistence\User\ReadRepository;

class ListarCardsAction extends Action{ 

    public function action() :response 
    {   
        $nome = $_GET['name'];
        $user = new ReadRepository($this->sql);
        $resultado = $user->estagisFindAllforName($nome);

            // return $this->respondWithData($resultado);


        if ($resultado == null){

            $msg = ['status' => 'fail', 'msg' => 'Nenhum Cadastro foi encontrado'];
            return $this->respondWithData($msg);
        }else{

             return $this->respondWithData($resultado);
        }
        
    }
}