<?php 
namespace App\Application\files;

use App\Infrastructure\Helpers;

class Upload { 
   
    private $name ; 
    private $extension; 
    private $tmpName; 
    private $error;
    private $size ;  
    private $type ; 
    
    public function __construct($file){

        $this->type =$file['type'];
        $this->tmpName = $file['tmp_name'];
        $this->error= $file['error']; 
        $this->size=$file['size'];

        $info = pathinfo($file['name']);
        $this->name = $info['filename'];
        $this->extension =  pathinfo($file['name'],PATHINFO_EXTENSION);
    }
    public function getBasename(){

        /**
         * retorna nome do arquivo com sua extensao 
         */
        $extension = strlen($this->extension) ? '.' .$this->extension : '' ;
        // Helpers::dd($r);

        return $this->name.$extension ; 
    }
        
    public function moveFile(){

    /**
     * Move arquivo para diretorio /arquivos 
     */
      
        $path =__DIR__.'/arquivos/'.$this->getBasename(); 
        // $path =__DIR__.'/arquivos/'.$this->name.$this->extension; 

        // Helpers::dd($path);
        return move_uploaded_file($this->tmpName,$path) ;
    }

}