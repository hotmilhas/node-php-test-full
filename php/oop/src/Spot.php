<?php

namespace Parking;

class Spot
{
	const AVAILABLE = true;
	const BUSY = false;

	protected $number = null;
	protected $state = false;
	protected $tags = [];

	public function __construct($number, $state = Spot::AVAILABLE, $tags = [])
	{
		$this->number = $number;
		$this->setState($state);
		$this->addTags($tags);
	}

	public function getNumber()
	{
		return $this->number;
	}

	public function setState($state)
	{
		if (in_array($state, [Static::AVAILABLE, Static::BUSY]))
		{
			$this->state = $state;
		}
	}

	public function isBusy()
	{
		return $this->state == Static::BUSY;
	}

	public function isAvailable()
	{
		return !$this->isBusy();
	}

	public function hasTags($tags = [])
	{
		foreach ($tags as $tag)
		{
			if ($this->hasTag($tag)) return true;
		}

		return empty($tags) && empty($this->tags);
	}

	public function hasTag($tag)
	{
		return in_array($tag, $this->tags);
	}

	public function addTags($tags)
	{
		$tags = array_unique($tags);

		foreach ($tags as $tag)
		{
			if (!$this->hasTag($tag))
			{
				array_push($this->tags, $tag);
			}
		}
	}

	public function addVehicle(Vehicle $vehicle)
	{
		$this->vehicle = $vehicle;
		$this->setState(Static::BUSY);
	}

	public function removeVehicle()
	{
		$this->vehicle = null;
		$this->setState(Static::AVAILABLE);
	}

    public function __toString()
    {
        return '#'.$this->number;
    }
}
