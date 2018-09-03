<?php

use GuzzleHttp\Client;
use Josantonius\Session\Session;

Session::init(3600);

function getQuotation()
{
	$json = fetchQuotation();
	$result = json_decode($json);
	return parseQuotation($result);
}

function fetchQuotation()
{
	$client = new Client();
	$url = "https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)?@dataCotacao='07-20-2018'&$top=100&$format=json";
	$response = $client->request('GET', $url);
	return $response->getBody()->getContents();
}

function parseQuotation($data)
{
	$value = $data->value[0]->cotacaoCompra;
	$brl = 1;
	$usd = $brl/$value;
	return compact('brl', 'usd');
}

function formatQuotation($data)
{
	return array_map(function($value) {
		return round($value, 2);
	}, $data);
}

function getOrders()
{
	return (array) Session::get('orders');
}

function makeOrder($items)
{
	$orders = getOrders();
	$id = sizeof($orders)+1;
	$createdAt = new DateTime();
	$dolarRatio = 0.264145454545455;
	$totalBRL = array_sum($items);
	$totalUSD = round($totalBRL*$dolarRatio, 2);
	$newOrder = compact('id', 'createdAt', 'totalBRL', 'totalUSD');
	array_push($orders, $newOrder);
	Session::set('orders', $orders);
	return $newOrder;
}