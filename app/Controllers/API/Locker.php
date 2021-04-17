<?php

namespace App\Controllers\Api;

use App\Controllers\Locker as LockerTrait;

class Locker extends BaseController
{
	use LockerTrait;

	public function checkStatus($id)
	{
		$result = $this->doCheckStatus($id);

		return $this->respond($result);
	}
}
