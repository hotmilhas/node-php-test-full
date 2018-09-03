<?php

require_once 'vendor/autoload.php';

$method = $_SERVER['REQUEST_METHOD'];
$contentType = $_SERVER['HTTP_CONTENT_TYPE'];

$data = null;

switch ($method)
{
	case 'POST':
		if ($contentType == 'application/x-www-form-urlencoded' &&
			isset($_POST['items']) && is_array($_POST['items']))
		{
			$input = $_POST['items'];
			$data = makeOrder($input);
		}
		break;
	case 'GET':
		$data = getOrders();
		break;
}

header('Content-Type: application/json');
echo json_encode($data).PHP_EOL;