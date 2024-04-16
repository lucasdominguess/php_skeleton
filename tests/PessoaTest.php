<?php

use PHPUnit\Framework\TestCase;
use App\classes\Pessoa;

class PessoaTest extends TestCase
{
    public function testConstrutorComNomeInvalido()
    {
        $this->expectException(\Exception::class);
        new Pessoa('lucas');
    }

    public function testConstrutorComNomeValido()
    {
        $pessoa = new Pessoa('lucas');
        $this->assertInstanceOf(Pessoa::class, $pessoa);
    }
}
