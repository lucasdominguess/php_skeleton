<?php
namespace App\Application\Actions\sender;



use Slim\Psr7\Response;
use App\Domain\User\User;

final class HandleSenderAction extends SenderAction
{
    protected function Action():Response
    { 
        $name = $_SESSION[User::USER_NAME]; 
        $id_adm = $_SESSION[User::USER_ID]; 
        $nivel = $_SESSION[User::USER_NIVEL];
        
        if (!isset($id_adm) || !isset($nivel)) {
      
            return $this->response->withHeader("Location","/")->withStatus(302);
        }

        switch ($nivel) {
            case  5:
                return $this->response->withHeader("location","/admin/home_adm")->withStatus(302);
             
            case 2:
                return $this->response->withHeader("location","/user/home_user")->withStatus(302);
            case 1:

                $msg = json_encode(['status'=> 'fail', 'msg'=>'Cadastro aguardando Aprovação']);
                $newmsg = urlencode($msg);
                return $this->response->withHeader("location","/?msg=$newmsg")->withStatus(307);
            case 0:
                $msg = json_encode(['status'=> 'fail', 'msg'=>'Seu cadastro não foi aprovado!']);
                $newmsg = urlencode($msg);
                return $this->response->withHeader("location","/?msg=$newmsg")->withStatus(307); 
                
            default:
                $msg = json_encode(['status'=> 'fail', 'msg'=>'Serviço Indisponivel']);
                $newmsg = urlencode($msg);
                return $this->response->withHeader("location","/?msg=$newmsg")->withStatus(307); 
        }

    }
    
}