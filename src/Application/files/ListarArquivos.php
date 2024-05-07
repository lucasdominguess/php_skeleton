<?php 



$pasta = "C:/Users/x492420/OneDrive - rede.sp/Área de Trabalho/php_skeleton/src/Application/files/arquivos ";

$arquivos = scandir($pasta);
// foreach ($arquivos as $arquivo) {
//    echo "$arquivo . \n ";
// }
print_r($arquivos) ; 
// $diretorio = dir($pasta);
// while(($arquivo = $diretorio->read()) !== false) {
//  echo $arquivo."<br>";
// }