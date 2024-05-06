<?php
namespace App\Application\files;

use App\Application\Actions\Action;
use App\Application\files\Upload;
use Psr\Http\Message\ResponseInterface;
use ZipArchive;

class ArquivoAction extends Action { 

    protected function action(): ResponseInterface
    {
   
      if($_FILES['file']['error'] == 4 ) {
        return $this->respondWithData('Nenhum arquivo foi enviado!');
      }
      
      $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

      if(!in_array($ext,['png','jpg','gif','mp4','wmv']))
      {
        return $this->respondWithData('Formato invalido!');
      }
            
            $file = new Upload($_FILES['file']);
            $file->upload(__DIR__.'/');

            // return $this->respondWithData($file['name']);

    

    }
            
    
     
        // $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        // $file = new Upload($_FILES['file']); 
        // $sucesso = $file->upload(__DIR__.'/');
    
        // if($sucesso){
        //     return $this->respondWithData('arquivo enviando com sucesso '.$ext);
        // }
        // if( $ext == 'jpg')
        // {   

            
            
                
                // }

        // }
        
}
