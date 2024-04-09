<?php
namespace App\Application\Actions\User\controlers;

use App\Application\Actions\User\UserAction;
use Psr\Http\Message\ResponseInterface as Response; 
use Slim\Views\Twig;


class Registrar extends UserAction 
{
    protected function action(): Response
    {   
        // if( 1 != 1 )
        // {
        //     $view = Twig::fromRequest($this->request);
        //     return $view->render($this->response, 'index.html', [
              
        //     ]); 
        // }
        // else{
        //]);

        $response= ['status'=>'ok','msg'=>'logado com sucesso','location'=>'registrar'];
        return $this->respondWithData($response);
}

};
//     public $view ;



//     public function __construct() {
//         $email = $_POST['email']; 
//         $senha = $_POST['senha']; 
//         $idN = $_POST['id']; 
//         $this->index($email, $senha);
//     }

// public function index($email, $senha){ 
  
//     // if ($email == '' or $senha == '' ){
//     //     echo 'usuario e senha nao poder ser vazio '; 
//     //     exit(); 
//     // }
//         // header('location: /registrar.php');
        // return json_encode('chegou aqui');


