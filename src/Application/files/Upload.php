<?php 
namespace App\Application\files;



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
        $this->extension = $info['extension'];
    }
    
        
    public function upload($dir){
        if($this->error != 0) return false;
    }
}