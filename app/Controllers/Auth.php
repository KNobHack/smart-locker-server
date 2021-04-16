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

	// private $jwt;
	// private $jwt_key;

	// public function __construct()
	// {
	// 	$this->jwt     = Services::jwt(false);
	// 	$this->jwt_key = env('jwt.key', '123');
	// }

	public function register()
	{
		// Entity
		$user = new User($this->request->getPost());

		$userModel = new Users();

		if ($userModel->usernameTaken($user->username)) {
			return $this->failResourceExists();
		}

		if ($userModel->insert($user) === false) {
			return $this->failValidationError();
		}

		$user->__unset('password');
		$this->session->set($user->toArray());
		// $this->giveJWT($user->toArray());

		return $this->respondCreated(['status' => 'success', 'code' => 201, 'message' => 'User created']);
	}

	public function login()
	{
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');

		$user = (new Users)->findUsername($username);

		if ($user->passwordVerified($password) === false) {
			return $this->failUnauthorized();
		}

		return $this->respond(['status' => 'success', 'code' => 200, 'message' => 'Login success']);
	}

	// private function giveJWT($payload)
	// {
	// 	$encoded = $this->jwt->encode($payload, $this->jwt_key);

	// 	$this->response->setHeader('WWW-Authenticate', "Barer {$encoded}");
	// }

	// private function authenticate()
	// {
	// 	try {
	// 		return $this->jwt->decode($this->extractJWT(), $this->jwt_key, ['HS256']);
	// 	} catch (\Throwable $th) {
	// 		return $this->failUnauthorized("Token Expired");
	// 	}
	// }

	// private function extractJWT()
	// {
	// 	$raw = $this->request->header('Authorization')->getValue();
	// 	$extracted = str_replace('Bearer ', '', $raw);
	// 	return $extracted;
	// }
}
