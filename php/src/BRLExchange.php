<?php
namespace NodePHPTest;
class BRLExchange
{
    protected static $urlAPI = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)';

    public static function getDollarPrice()
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', SELF::$urlAPI, [
                'query' => [
                    '@dataCotacao' => "'07-20-2018'",
                    '$top' => '100',
                    '$format' => 'json'
                ]
            ]);

            $price = json_decode($response->getBody()->getContents());
            return $price;
        }
        catch(\Exception $e) {
            die();
        }
    }
}