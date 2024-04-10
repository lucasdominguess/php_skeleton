<?php 
namespace App\Application\Middleware;



use DateTime;
use DateTimeZone;
use App\classes\Data;
// use Slim\Psr7\Request;
use App\classes\Pessoa;
use Slim\Psr7\Response;
// use Slim\Handlers\Strategies\RequestHandler;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class UsuarioMiddleware 
    {
        
        public function __invoke(Request $request, RequestHandler $handler) 
        {    
            $nome = $_POST['nome'];
            $data = new Data($_POST['data_nascimento']);

            $datenow = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
            $datanowform = $datenow->format('Y-m-d');
            

            $date = $this->$data->getData();
            
            // $data3form = $date->format('Y-m-d');
            $intervalo = $datenow->diff($date);
            
            $resultado = $intervalo->format("%a");
            // $res2 = $resultado->format('Y-m-d');
            
            $resultado = $resultado/365.25;
            $res= intval($resultado);
            if($res < 18 || $res > 50){
                throw new \Exception("Idade invalida para cadastro"); 
            }

            try{
                new Pessoa($nome);
            }catch(\Exception $e){
                return $e->getMessage();
            } 


            $response = $handler->handle($request);
            print_r($response);
            // return $response;
            // parent::__construct($nome,$data);
           
        }
    }