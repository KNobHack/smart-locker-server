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
		if ($status == 'Empty' || $status == 0)
			$this->attributes['status'] = 'Empty';
		elseif ($status == 'Occupied' || $status == 1)
			$this->attributes['status'] = 'Occupied';

		return $this;
	}

	public function setSterilize($sterilize): Locker
	{
		if ($sterilize == 0 || $sterilize == 'Unsterilized')
			$this->attributes['sterilize'] = 'Unsterilized';
		else if ($sterilize == 1 || $sterilize == 'Sterilizing')
			$this->attributes['sterilize'] = 'Sterilizing';
		else if ($sterilize == 2 || $sterilize == 'Sterilized')
			$this->attributes['sterilize'] = 'Sterilized';

		return $this;
	}
}
