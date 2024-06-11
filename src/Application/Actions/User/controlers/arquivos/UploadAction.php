<?php
namespace App\Application\Actions\User\controlers\arquivos;


use ZipArchive;
use App\Domain\User\User;

use App\Infrastructure\Helpers;
use App\Application\files\Upload;
use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface;
use App\Infrastructure\Persistence\User\CreateRepository;

class UploadAction extends Action { 

    protected function action(): ResponseInterface
    {   
      

      $file = $_FILES['file']; 
      

      // $ext2 = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
      // Helpers::dd($file);
    
      
      if($_FILES['file']['error'] == 4 ) {
        $msg = ['status' => 'fail', 'msg' => 'Nenhum Arquivo foi enviado!'];
        return $this->respondWithData($msg);
      }
      // if ($_FILES['size'] >= 6291456) {
      //   $msg = ['status' => 'fail', 'msg' => 'Tamanho de arquivo excedido!'];
      //   return $this->respondWithData($msg);
      // }
      
      $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

      if(!in_array($ext,['png','jpg','gif','csv','txt','pdf']))
      {
        $msg = ['status' => 'fail', 'msg' => 'Formato invalido!'];
        return $this->respondWithData($msg);
      }
      //salvando no banco de dados 
      try {
       
        $file['id_adm'] = $_SESSION[User::USER_ID];
        $file['create_time']= $GLOBALS['datefullForm'];
        $insert = new CreateRepository($this->sql);
        $insert->createArquivos($file);
      } catch (\Throwable $e) {
          return $this->respondWithData($e);
      }

      // salvando em diretorio 
      $file = new Upload($_FILES['file']);
      $file->moveFile();


      $msg = ['status' => 'ok', 'msg' => 'Arquivo enviado com sucesso!'];
      return $this->respondWithData($msg);

      // Fazer upload em pastas de acordo com a extensao do arquivo 
        // if(in_array($ext, ['png','jpg','gif'])){
        //   // $pastaArquivos = __DIR__ ."./../../../files/arquivos";  
        //   // $pastaImg = __DIR__ ."./../../../files/arquivos/imagens"; 
        //     // chmod(__DIR__ ."./../../../files/arquivos",0755);
        //     // mkdir($pastaArquivos,0755);
          
        //   $file->upload(__DIR__ ."./../../../files/arquivos/imagens");

        // }
        // if(in_array($ext, ['pdf','xls'])){
          //   $file->upload(__DIR__ ."./../../../files/arquivos/planilhas");
          // }
          // if(in_array($ext, ['csv','txt',''])){
            //   $file->upload(__DIR__ ."./../../../files/arquivos");
        // }    
  






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
