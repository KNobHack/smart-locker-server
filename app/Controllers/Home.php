<?php

namespace App\Controllers;

trait Home
{
	public function alive()
	{
		return ok('Server Alive');
	}
}
