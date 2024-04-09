<?php 
namespace App\Application\Actions\User\controlers;
// session_start();
// if($_SESSION["email"] == null){
//     header('location: http://192.168.206.39:9000');
//     session_destroy(); 
//     $res = ['status'=>'ok','msg'=>'Sessao encerrada com sucesso'];  
//     echo json_encode($res);
// }

use Slim\App;

use DateTime;
use DateTimeZone;
use App\Application\Actions\User\UserAction;
use Psr\Http\Message\ResponseInterface as Response;

class SairSessaoAction extends UserAction 
{ 
    protected function action(): Response 
    {   
       
        $response= ['status'=>'ok','msg'=>'Sessao encerrada com sucesso','location'=>'/'];
        return $this->respondWithData($response);
    }
    



}




// $_SESSION['sessao'];
// $addtime = date_add($_SESSION['sessao'],date_interval_create_from_date_string('+30 minutes'));
// $sessao_usuario = $addtime->format('Y-m-d H:i:s');
// $datenow =  new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

// $_SESSION['tempo30'] = $sessao_usuario ; 

// if($sessao_usuario<$datenow){ 
//     session_unset();
//     session_destroy();  
//     header('location: http://192.168.206.39:9000');
//     $res = ['status'=>'fail','msg'=>'Tempo de Sessao expirada!'];  
//     echo json_encode($res);
// }

// session_destroy(); 
// $res = ['status'=>'ok','msg'=>'Sessao encerrada com sucesso'];  
// echo json_encode($res);
// echo session_id();
// echo "<br>";
// echo session_save_path(); 

// session_unset();
