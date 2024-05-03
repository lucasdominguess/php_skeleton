<?php

use App\Application\files\Upload;

if(isset($_FILES))
{
    $file = new Upload($FILE); 
    print_r($file);

}