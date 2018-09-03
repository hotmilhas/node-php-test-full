<?php

require_once 'vendor/autoload.php';

header('Content-Type:text/plain; charset=UTF-8');
date_default_timezone_set('America/Sao_Paulo');

use Parking\ParkingLot;
use Parking\Spot;
use Parking\Vehicle;
use Parking\Employee;

// Build a Parking
$parking = new ParkingLot('Blue Parking');
$parking->setAddress('Blue St, 50');
$parking->setPrices([
	'Hour' => 5.00,
	'Day' => 50.00,
	'Month' => 50.00,
]);
$parking->setBusinessHours([
	'Sun' => ['05:00 AM' => '12:00 PM'],
	'Mon' => ['05:00 AM' => '12:00 PM', '02:00 PM' => '11:00 PM'],
	'Tue' => ['05:00 AM' => '12:00 PM', '02:00 PM' => '11:00 PM'],
	'Wed' => ['05:00 AM' => '12:00 PM', '02:00 PM' => '11:00 PM'],
	'Thu' => ['05:00 AM' => '12:00 PM', '02:00 PM' => '11:00 PM'],
	'Fri' => ['05:00 AM' => '12:00 PM', '02:00 PM' => '11:00 PM'],
	'Sat' => ['05:00 AM' => '12:00 PM'],
]);
$parking->addEmployee(new Employee('A. Joe'));
$parking->addEmployee(new Employee('B. Joe'));
$parking->addEmployee(new Employee('C. Joe'));

// Set Random Spots
$repair = [29, 32];
foreach (range(1, 50) as $spotNumber)
{
	$tags = [];
	$state = Spot::AVAILABLE;

	if ($spotNumber % 2 === 0 && $spotNumber <= 10)
	{
		array_push($tags, 'accessibility');
	}

	if ($spotNumber <= 20 OR $spotNumber >= 30)
	{
		array_push($tags, 'covered');
	}

	if (in_array($spotNumber, $repair))
	{
		$state = Spot::BUSY;
	}

	$parking->addSpot(new Spot($spotNumber, $state, $tags));
}

// Parking Operation
if ($parking->isOpened())
{
	$vehicle1 = new Vehicle('123', 'model a');
	$vehicle2 = new Vehicle('456', 'model b');
	$vehicle3 = new Vehicle('789', 'model c');

	$parking->parkVehicle($vehicle1);
	$parking->parkVehicle($vehicle2, ['covered']);
	$parking->parkVehicle($vehicle3, ['accessibility']);

	echo $parking->whereIsMyVehicle($vehicle1).PHP_EOL;
	echo $parking->whereIsMyVehicle($vehicle2).PHP_EOL;
	echo $parking->whereIsMyVehicle($vehicle3).PHP_EOL;

	$parking->unparkVehicle($vehicle1);
}

// Parking Info
echo sprintf('The parking lot has %d slots', $parking->totalSpots()).PHP_EOL;
echo sprintf('The parking lot has %d slots available', $parking->totalAvailableSpots()).PHP_EOL;
echo sprintf('The parking lot has %d slots available that are full covered', $parking->totalAvailableSpots(['covered'])).PHP_EOL;
echo sprintf('The parking lot has %d slots available to support how need accessibility', $parking->totalAvailableSpots(['accessibility'])).PHP_EOL;
echo sprintf('The employees are: %s', implode(', ', $parking->getEmployees())).PHP_EOL;

$openedOrClosed = $parking->isOpened() ? 'opened' : 'closed';
echo sprintf('The parking lot is %s now', $openedOrClosed).PHP_EOL;
