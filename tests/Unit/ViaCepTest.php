<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Domain\Cep\CepInterface;
class ViaCepTest extends TestCase
{
    public function testGetCep()
    {
        $cep = '01001000';
        $viaCep = $this->app->make(CepInterface::class);
        $response = $viaCep->getCep($cep);
        $this->assertEquals('São Paulo', $response->localidade);
    }
}
