<?php 
namespace App\Application\files;



class Upload { 
   
   /**
    * Nome do arquivo (sem etensão)
    *@var  string
    */

    private $name ; 

    /**
    * Extesao do aquivo 
    * @var string
    */
    private $extension; 

    /**
     * Nome temporario/caminho temporario do arquivo 
     * @var 
     */
    private $tmpName; 
    /**
     * Codigo de erro do Upload
     * @var integer 
     * 
     */
    private $error;
    /** 
     * Tamanho do arquivo 
     * @var integer 
     */
    private $size ; 

    private $type ; 
    /**
     * constructor da classe 
     * @param array $file $_FILES[campo]
     */
    public function __construct($file){

        $this->type =$file['type'];
        $this->tmpName = $file['tmp_name'];
        $this->error= $file['error']; 
        $this->size=$file['size'];
    }
    
        
    
}