<?php

require_once 'vendor/autoload.php';

use PHLAK\Stash;

$stash = Stash\Cache::make('file', function() {
    return ['dir' => __DIR__.'/cache'];
});

$data = $stash->get(CACHE_KEY);

if (empty($data))
{
	$data = getQuotation();
	$stash->put(CACHE_KEY, $data, 60*CACHE_TTL_IN_HOURS);
}

$data = formatQuotation($data);

header('Content-Type: application/json');
echo json_encode($data).PHP_EOL;
