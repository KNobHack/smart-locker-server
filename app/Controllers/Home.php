<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data['username'] = session('credential')['username'];
		return view('home/home', $data);
	}
}
