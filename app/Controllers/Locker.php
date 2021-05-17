<?php

namespace App\Controllers;

use App\Models\Lockers;
use App\Entities\Locker as LockerEntity;

class Locker extends BaseController
{
	public function private()
	{
		$lockers = (new Lockers())->privateLockers();
	}
}
