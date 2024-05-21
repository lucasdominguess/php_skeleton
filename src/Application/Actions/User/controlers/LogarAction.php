<?php
namespace App\Application\Actions\User\controlers;

use App\Infrastructure\Helpers;
use PDO;
use App\classes\Token;
use App\Domain\User\User;
use App\classes\CreateLogger;
use App\classes\BloquearAcesso;
use App\Application\Actions\User\UserAction;
use App\Infrastructure\Persistence\User\Sql; // 
use App\Infrastructure\Persistence\User\RedisConn;
use Psr\Http\Message\ResponseInterface as Response;


class LogarAction extends UserAction
{
    protected function action(): Response
    {


        $email = $_POST['email'] ?? null;
        $senha = $_POST['senha'] ?? null;



    
        // Verificando se Email e senha estao em branco 
        if ($email == null || $senha == null) {
            $response = ['status' => 'fail', 'msg' => 'Usuario ou Senha não podem estar vazios'];
            return $this->respondWithData($response);
        }
        // verificando se o padrao de email capturado é valido
        if (!preg_match("/^([a-zàáâãçèéêìíîòóôõùúû'_.]{4,}@[\w]{5,10}\.(sp|com)(.gov)?(.br)?|root)$/im", $email)) {   //Regex para validar formado de nome com min. de 3
            $response = (['status' => 'fail', 'msg' => 'Email Inválido!']);
            return $this->respondWithData($response);
            // exit();
        }



        // Verificando se email e senha correspondem a um cadastro valido 
        $stmt = $this->sql->prepare("Select * from usuarios where email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!isset($retorno[0]['id_adm']) || !password_verify($senha, $retorno[0]['senha'])) {
            $block = new BloquearAcesso(); //somente quando usuario errar email e senha 

            $res = $block->bloqueio($email, $this->sql);


            //tratando resposta vinda de bloqueio 
            switch ($res) {
                case $res === 1: 
                    $response = (['status' => 'fail', 'msg' => 'Usuario ou Senha invalida']);
                    return $this->respondWithData($response)->withStatus(401);
          


                case $res === 2:
                    $response = (['status' => 'fail', 'msg' => 'Acesso Negado Aguarde 10 minutos']);
                    return $this->respondWithData($response)->withStatus(401);
            

                       }
                    }
        //criando instancia do redis e verificando se ja existe um usuario logado 

        // try {

        // $redis = new RedisConn(); 
        // } catch (\Throwable $e) {
        //     $this->createLogger->logger('Erro Redis','Erro ao conectar em Redis','warning');
        //     $response = (['status'=>'fail','msg'=> $e->getMessage()]);
        //     return $this->respondWithData($response);
        // }

        $redis_user = $this->redisConn->hget($email, 'email');
            if ($redis_user) {
                $response = (['status' => 'fail', 'msg' => 'Usuario ja esta logado']);
                $this->createLogger->logger("Duplicidade de Sessão", "Tentativa de multiplos acessos $email ", 'warning', IP_SERVER);
                return $this->respondWithData($response);
            }
        // }

        //criando dados do User 
        $user = new User($retorno[0]['id_adm'], $retorno[0]['nome'], $retorno[0]['email'], $retorno[0]['nivel']);


        $_SESSION[User::USER_ID] = $user->id_adm;
        $_SESSION[User::USER_NAME] = $user->nome;
        $_SESSION[User::USER_EMAIL] = $user->email;
        $_SESSION[User::USER_NIVEL] = $user->nivel;
   
        // criando dados do usuario no redis
        $this->redisConn->hset($_SESSION[User::USER_EMAIL], 'name', $_SESSION[User::USER_NAME]);
        $this->redisConn->hset($_SESSION[User::USER_EMAIL], 'email', $_SESSION[User::USER_EMAIL]);
        $this->redisConn->hset($_SESSION[User::USER_EMAIL], 'nivel', $_SESSION[User::USER_NIVEL]);
        $this->redisConn->expire($_SESSION[User::USER_EMAIL], 3600);

     
        // gerando loggers 
        $this->createLogger->logger("LOGIN",'Usuario: '.$_SESSION[User::USER_NAME].' Realizou Login ','info',IP_SERVER);
                // $this->createLogger->loggerProcessor();
                // $this->createLogger->logTelegran($_SESSION);
                
                // criando token do usuario
        $token = new Token($_SESSION[User::USER_EMAIL],"+1 minutes");




        $response = ['status' => 'ok', 'msg' => 'logado com sucesso','location'=>'/sender'];

        return $this->respondWithData($response);



    }
}