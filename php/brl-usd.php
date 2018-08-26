<?php

require_once __DIR__ . '/vendor/autoload.php';
use \NodePHPTest\BRLExchange;
$app = new Silex\Application();

$app->get('/', function() use ($app, $urlAPI) {
    $price = BRLExchange::getDollarPrice();

    return $app->json([
        'brl' => 1,
        'usd' => (float) number_format($price->value[0]->cotacaoVenda, 2, '.', '')
    ]);
});

$app->run();