<?php 
require 'Pessoa.php';


class Estagiario extends Pessoa
    {
        public function __construct($nome, public readonly Data $data) 
        {
            $this->nome = $nome; 
            $this->validaRegra();
        }
        public function validaRegra()
        {   
            $datenow = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
            $datanowform = $datenow->format('Y-m-d');
            

            $date = $this->data->getData();
            // $data3form = $date->format('Y-m-d');
            
            $intervalo = $datenow->diff($date);
            
            $resultado = $intervalo->format("%a");
            // $res2 = $resultado->format('Y-m-d');
            
        
            $resultado = $resultado/365.25;
            $res= intval($resultado);
            if($res < 18 || $res > 50){
                throw new Exception("Idade invalida Para Estagio"); 
            }
            
            parent::__construct($this->nome,$this->data);
        }
}