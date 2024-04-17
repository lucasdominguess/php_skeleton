<?php
namespace App\Application\Actions\User\controlers;

use PDO;
use DateTime;
use DateTimeZone;
use Slim\Views\Twig;
use App\Domain\User\User;
use App\classes\ConsultaBanco;
use App\classes\BloquearAcesso;
use App\classes\VerificarEmail;
use App\classes\VerificarLogin;
use App\Application\Actions\User\UserAction;
use App\classes\IniciarSessao;
use App\Infrastructure\Persistence\User\Sql;
use Psr\Http\Message\ResponseInterface as Response; 


class LogarAction extends UserAction
{
   
    protected function action(): Response
    {  
       
        $email = $_POST['email'] ?? null;
        $senha = $_POST['senha'] ?? null;

        // return $this->respondWithData(['recebido'=>1,"email"=>$email]);
        
        try{

            $db = new Sql();
        }catch(\Throwable $e){ 
            $response = (['status'=>'fail','msg'=> 'Erro de Conexao']);
            return $this->respondWithData($response);
        }

        // Verificando se Email e senha estao em branco 
        if($email == null || $senha == null)
        {
            $response = ['status' => 'fail', 'msg' => 'Usuario ou Senha não podem estar vazios'];
            return $this->respondWithData($response);
        }
        // verificando se o padrao de email capturado é valido
        if (!preg_match("/^([a-zàáâãçèéêìíîòóôõùúû'_.]{4,}@[\w]{5,10}\.(sp|com)(.gov)?(.br)?|root)$/im", $email))
        {   //Regex para validar formado de nome com min. de 3
            $response= (['status' => 'fail', 'msg' => 'Email Inválido!']);
            return $this->respondWithData($response);
            exit();
        }

    // Verificando se email e senha correspondem a um cadastro valido 
    $stmt=$db->prepare("Select * from usuarios where email = :email");
    $stmt->bindValue(":email",$email);
    $stmt->execute();
   
        $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!isset($retorno[0]['id_adm'])||!password_verify($senha,$retorno[0]['senha']))
            {   
                $block = new BloquearAcesso($email,$db); 

                $res=$block->bloqueio($email,$db);
                


                switch ($res){ 
                    case $res === 1 : 
                        $response= (['status'=>'fail','msg'=>'Usuario ou Senha invalida']);
                        return $this->respondWithData($response);
                        break;
                      

                    case $res === 2 : 
                        $response= (['status'=>'fail','msg'=>'Acesso Negado Aguarde 10 minutos']);
                        return $this->respondWithData($response);
                        break;

                // endswitch;
                }
               
            }

            //    $usersession = new IniciarSessao($retorno[0]['nome'],$retorno[0]['email']); 
            //  session_start();
                // @session_start();
                // // Iniciar sessão 

                // @session_start();
                $_SESSION['email'] = $retorno[0]['email'];
                $user = new User($retorno[0]['id_adm'],$retorno[0]['nome'],$retorno[0]['email']);
                
                // $_SESSION['nome']=$user::USER_NAME;
                // $_SESSION['datasessao']=$user::USER_DATE;

             
                $response= ['status'=>'ok','msg'=>'logado com sucesso','location'=>'home'];
                return $this->respondWithData($response);



    }
  
}