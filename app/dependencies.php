<?php

declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use App\classes\CreateLogger;
use App\Infrastructure\Persistence\User\Sql;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([

        //logger padrao slim 
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;


        },
        // sql connection 
        Sql::class => function (ContainerInterface $c) {
            try {
                return new Sql;
          
            } catch (\PDOException $e){ 
           $response = json_encode(['status'=>'fail','msg'=> $e->getMessage()]);
           return $response; 
        }
    },

        // CreateLogger::class => function (ContainerInterface $c) { 
        //     try {
        //         return new CreateLogger ; 
        //     } catch (\Throwable $e) {
        //         $response = json_encode(['status'=>'fail','msg'=> 'Nao foi possivel criar logger']);
        //         return $response; 
         
        //     }
        // }

    ]);
};
