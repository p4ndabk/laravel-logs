<?php

namespace App\Domain\CEP;

interface CepInterface
{
    public function getCep(string $cep);
}