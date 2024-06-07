<?php
function gerar_palavra_aleatoria($tamanho) {
    // $hash = '$2y$10$d3wjciy195Z25L1AK0fBX.vyC0NyDDi6uLEXi8iGVD6kQzM.Gq6x2';
    $hash = '$2y$10$z6uwZWX0YFMELzZ7gvGsYu8GqnEoeIRGYmGyLtdlyCOnOLY.QRscC';
    $caracteres = 'abcdefghijklmnopqrstuvwxyz1234567890';
   
    do {
        $palavra = '';
        for ($i = 0; $i < $tamanho; $i++) {
            $palavra .= $caracteres[rand(0, strlen($caracteres) - 1)];
            $qtd =+1 ;
        }
        $hash1 = password_verify($palavra, $hash);
        var_dump($hash1);
        var_dump($palavra);
    } while (!$hash1);
    
    echo "A senha correta é: " . $palavra . "\n  Foram feitas $qtd tentativas $i";
    return $palavra;
}
 
gerar_palavra_aleatoria(8);