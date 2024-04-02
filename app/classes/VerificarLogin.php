<?php

use App\classes\Token;

require_once 'Sql.php' ; 
require_once "./logs/SalvarLogs.php"; 
require_once "./app/classes/Token.php";



class VerificarLogin { 
    public function __construct($email,$senha)
    {
       $this->logar($email,$senha); 
    }

    protected function logar($email,$senha){ 
    
    $db2 = new Sql();
    $stmt=$db2->prepare("Select * from usuarios where email = :email");
    $stmt->bindValue(":email",$email);
    $stmt->execute();

    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(!isset($retorno[0]['id_adm'])){
        sleep(1);
        bloqueio($email,$senha);
    
        
        echo json_encode(['status'=>'fail','msg'=>'Usuario ou Senha invalida']);
        exit(); 

    }
    if(!password_verify($senha,$retorno[0]['senha'])){
        sleep(1);
        bloqueio($email,$senha);
    
        echo json_encode(['status'=>'fail','msg'=>'Usuario ou Senha invalida']);
        
        exit();
}
    
    // Iniciar sessão 
    session_start();
    $_SESSION['id_usuario']= $retorno[0]['id_adm'];
    $_SESSION['email']= $retorno[0]['email'];
    $_SESSION['id']= $retorno[0]['id_adm'];
    $_SESSION['nome']= $retorno[0]['nome'];
    $_SESSION['sessao'] = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
    $hr_arquivo =$_SESSION['sessao']->format('Y-m-d H:i:s');
    // $_COOKIE['token'] = new Token($_SESSION['email']);
    $_SESSION['token'] =  new Token($_SESSION['email']);
    // $r= new SalvarLogs($_SESSION['token']);

    echo json_encode(['status'=>'ok','msg'=>'logado com sucesso','nome'=>$retorno[0]['nome']]);


    $conteudo = array ($_SESSION['id_usuario'],$_SESSION['email'],$_SESSION['nome'],$hr_arquivo);

    for ($i = 0 ; $i < count($conteudo);$i++){ 
        $a1 = new SalvarLogs($conteudo[$i]) ; 
    
    }
        $a2 = new SalvarLogs("\n");

}    
}
