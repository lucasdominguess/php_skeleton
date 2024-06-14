<?php
namespace App\Application\Actions\User\controlers\arquivos;


use App\classes\CreateFolderUser;
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
      // $info = pathinfo($file['name'][0]);

      
      $userfolder = 'ID_0'.$_SESSION[User::USER_ID]."_". strtoupper($_SESSION[User::USER_NAME]) ; 
      
      $folder = new CreateFolderUser();
      $path = $folder->createFolder($userfolder);
      
      
      $names = $file['name'];
      // Helpers::dd($names);
      $tmp_name = $file['tmp_name'];
      $fileSize = $file['size']; 
      // $path = __DIR__ ."/../../../../files/arquivos/$userfolder";


      // $tmp_name = $file['ext'];
      // $ext2 = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
      
      
      if($_FILES['file']['error'][0] == 4 ) {
        $msg = ['status' => 'fail', 'msg' => 'Nenhum Arquivo foi enviado!'];
        return $this->respondWithData($msg);
        }
        
        foreach ($names as $index => $value) {
        
            $ext = pathinfo($names[$index], PATHINFO_EXTENSION);

            if(!in_array($ext,['png','jpg','gif','csv','txt']))
            {
              $msg = ['status' => 'fail', 'msg' => "Formato invalido! $value"];
              return $this->respondWithData($msg);
            }
             if ($fileSize[$index] >= 598812) {
                $msg = ['status' => 'fail', 'msg' => "Tamanho de arquivo excedido! $value"];
                return $this->respondWithData($msg);
          }
            // $arqName = uniqid().'.'.$ext;
            // $name = strtoupper(str_replace([" ","%"],'_',$names[$index])); 
            move_uploaded_file($tmp_name[$index],"$path/$names[$index]");
            
            $file['id_adm'][$index] = $_SESSION[User::USER_ID];
            $file['create_time'][$index]= $GLOBALS['datefullForm'];
            $file['folder'][$index]= $userfolder;
            $file['path'][$index]= $path."/";
            
            
            
            }
          try {
                $insert = new CreateRepository($this->sql);
                $insert->createArquivos($file);
          } catch (\Throwable $e) {
                  return $this->respondWithData($e);
              }
              // Helpers::dd($file['name']);
          
      $msg = ['status' => 'ok', 'msg' => 'Arquivo enviado com sucesso!'];
      return $this->respondWithData($msg);
      //salvando no banco de dados 

      // salvando em diretorio 
      // $file = new Upload($_FILES['file']);
      // $file->moveFile();



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
