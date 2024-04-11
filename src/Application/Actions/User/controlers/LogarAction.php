<?php
namespace App\Application\Actions\User\controlers;

use PDO;
use DateTime;
use DateTimeZone;
use Slim\Views\Twig;
use App\classes\ConsultaBanco;
use App\classes\VerificarEmail;
use App\classes\VerificarLogin;
use App\Application\Actions\User\UserAction;
use App\Infrastructure\Persistence\User\Sql;
use Psr\Http\Message\ResponseInterface as Response; 


class LogarAction extends UserAction 
{
    protected function action(): Response
    {   
        $email = $_POST['email']; 
        $senha = $_POST['senha']; 



try{ 
    $ver_email = new VerificarEmail($email);
    // $newEmail = new ConsultaBanco($email,$senha); 

    // $login = new VerificarLogin($email,$senha);
    // $login->action();
}catch(\Throwable $e){ 
    $response = ['cod' => 'fail', 'msg' => $e->getMessage()];
    return $this->respondWithData($response);
    exit();
}



        $response= ['status'=>'ok','msg'=>'logado com kkkkksucesso','location'=>'home'];
        return $this->respondWithData($response);
}

};
