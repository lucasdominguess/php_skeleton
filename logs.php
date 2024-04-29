<?php

// use Monolog\Handler\BrowserConsoleHandler;
// use Monolog\Handler\Handler;
// use Monolog\Level;
// use Monolog\Logger;
// use Monolog\Handler\StreamHandler;

// // create a log channel
// $logger = new Logger(name : 'web');
// $logger->pushHandler(new BrowserConsoleHandler(Level::Debug));

// // add records to the log
// // $logger->warning('Foo');
// // $logger->error('Bar');
// $logger->debug("testanto msg logs",[$_SERVER]);

// [12:08] Rodrigo Soares Pimenta

use App\Domain\User\User;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\SendGridHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
 
require __DIR__ . "/vendor/autoload.php";

//Exibindo log no navegador   
$logger = new Logger(name: "web");
$logger->pushHandler(new BrowserConsoleHandler(Level::Debug));
$logger->pushHandler( new StreamHandler( stream: __DIR__ . "/log.txt", level: level::Debug));
$logger->pushHandler(new SendGridHandler(
    User::USER_NAME,
    User::USER_EMAIL,
    from: 'noreply@upins.com.br',
    to: 'lucasdomingues25.dev@gmail.com',
    subject: 'error subject' . date(format: "d/m/Y H:i:s"),
    level: Level::Debug 
));
//DEBUG
$logger->debug("debug!",['chave'=>'valor']);

//FILE
$logger->warning("warning!",['chave'=>'valor']);
$logger->error("error!",['chave'=>'valor']);

//Email 

$logger->critical("Critical!",['chave'=>'valor']);
$logger->alert("Alert!",['chave'=>'valor']);