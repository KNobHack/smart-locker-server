<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Home extends ResourceController
{
	public function alive()
	{
		return $this->respond(['status' => 'alive']);
	}
}
