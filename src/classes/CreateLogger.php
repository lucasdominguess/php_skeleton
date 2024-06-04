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
   
        $date = $GLOBALS['days'];
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
    // public function logEmail () { 
    //     $logger = new Logger('LogEmail'); 
    //     $logger->setHandlers( new SendGridHandler(
            
    //          'tFDsDNNwTTSrcs53EploOQ',
    //         // 'US80e513d3d8481861521c14afc98b6d14',
    //         // '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',
    //         from: 'lucasdomingues25.dev@gmail.com' ,
    //         to: "lucasdomingues25.dev@gmail.com" ,
    //         subject: "ERRO LOGGS" , 
    //         level: Level::Warning
    //     ));
    // }
 

}