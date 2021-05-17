<?php

namespace App\Entities;

use CodeIgniter\Entity;

class Locker extends Entity
{
	protected $attributes = [
		'status' => 'Empty',
		'weight' => null,
		'sterilize' => 'Unsterilized',
		'status_lock' => null
	];

	protected $datamap = [];
	protected $casts   = [
		'weight' => 'integer'
	];

	public function take(): void
	{
		$this->attributes['status'] = 'Empty';
	}

	public function put(): void
	{
		$this->attributes['status'] = 'Occupied';
	}

	public function occupied(): bool
	{
		return $this->attributes['status'] === 'Occupied';
	}

	public function setStatus($status): Locker
	{
		if (is_string($status)) {
			$this->attributes['status'] = ucfirst($status);
		} else if (is_bool($status) || is_numeric($status)) {
			$this->attributes['status'] = ($status) ? 'Occupied' : 'Empty';
		} else {
			$this->attributes['status'] = $status;
		}
		return $this;
	}

	public function setSterilize($sterilize): Locker
	{
		if (is_string($sterilize)) {
			$this->attributes['sterilize'] = ucfirst($sterilize);
		} else if (is_numeric($sterilize)) {
			if ($sterilize == 0)
				$this->attributes['sterilize'] = 'Unsterilized';
			else if ($sterilize == 1)
				$this->attributes['sterilize'] = 'Sterilizing';
			else if ($sterilize == 2)
				$this->attributes['sterilize'] = 'Sterilized';
		} else {
			$this->attributes['sterilize'] = $sterilize;
		}
		return $this;
	}
}
