<?php 
namespace App\classes;


class IniciarSessao { 

    public function __construct(public string $username,public string $email)
    {
        $this->criarSessao($username,$email);
    }

    protected function criarSessao($username,$email){ 
        
        $_SESSION['nome'] = $username ; 
        $_SESSION['email'] = $email ; 
    
    }

}