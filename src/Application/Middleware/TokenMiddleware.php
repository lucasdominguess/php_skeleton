<?php
namespace App\Application\Middleware;
 

use DateTime;
use DateTimeZone;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
// use Slim\Psr7\Request;
use App\classes\Token;
use Slim\Psr7\Response;
use App\Domain\User\User;
use App\Infrastructure\Helpers;
use App\Infrastructure\Persistence\User\RedisConn;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
 
 
class TokenMiddleware {
    public function __invoke(Request $request, RequestHandler $handler)
    {  
        global $env;
        $key = $env['secretkey'];
        $response = new Response();
        // $tokenAuth = $_SERVER['HTTP_AUTHORIZATION'] ?? 'tokennaoexiste' ;
        // $cookie = $_COOKIE['token'];
        
        // verificando se o token existe
        if(!isset($_COOKIE['token'])){
            setcookie('token','',-1,'/');
            session_unset();
            session_destroy();
            // return $response->withHeader('Location', '/?msg=' . urlencode($msg))->withStatus(302);   
            return $response->withHeader('Location', '/')->withStatus(302); 
        }

        $email = $_SESSION[User::USER_EMAIL];

        $decoded = JWT::decode($_COOKIE['token'], new Key($key, 'HS256'));
        $decoded_array = (array) $decoded;

        $r = $decoded_array['email'] ; 
       
        if(!$r == $email){
            return $response->withHeader('Location', '/')->withStatus(302);
        }
       

    
        $inicia_time = $decoded_array['iat'];  //tempo do inicio criação token
        $exp_sessao = $decoded_array['exp'];  //tempo de expiração do token 

        $inicia_time_new=date("Y-m-d H:i:s",$inicia_time);
         
        $datenow = new DateTime('now', new DateTimeZone('America/Sao_Paulo')); 
        $newdate_now = $datenow->format('Y-m-d H:i:s');

        // if($email == $r){
        //     $response = $handler->handle($request);
        //     return $response;
        // }
        
        if($newdate_now <= $exp_sessao) 
        {   
            
            $redis = new RedisConn(); 
            $redis->del($_SESSION[User::USER_EMAIL]);
            setcookie('token','',-1,'/');
            session_destroy();
            return $response->withHeader('Location', '/')->withStatus(302); 
        }
        $token = new Token($email,"+10 minutes"); 
        $response = $handler->handle($request);
        return $response;
             
        // Redirecione o cliente e inclua a mensagem na URL como um parâmetro de consulta
        // return $response->withHeader('Location', '/?msg=' . urlencode($msg))->withStatus(302);
        
         }
        
       
        }

            

    



