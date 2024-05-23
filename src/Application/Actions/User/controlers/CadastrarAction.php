<?php
namespace App\Application\Actions\User\controlers;

use App\classes\Data;

use App\classes\Usuario;
use App\Domain\User\User;
use App\classes\CreateLogger;
use App\Infrastructure\Helpers;
use App\Application\Actions\User\UserAction;
use App\Infrastructure\Persistence\User\Sql;
use Psr\Http\Message\ResponseInterface as Response;
use App\Infrastructure\Persistence\User\CreateRepository;

class CadastrarAction extends UserAction{ 
    protected function action(): Response
    {   
 
       
       


        if( URI_SERVER == URL_HOMEADM || URI_SERVER == URL_HOMEUSER){

          
            
                    $nome = $_POST['nome'];
                    $data = $_POST['data_nascimento'];
                    $idN = $_POST['id'];
            
                    $primarykey = $_POST['id'] == '' ? null : $_POST['id'];
                    $id_adm = USERID;
                    try {
                        $newdata = new Data($data);
                        $cad = new Usuario($nome,$newdata);
                       
                    } catch (\Throwable $th) {
                    
                        $resposta =['status'=>'fail','msg'=>$th->getMessage()];
                        return $this->respondWithData($resposta);
                    }
            
                    try { 
                        $stmt = new CreateRepository($this->sql);
                        $stmt->createUser($cad,$primarykey,$id_adm);

                        // $this->createLogger-> = new CreateLogger();
                        $this->createLogger->logger("CADASTRO",'Usuario: '.$_SESSION[User::USER_NAME].' Cadastrou novo adm' .$nome,'info');
                       
                     
                   }catch(\Throwable $th) { //erro caso nome ja esteja cadastrado
                       if($this->sql->errorCode()=='23000'){
                           $resposta =['status'=>'fail','msg'=>"O mesmo nome nao pode ser inserido"];
                           return $this->respondWithData($resposta);
                      
                       }
                   }
       
           
       }

            if(URI_SERVER == URL_EXIBIR_ADMIN){ 
                    $nome = $_POST['nome'] ; 
                    $email = $_POST['email'];
                    $senha = $_POST['senha'];
                    $nivel = $_POST['nivel']; 
                    $senhaCodif = password_hash($senha, PASSWORD_DEFAULT); 
                try{
                
                    $user = new CreateRepository($this->sql) ;
                    $user->createAdmin($nome,$email,$senhaCodif,$nivel);
                    $this->createLogger->logger("CADASTRO",'Usuario: '.$_SESSION[User::USER_NAME].' Cadastrou um Admin ' .$nome,'info');
                    $this->createLogger->logTelegran('Usuario: ' .$_SESSION[User::USER_NAME]. ' Cadastrou novo adm ' .$nome,"warning");
                }catch(\Throwable $e){
                    return $this->respondWithData($e);
                }

            }


        $response= ['status'=>'ok','msg'=>'Cadastro realizado!'];
        return $this->respondWithData($response);
    }

}