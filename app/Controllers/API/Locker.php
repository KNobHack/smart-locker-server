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

	public function locker()
	{
		$locker_id     = $this->request->getPostGet('id');
		$locker_status = $this->request->getPostGet('status');
		$weight        = $this->request->getPostGet('weight');
		$sterilize     = $this->request->getPostGet('sterilize');
	}
}
