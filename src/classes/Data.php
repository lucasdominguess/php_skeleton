<?php

namespace App\classes;
use DateTime;


class Data
{
    private DateTime $data;

    public function __construct(string $data)
    {
        $this->setData($data);
    }

    private function setData(string $data): void
    {
        if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/im",$data)) {
            // print_r("aqui print ".$data);
            throw new \Exception("Erro! Formato de data invalida.");
        }



        $this->data = new DateTime($data);
        
    }

    public function getData(): DateTime
    {   
        return $this->data;
    }
}


