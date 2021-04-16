<?php

namespace App\Entities;

use CodeIgniter\Entity;

class User extends Entity
{
	protected $attributes = [
		'id' => null,
		'username' => null,
		'password' => null,
		'created_at' => null,
		'updated_at' => null,
	];

	public function setPassword(string $pass)
	{
		$this->attributes['password'] = password_hash($pass, PASSWORD_BCRYPT);

		return $this;
	}

	public function getPassword()
	{
		return ''; // extact password is not allowed
	}

	public function passwordVerified(string $pass)
	{
		return password_verify($pass, $this->attributes['password']);
	}

	protected $datamap = [];
	protected $dates   = [
		'created_at',
		'updated_at',
		'deleted_at',
	];
	protected $casts   = [];
}
