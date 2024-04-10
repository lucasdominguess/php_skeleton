<?php
namespace App\Application\Actions\User\controlers;

use App\classes\Data;

use App\classes\Usuario;
use App\Application\Actions\Action;
use App\Application\Actions\User\UserAction;
use App\Infrastructure\Persistence\User\Sql;
use Psr\Http\Message\ResponseInterface as Response;

class CadastrarAction extends UserAction{ 
    protected function action(): Response
    {
        $nome = $_POST['nome'];
        $data = $_POST['data_nascimento'];
        $idN = $_POST['id'];
        $primarykey = $_POST['id'] == '' ? null : $_POST['id'];
        $id_adm = 4;
        try {
            $newdata = new Data($data);
            $cad = new Usuario($nome,$newdata);
        } catch (\Throwable $th) {
        
            $resposta =['status'=>'fail','msg'=>$th->getMessage()];
            return $this->respondWithData($resposta);
        
        }
        $db = new Sql();                                    
        $stmt=$db->prepare("insert into estagiarios (id,nome,data_nascimento,id_adm) values(:id,:nome,:data,:id_adm) on duplicate key update nome=:nome,data_nascimento=:data");
        $var=[':nome'=>strtoupper(trim($cad->nome)),':data'=>$cad->data->getData()->format("Y-m-d"),':id'=>$primarykey,':id_adm'=>$id_adm];
        $db->setParms($stmt,$var);

        try { 
            $stmt->execute();
       }catch(\Throwable $th) { //erro caso nome ja esteja cadastrado
           if($stmt->errorCode()=='23000'){
               $resposta =['status'=>'fail','msg'=>"O mesmo nome nao pode ser inserido"];
               return $this->respondWithData($resposta);
               exit();
           }
       
       
           
       }




        $response= ['status'=>'ok','msg'=>'Cadastro realizado!'];
        return $this->respondWithData($response);
    }

}