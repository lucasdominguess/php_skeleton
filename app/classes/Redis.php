<?php

class redisConn extends \Redis 
{      
    private string $host;
    private int $port;
    function __construct()
    {   
        $config = parse_ini_file(__DIR__.'/config.ini', true);
        
        $this->host = $config['redis']['redis_host'];
        $this->port =$config['redis']['redis_port'];
        $this->connect($this->host, $this->port);
    }
}



$batata = new redisConn();
$batata->hset('estagiario','nome_do_estagiario','rodrigo o bruxo do front-end');