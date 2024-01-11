<?php 

namespace App\Domain\Cep;

use GuzzleHttp\Client;
class ViaCep implements CepInterface
{
    public function getCep(string $cep)
    {
        $client = new Client();
        $response = $client->request('GET', 'https://viacep.com.br/ws/'.$cep.'/json/');
        $response = json_decode($response->getBody()->getContents());
        return $response;
    }
}