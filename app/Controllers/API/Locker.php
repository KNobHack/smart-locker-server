<?php

namespace App\Controllers\Api;

use App\Entities\Locker as LockerEntity;

class Locker extends BaseController
{

	public function checkStatus($id)
	{
		$locker = (new Lockers())->find($id);

		if ($locker === null) {
			return $this->failNotFound('Locker not found', 404, "Locker id = {$id} not found");
		};

		return $this->respond($locker->toArray());
	}
}
