<?php

namespace App\Controllers;

use App\Models\Lockers;
use App\Entities\Locker as LockerEntity;

trait Locker
{
	public function doCheckStatus($id)
	{
		$locker = (new Lockers())->find($id);

		if ($locker === null) {
			return notFound('Locker not found', ['id' => $id]);
		};

		return ok('Status check success', $locker);
	}
}
