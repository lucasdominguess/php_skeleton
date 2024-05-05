<?php
namespace App\Application\files;

use App\Application\Actions\Action;
use App\Application\files\Upload;
use Psr\Http\Message\ResponseInterface;

class ArquivoAction extends Action { 

    protected function action(): ResponseInterface
    {
        
        if(isset($_FILES))
        {
            $file = new Upload($_FILES['file']); 
        //   $r =  $r['file']['name'];
            
            // return $this->respondWithData(print_r($file));
            return $this->respondWithData(print_r($_FILES['file']));
            // return $this->respondWithData($_FILES);
            // return $this->respondWithData($_FILES['file']['name']); 
            $sucesso= $file->upload(__DIR__.'/files');
            if($sucesso){
                
            }
        }
        

    }
}
