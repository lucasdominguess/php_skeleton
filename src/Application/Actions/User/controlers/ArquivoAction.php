<?php
namespace App\Application\Actions\User\controlers;


use ZipArchive;

use App\Application\files\Upload;
use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface;

class ArquivoAction extends Action { 

    protected function action(): ResponseInterface
    {
   
      if($_FILES['file']['error'] == 4 ) {
        $msg = ['status' => 'fail', 'msg' => 'Nenhum Arquivo foi enviado!'];
        return $this->respondWithData($msg);
      }
      
      $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

      if(!in_array($ext,['png','jpg','gif','mp4','wmv']))
      {
        $msg = ['status' => 'fail', 'msg' => 'Formato invalido!'];
        return $this->respondWithData($msg);
      }
            
      $file = new Upload($_FILES['file']);
      $file->upload(__DIR__ ."./../../../files/arquivos/");

      $msg = ['status' => 'ok', 'msg' => 'Arquivo enviado com sucesso!'];
      return $this->respondWithData($msg);







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
