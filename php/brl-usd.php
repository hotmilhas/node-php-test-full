<?php

$url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)?@dataCotacao=%2707-20-2018%27&$top=100&$format=json';


$param = [
    "http" => [
        "method" => "GET",
        "header" => "Cache-Control: max-age=14400"
    ]
];

$context = stream_context_create($param);
$f = file_get_contents($url, false, $context);
$json = json_decode($f);

$jsonEconde = array('brl'=>1, 'usd'=>$json->value[0]->cotacaoCompra);

echo json_encode($jsonEconde);
