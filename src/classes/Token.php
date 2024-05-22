<?php 
namespace App\classes;

use App\Domain\User\User;
use DateTime;
use DateTimeZone;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class Token { 
    public function __construct($email,$time)
 {
      $this->gerarToken($email,$time);
 }
   protected function gerarToken($email,$time){
    global $env;
    $key = $env['secretkey'];
    
    $time_inicio = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
    $newtime = $time_inicio->format('Y-m-d H:i:s');
    $exp_time = date_add($time_inicio,date_interval_create_from_date_string($time));
    $new_exp_time = $exp_time->format('Y-m-d H:i:s');

    $payload = [
    'iat' => strtotime($newtime),
    'exp' => $new_exp_time,
    'email' => $email,
    'nivel' => $_SESSION[User::USER_NIVEL]
    ];
   
    $jwt = JWT::encode($payload, $key, 'HS256');
        //  print_r("chave cripto: ".$jwt ."\n");
        setcookie('token',$jwt,0,'/','',false,true);
        $_SESSION['EXP_TOKEN'] = $new_exp_time ;
        // $_SESSION['token']= $jwt;
     
    }
 }

//   protected function validaToken($email){
  
    
//     $key = '1345678';
//     $payload = [
//     'iat' => time(),
//     'exp' => strtotime("+30 minutes"),
//     'email' => $email,
//     'id' => '1'
//     ];
   
//         $jwt = JWT::encode($payload, $key, 'HS256');
//         // print_r("chave cripto: ".$jwt ."\n");
       

//         $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
//         // print_r($decoded);


//         // Pass a stdClass in as the third parameter to get the decoded header values
//         // $decoded = JWT::decode($jwt, new Key($key, 'HS256'), $headers = new stdClass());
//         // print_r($headers);
       
       
//         // $decoded_array = (array) $decoded;
       
//        //     JWT::$leeway = 60; // $leeway in seconds
//        //     $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
//  }

 