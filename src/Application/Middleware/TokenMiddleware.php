<?php
namespace App\Application\Middleware;
 
// require_once "vendor/autoload.php";

use DateTime;
use DateTimeZone;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
// use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Domain\User\User;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
 
 
class TokenMiddleware {
    public function __invoke(Request $request, RequestHandler $handler)
    {  
        global $env;
        $key = $env['secretkey'];

        $email = $_SESSION[User::USER_EMAIL];

        $decoded = JWT::decode($_COOKIE['token'], new Key($key, 'HS256'));
        $decoded_array = (array) $decoded;
    
        $inicia_time = $decoded_array['iat'];  //tempo do inicio criação token
        $exp_sessao = $decoded_array['exp'];  //tempo de expiração do token 
    
        $inicia_time_new=date("Y-m-d H:i:s",$inicia_time);
      
    
    
        $datenow = new DateTime('now', new DateTimeZone('America/Sao_Paulo')); 
        $newdate_now = $datenow->format('Y-m-d H:i:s');
        
      
        
        if($newdate_now > $exp_sessao) 
        { 
            header('location: /');
          setcookie('token','',-1,'/');
          session_destroy();
          $response = new Response();
        //   return $response->withHeader('Location', '/')->withStatus(302);  
        }

            $response = $handler->handle($request);
            return $response;

        }
     
       
        }

            

    



