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
   
}catch(\Throwable $e){ 
    $response =['status' => 'fail', 'msg' => $e->getMessage()];
    return $this->respondWithData($response);
    exit();
}

// try{
//     $newEmail = new ConsultaBanco($email,$senha); 
// }catch(\Throwable $e){ 
//     $response = ['cod' => 'fail', 'msg' => $e->getMessage()];
//     return $this->respondWithData($response);
   
// }

// try{
//     $newEmail = new VerificarLogin($email,$senha); 
// }catch(\Throwable $e){ 
//     $response =  throw new \Exception($e->getMessage());
//     return $this->respondWithData($response);
   
// }





        // $response2= (['status'=>'ok','msg'=>'logado com sucesso','location'=>'home']);
        // return $this->respondWithData($response2);
}

};
