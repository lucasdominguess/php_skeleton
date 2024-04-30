<?php
namespace App\classes;


use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class CreateLogger {


function logger ($dirname ,$msg, $modo = 'info'){
    $logger = new Logger($dirname);
    $logger->pushHandler(new StreamHandler(dirname(__FILE__).'/logs.txt'));
    $logger->$modo($msg);


// if($modo == 'info'){
    //     $logger->info($msg);
    //     return ;
    // }
 
    // switch ($modo) {
    //     case 'info':
    //         $logger->info($msg);
    //       break;
    //     case 'warning':
    //         $logger->warning($msg);
    //         break;
    //     case 'error':
    //         $logger->error($msg);
    //         break;
    //     case 'debug':
    //         $logger->debug($msg);
    //         break;
    //     case 'notice':
    //         $logger->notice($msg);
    //         break;
    //     case 'critical':
    //         $logger->critical($msg);
    //         break;
    //     case 'alert':
    //         $logger->alert($msg);
    //         break;
    //     case 'emergency':
    //         $logger->emergency($msg);
    //         break;
       
    //     default:
    //         $logger->info($msg);
    //         break;
    }
}
