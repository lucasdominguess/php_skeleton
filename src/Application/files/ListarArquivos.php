<?php 



// $pasta = "C:/Users/x492420/OneDrive - rede.sp/Área de Trabalho/php_skeleton/src/Application/files/arquivos ";
$pasta = __DIR__ ."/arquivos";

// chmod(__DIR__.'/../files',0755);
    // if(!is_dir($pasta)) {

    //     mkdir($pasta,0755);


    // }
$nome_arquivo = date('Y-m-d-H-i-s') . ".csv" ; 
$arquivo = fopen($nome_arquivo,"w+");
fwrite($arquivo , 'Linha 1' . PHP_EOL);
fwrite($arquivo , 'Linha 2' . PHP_EOL);
fclose($arquivo);
$move_arquivo = "$pasta/$nome_arquivo" ; 
rename($nome_arquivo,$move_arquivo); 
echo $move_arquivo ;
// $arquivos = scandir($pasta);
// // foreach ($arquivos as $arquivo) {
// //    echo "$arquivo . \n ";
// // };
// print_r($pasta) ; 
// $diretorio = dir($pasta);
// while(($arquivo = $diretorio->read()) !== false) {
//  echo $arquivo."<br>";
// }