<?php

namespace Parking;

class Vehicle
{
	protected $plate = null;
	protected $model = null;

	public function __construct($plate, $model)
	{
		$this->plate = $plate;
		$this->model = $model;
	}

	public function getPlate()
	{
		return $this->plate;
	}

    public function __toString()
    {
        return '#'.$this->plate.' '.$this->model;
    }
}