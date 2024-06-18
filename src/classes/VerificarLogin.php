<?php
namespace App\classes;


use App\classes\BloquearAcesso;
use App\Infrastructure\Persistence\User\Sql;


class VerificarLogin { 

public function __construct($email,$senha) {
   $this->validarLogin($email,$senha);
}

    protected function validarLogin($email,$senha)
    {
        // $email = $_POST['email']; 
        // $senha = $_POST['senha']; 

        $db2 = new Sql();
        $stmt=$db2->prepare("Select * from usuarios where email = :email");
        $stmt->bindValue(":email",$email);
        $stmt->execute();

        $retorno = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    if(!isset($retorno[0]['id_adm'])){
        sleep(1);
        $block = new BloquearAcesso; 
        $block->bloqueio($email,$senha);
    
        
        $response = ['status'=>'fail','msg'=>'Usuario ou Senha invalida'];
        // echo json_encode($response) ;
        return $response;


    }
    if(!password_verify($senha,$retorno[0]['senha'])){
        sleep(1);
        $block_senha = new BloquearAcesso; 
        $block_senha->bloqueio($email,$senha);
    
        $response =['status'=>'fail','msg'=>'Usuario ou Senha invalida']; 
        // echo json_encode($response) ;
        return $response;
    
    }



}    
}
