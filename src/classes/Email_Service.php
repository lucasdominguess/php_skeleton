<?php 
namespace App\classes;

require __DIR__."/Email.php";
// require "/Infrastructure/Persistence/User/RedisConn.php";
require __DIR__."/../../src/Infrastructure/Persistence/User/RedisConn.php";
// require __DIR__.'/SendEmail.php';
// use App\classes\SendEmail;
// use App\classes\SendEmail;
// use Redis; 

use App\classes\Email;
use App\classes\CreateLogger;
use App\Infrastructure\Persistence\User\RedisConn;



class Email_Service
{

    public function Adcionar_fila($key,$value){ 
        $redis = new Redis();
        $redis->connect('127.0.0.1',6379);
        $redis->rPush($key ,$value);
        
    }
    public function verificarFila(){
           
            // $redis = new Redis();
            // $redis->connect('127.0.0.1',6379);
            $redis = new RedisConn();


            $r =$redis->lRange('enviar_email', 0 ,-1);



            if (empty($r)) {
                
                print_r("Array vazio");
                exit();
            }
      
           $email = $redis->lPop("enviar_email");
            
            $send = new Email();
            $send->mandar_email($email,"token_aleatorio");
            




            // $logger = new CreateLogger();
            // $logger->logger('testeredis','foi enviado','info',$r);
    
    
        }
    
}

$s = new Email_Service();
$s->verificarFila();


