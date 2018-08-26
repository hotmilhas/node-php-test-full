<?php

require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use \NodePHPTest\Order;
use \NodePHPTest\BRLExchange;
$app = new Silex\Application();

$app->post('/', function(Request $request) use ($app) {
    $price = BRLExchange::getDollarPrice();
    $items = $request->get('items');
    $total = number_format(array_sum($items), 2, '.', '');
    $totalSellPrice = number_format($total * $price->value[0]->cotacaoVenda, 2, '.','');

    $order = [
        'created_at' => date('Y-m-d H:i:s'),
        'total_brl' => (float)$total,
        'total_usd' => (float)$totalSellPrice
    ];

    Order::save($order);
    return $app->json($order);
});

$app->get('/', function() use ($app) {
    $orders = Order::getAll();
    return $app->json($orders);
});

$app->run();