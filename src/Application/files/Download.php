<?php 
namespace App\Application\files;

class Download { 
    

    public function __construct($file) 
    {
        
    }

    public function download($file){
    
            header('Content-Type : application/png'); 
            header ("Content-Disposition: attachment;filename=");
            // readfile($file);
            
}
}
    