<?php
namespace App\classes;

use App\Domain\User\User;
use Monolog\Handler\NativeMailerHandler;
use Monolog\Handler\SendGridHandler;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\TelegramBotHandler;
use Monolog\Level;
use PhpParser\Lexer\TokenEmulator\ReadonlyTokenEmulator;

class CreateLogger {
    
   
    public function logger ($dirname ,$msg, $modo = 'info', array|string $extra = null){
        $now = new \DateTimeZone( 'America/Sao_Paulo');
        $now_form =(new \DateTime('now',$now))->format('d-m-Y');
        
        $date = $GLOBALS['days'] ?? $now_form ;
        $logger = new Logger($dirname);

        $logger->pushProcessor(function ($record) use ($extra) { 
            $record["extra"]["server"] = $extra ;
            return $record ;
        });
 
        $logger->pushHandler(new StreamHandler(dirname(__FILE__)."/../../logs/logs".$date.".csv"));
        $logger->$modo($msg);
}
    public function logTelegran($msg, $modo = 'warning', array|string $extra = null){
        $logger = new Logger('TelegranBot');
        
        $logger->pushProcessor(function ($record) use ($extra) { 
            $record["extra"]["server"] = $extra ;
            return $record ;
        });
    

        $logger->pushHandler( new TelegramBotHandler(
            apiKey:"6896066213:AAEfj5TxiJaH6m2CEsP9fJZh3BUvpPfypzw",
            channel:"@phpAplicationweb",
            level:Level::Warning
    ));
        $logger->$modo($msg);
        
       
    

} 
    public function Emaillogger(string|array $to ,string $subject , string $from) { 
        $logger = new Logger ( 'Emailloger'); 
        $logger->pushHandler(new NativeMailerHandler(
            to : $to ,
            subject : $subject , 
            from : $from ,
            level : Level::Critical

        )); 
        $logger->critical('Esta é uma mensagem de erro crítica!');
        
    }


}