<?php
namespace App\Application\Actions\User\controlers\arquivos;



use App\Application\Actions\Action;
use App\Infrastructure\Helpers;
use phpDocumentor\Reflection\Types\This;
use PhpParser\Node\Expr\Throw_;
use Slim\Psr7\Stream;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

use function PHPUnit\Framework\fileExists;

class DownloadAction extends Action


{
    public function action(): Response
    {   
        $filename =  $_GET['id'] ?? '';
        // $filename = $this->request->getQueryParams()['filename'] ?? '';
        // Helpers::dd($filename);



        if(empty($filename)){ 
            throw new HttpBadRequestException($this->request, 'Nome do arquivo invalido');
        }

        // __DIR__."/../../../files/arquivos"
        $filepath = realpath(__DIR__ ."/../../../files/arquivos/$filename");
        $filepath = realpath(__DIR__ ."/../);
      
;
        
        if (!file_exists($filepath)) {
            throw new HttpNotFoundException($this->request, "Arquivo nao encontrado ");
        }

        $fileStream = fopen($filepath, 'r');
        $stream = new Stream($fileStream);
        // $fileName = mb_convert_encoding(basename($filename), 'UTF-8');
        $fileName = mb_convert_encoding($filepath, 'UTF-8');
        $mimeType = mime_content_type($filepath);
        // $fileSize = (string) $item->getSize();
        $fileSize = filesize($filepath);

        return $this->response
            ->withBody($stream)
            ->withHeader('Content-Disposition', 'attachment;filename=' . rawurlencode($fileName))
            // ->withHeader('Content-Disposition', 'attachment; filename="' . rawurlencode($fileName) . '"')
            ->withHeader('Content-Type', $mimeType)
            ->withHeader('Content-Length', (string)$fileSize)
            ->withStatus(200);

        // $this->response->withHeader('Content-Type', 'application/octet-stream');
        // $this->response->withHeader('Content-Disposition', 'attachment; filename=' . basename($filename));


        // return $this->response->withBody($stream);



    }
// {
//     public function action(): Response
//     {
//         $filename = $this->args['filename'] ?? '';

//         if(empty($filename)){ 
//             throw new HttpBadRequestException($this->request, 'Nome do arquivo invalido');
//         }

//         $filepath = realpath(__DIR__ . "/arquivos/$filename");
//         // die(var_dump($filepath,file_exists($filepath)));
        


//         if (!file_exists($filepath)) {
//             throw new HttpNotFoundException($this->request, "Arquivo nao encontrado ");
//         }



//         $fileStream = fopen($filepath, 'r');
//         $stream = new Stream($fileStream);
//         $fileName = mb_convert_encoding($filepath, 'UTF-8');
//         $mimeType = mime_content_type($filepath);
//         // $fileSize = (string) $item->getSize();

//         return $this->response
//             ->withBody($stream)
//             ->withHeader('Content-Disposition', 'attachment;filename=' . rawurlencode($fileName))
//             ->withHeader('Content-Type', $mimeType)
//             // ->withHeader('Content-Length', $fileSize)
//             ->withStatus(200);

//         // $this->response->withHeader('Content-Type', 'application/octet-stream');
//         // $this->response->withHeader('Content-Disposition', 'attachment; filename=' . basename($filename));


//         // return $this->response->withBody($stream);



//     }
}