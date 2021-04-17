<?php

namespace App\Controllers;

use App\Entities\User;
use App\Models\Users;

trait Auth
{
	public function doRegister()
	{
		$user = new User($this->request->getPost());
		$userModel = new Users();

		$validation = service('validation');

		if (!$validation->run($this->request->getPost(), 'register')) {
			return badRequest('Validation error', $validation->getErrors());
		}

		$userModel->save($user);

		$user->__unset('password');
		return created('User cteared', $user->toArray());
	}

	public function doLogin()
	{
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');

		$users = (new Users)->findUsername($username);

		if ($users->countAllResults() < 1) {
			return notFound('Username not found', ['username' => $username]);
		}

		$user = $users->first();

		if ($user->passwordVerified($password) === false) {
			return unauthorized('Worng password');
		}

		$user->__unset('password');
		return ok('Login success', $user->toArray);
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
