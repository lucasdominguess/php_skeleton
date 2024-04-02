<?php 

namespace App\classes;

require_once "./vendor/autoload.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class Token { 
    public function __construct($email)
    {
        $this->validaToken($email);
    }

  protected function validaToken($email){
  
    
    $key = '1345678';
    $payload = [
    'iat' => time(),
    'exp' => strtotime("+30 minutes"),
    'email' => $email,
    'id' => '1'
    ];
   
        $jwt = JWT::encode($payload, $key, 'HS256');
        // print_r("chave cripto: ".$jwt ."\n");
       

        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        // print_r($decoded);


        // Pass a stdClass in as the third parameter to get the decoded header values
        // $decoded = JWT::decode($jwt, new Key($key, 'HS256'), $headers = new stdClass());
        // print_r($headers);
       
       
        // $decoded_array = (array) $decoded;
       
       //     JWT::$leeway = 60; // $leeway in seconds
       //     $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
 }
}
 