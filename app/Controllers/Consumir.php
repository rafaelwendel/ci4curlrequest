<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Exception;

class Consumir extends BaseController
{
    public function index()
    {
        $client = service('curlrequest');
        try{
            $response = $client->request('GET', 'http://api.local/produtos');
            $listProdutos = json_decode($response->getBody());
            foreach ($listProdutos as $produto){
                echo $produto->nome . ' - ' . $produto->valor . '<br />';
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function inserir() 
    {
        $client = service('curlrequest');
        $headers = ['token' => '123456'];
        $formParams = [
            'nome'  => 'Suco natural',
            'valor' => '6'
        ];

        try{
            $response = $client->request('POST', 'http://api.local/produtos/adicionar', [
                'headers' => $headers,
                'form_params' => $formParams
            ]);
            $data = json_decode($response->getBody());
            echo $data->msg;
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}
