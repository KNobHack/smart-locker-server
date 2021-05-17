<?php

namespace App\Controllers\Api;

use App\Models\Lockers;
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

	public function locker($mode = null)
	{
		$locker_id        = $this->request->getPostGet('id');
		$locker_status    = $this->request->getPostGet('status');
		$locker_weight    = (string)$this->request->getPostGet('weight');
		$locker_locked    = (string)$this->request->getPostGet('locked');
		$locker_sterilize = $this->request->getPostGet('sterilize');
		if ($mode == 'json') {
			$body = json_decode($this->request->getBody());
			$locker_id        = $body->id;
			$locker_status    = $body->status;
			$locker_locked    = (string)$body->locked;
			$locker_weight    = (string)$body->weight;
			$locker_sterilize = $body->sterilize;
		}

		$lockerModel = new Lockers();
		$locker = $lockerModel->where('id', $locker_id)->first();

		if (!$locker)
			return $this->respond(['massage' => 'Locker not found'], 404);

		$locker->status      = $locker_status;
		$locker->weight      = $locker_weight;
		$locker->sterilize   = $locker_sterilize;
		$locker->status_lock = $locker_locked;
		if ($locker->hasChanged())
			$lockerModel->save($locker);

		return $this->respond(['lock' => $locker->status_lock]);
	}
}
