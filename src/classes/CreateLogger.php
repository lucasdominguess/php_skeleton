<?php
namespace App\classes;

use App\Domain\User\User;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\TelegramBotHandler;
use Monolog\Level;

class CreateLogger {
    
   
    public function logger ($dirname ,$msg, $modo = 'info'){
    $date = $GLOBALS['days'];
    $logger = new Logger($dirname);
    $logger->pushHandler(new StreamHandler(dirname(__FILE__)."/../../logs/logs".$date.".csv"));
    $logger->$modo($msg);
}
    public function logTelegran(){
    $logger = new Logger('TelegranBot');
    $logger->pushHandler( new TelegramBotHandler(
        apiKey:"6896066213:AAEfj5TxiJaH6m2CEsP9fJZh3BUvpPfypzw",
        channel:"@phpAplicationweb",
        level:Level::Warning
    ));
    $logger->warning('Administrador '.$_SESSION[User::USER_NAME].  ' efetuou login');
} 
}