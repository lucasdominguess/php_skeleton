<?php
namespace App\Application\Actions\User\controlers;

use App\classes\Data;

use App\classes\Usuario;
use App\Application\Actions\Action;
use App\Application\Actions\User\UserAction;
use App\classes\CriarSenha;
use App\Infrastructure\Persistence\User\CreateRepository;
use App\Infrastructure\Persistence\User\Sql;
use Psr\Http\Message\ResponseInterface as Response;

class CadastrarAction extends UserAction{ 
    protected function action(): Response
    {   
        $url = URI_SERVER ;
        $db = new Sql();    

        if($url == null ){

                $response= ['status'=>'fail','msg'=>'PAGINA 404'];
                return $this->respondWithData($response);
        }

        if($url == URL_HOMEADM || $url == URL_HOMEUSER){


            
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
                        $stmt = new CreateRepository($db);
                        $stmt->createUser($cad,$primarykey,$id_adm);
                     
                   }catch(\Throwable $th) { //erro caso nome ja esteja cadastrado
                       if($db->errorCode()=='23000'){
                           $resposta =['status'=>'fail','msg'=>"O mesmo nome nao pode ser inserido"];
                           return $this->respondWithData($resposta);
                           exit();
                       }
                   }
       
           
       }

       if($url == URL_EXIBIR_ADMIN){ 
        $nome = $_POST['nome'] ; 
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $nivel = $_POST['nivel']; 
        $senhaCodif = password_hash($senha, PASSWORD_DEFAULT); 
        try{
           
            $user = new CreateRepository($db) ;
            $user->createAdmin($nome,$email,$senhaCodif,$nivel);
        }catch(\Throwable $e){
            return $this->respondWithData($e);
        }

       }


        $response= ['status'=>'ok','msg'=>'Cadastro realizado!'];
        return $this->respondWithData($response);
    }

}