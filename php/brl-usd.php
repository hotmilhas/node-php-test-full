<?php

require_once __DIR__ . '/vendor/autoload.php';
use \NodePHPTest\BRLExchange;
$app = new Silex\Application();

$app->get('/', function() use ($app) {
    $price = BRLExchange::getDollarPrice();

    if(!empty($price->value)) {
        return $app->json([
            'brl' => 1,
            'usd' => (float) number_format($price->value[0]->cotacaoVenda, 2, '.', '')
        ]);
    }
    else {
        return $app->json([]);
    }
});

$app->run();