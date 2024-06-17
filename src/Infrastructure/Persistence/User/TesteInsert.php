<?php 
namespace App\Infrastructure\Persistence\User;
use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use App\Infrastructure\Persistence\User\CreateRepository;

class TesteInsert extends Action 
{
public function  action(): Response
{
 
    
    $date = "22"; 
    $name = 'lucas' ; 
    
    $dados = [
        'create_time'=> $date,
        'nametest' => $name 
    ];

    $create = new CreateRepository($this->sql); 
    $create->createTest($dados);
    $msg= ['msg'];
    return $this->respondWithData($msg);
} 


}