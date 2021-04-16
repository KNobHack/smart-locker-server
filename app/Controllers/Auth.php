<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Models\Users;
use Config\Services;
use CodeIgniter\API\ResponseTrait;

class Auth extends BaseController
{
	use ResponseTrait;

	private $jwt;
	private $jwt_key;

	public function __construct()
	{
		$this->jwt     = Services::jwt(false);
		$this->jwt_key = env('jwt.key', '123');
	}

	public function register()
	{
		// From request
		$data = $this->request->getPost();

		// Entity
		$user = new User($data);

		$userModel = new Users();
		$userModel->save($user);

		$user->__unset('password');
		$this->giveJWT($user->toArray());

		return $this->respondCreated(['status' => 'success', 'msg' => 'User created']);
	}

	private function giveJWT($payload)
	{
		$encoded = $this->jwt->encode($payload, $this->jwt_key);

		$this->response->setHeader('WWW-Authenticate', "Barer {$encoded}");
	}

	private function authenticate()
	{
		try {
			return $this->jwt->decode($this->extractJWT(), $this->jwt_key, ['HS256']);
		} catch (\Throwable $th) {
			return $this->failUnauthorized("Token Expired");
		}
	}

	private function extractJWT()
	{
		$raw = $this->request->header('Authorization')->getValue();
		$extracted = str_replace('Bearer ', '', $raw);
		return $extracted;
	}
}
