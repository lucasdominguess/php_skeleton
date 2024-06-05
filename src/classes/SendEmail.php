<?php
namespace App\classes;

use App\Infrastructure\Persistence\User\RedisConn;




// class SendEmail {

//     public function fila($key,$value){ 
//         $s = new RedisConn();

//         $s->lPush($key ,$value); 
//     }
// }


$r = new RedisConn(); 
$r->lPush('enviar_email','teste@gmail');