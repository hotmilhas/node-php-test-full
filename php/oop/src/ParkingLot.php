<?php

namespace Parking;

use DateTime;

class ParkingLot
{
	protected $name = null;
	protected $address = null;
	protected $employees = [];
	protected $spots = [];
	protected $vehicles = [];
	protected $businessHours = [];
	protected $prices = [];

	public function __construct($name)
	{
		$this->name = $name;
	}

	public function setAddress($address)
	{
		$this->address = $address;
	}

	public function setBusinessHours($hours)
	{
		$this->businessHours = $hours;
	}

	public function setPrices($prices)
	{
		$this->prices = $prices;
	}

	public function addEmployee(Employee $employee)
	{
		if (isset($this->employees[$employee->getName()])) return;

		$this->employees[$employee->getName()] = $employee;

		return true;
	}

	public function getEmployees()
	{
		return $this->employees;
	}

	public function addSpot(Spot $spot)
	{
		if (isset($this->spots[$spot->getNumber()])) return;

		$this->spots[$spot->getNumber()] = $spot;

		return true;
	}

	public function totalSpots()
	{
		return sizeof($this->spots);
	}

	public function totalAvailableSpots($tags = [])
	{
		return array_reduce($this->spots, function($total, $spot) use ($tags)
		{
			if (!$spot->isBusy() AND $spot->hasTags($tags)) $total++;
			return $total;
		}, 0);
	}

	public function isOpened()
	{
		$weekDays = explode(',', 'Sun,Mon,Tue,Wed,Thu,Fri,Sat');
		$dayNumber = date('w');

		if (!isset($weekDays[$dayNumber])) return false;

		$day = $weekDays[$dayNumber];
		$currentTime = new DateTime();
		foreach ($this->businessHours[$day] as $openTime => $closeTime)
		{
			$openTime = DateTime::createFromFormat('h:i A', $openTime);
			$closeTime = DateTime::createFromFormat('h:i A', $closeTime);

			if ($currentTime > $openTime && $closeTime > $currentTime)
			{
				return true;
			}
		}

		return false;
	}

	public function isClosed()
	{
		return ! $this->isOpened();
	}

	public function parkVehicle(Vehicle $vehicle, $tags = [])
	{
		if (isset($this->vehicles[$vehicle->getPlate()])) return;

		$spot = $this->searchAvailableSpot($tags);
		$spot->addVehicle($vehicle);

		$checkinTime = new DateTime();

		$this->vehicles[$vehicle->getPlate()] = compact('spot', 'checkinTime');
	}

	public function unparkVehicle(Vehicle $vehicle)
	{
		if (!isset($this->vehicles[$vehicle->getPlate()])) return;

		extract($this->vehicles[$vehicle->getPlate()]);

		$checkoutTime = new DateTime();

		$period = $checkinTime->diff($checkoutTime);

		$spot->removeVehicle();
		unset($this->vehicles[$vehicle->getPlate()]);
	}

	public function searchAvailableSpot($tags = [])
	{
		foreach ($this->spots as $spot)
		{
			if ($spot->isAvailable() && $spot->hasTags($tags))
			{
				return $spot;
			}
		}
	}

	public function whereIsMyVehicle(Vehicle $vehicle)
	{
		if (!isset($this->vehicles[$vehicle->getPlate()])) return;

		extract($this->vehicles[$vehicle->getPlate()]);
		$message = 'The vehicle %s is parked on spot number %s';

		return sprintf($message, $vehicle, $spot);
	}
}