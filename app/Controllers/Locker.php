<?php

namespace App\Controllers;

use App\Models\Lockers;
use App\Entities\Locker as LockerEntity;

class Locker extends BaseController
{
	public function private()
	{
		$lockers = (new Lockers())->privateLockers();
		$lockers = $this->_lockersForViews($lockers);
		$this->data['lockers'] = $lockers;

		return view('home/private', $this->data);
	}

	private function _lockersForViews($lockers)
	{
		return array_map(function ($locker) {
			$locker['status_badge'] =
				($locker['status'] == 'Empty')
				? 'success' : 'warning';

			$locker['lock_badge'] =
				($locker['status_lock'] == '1')
				? 'success' : 'warning';

			return $locker;
		}, $lockers);
	}
}
