<?php

namespace App\Entities;

use CodeIgniter\Entity;

class Locker extends Entity
{
	protected $attributes = [
		'status' => 'empty'
	];
	protected $datamap = [];
	protected $casts   = [];

	public function take(): void
	{
		$this->attributes['status'] = 'empty';
	}

	public function put(): void
	{
		$this->attributes['status'] = 'occupied';
	}

	public function occupied(): bool
	{
		return $this->attributes['status'] === 'occupied';
	}

	public function setStatus(): Locker
	{
		return $this;
	}
}
