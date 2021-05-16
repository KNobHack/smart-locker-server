<?php

namespace App\Controllers;

use App\Entities\User;
use App\Models\Users;

class Auth extends BaseController
{
	public function registerPage()
	{
		return view('auth/register');
	}

	public function register()
	{
		$postData = $this->request->getPost();
		$user = new User($postData);
		$userModel = new Users();

		if (!$this->validation->run($postData, 'register')) {
			$errors = $this->validation->getErrors();
			return redirect()->back()
				->with('alert', [
					'type'    => 'danger',
					'message' => $errors['username'] ?? $errors['password']
				])->withInput();
		}

		$userModel->save($user);

		$user->__unset('password');
		session()->set('credential', $user->toArray());
		return redirect()->route('homePage')
			->with('alert', [
				'type' => 'success',
				'message' => 'Account created.'
			]);
	}

	public function loginPage()
	{
		return view('auth/login');
	}

	public function login()
	{
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');

		$users = (new Users)->findUsername($username);

		if ($users->countAllResults() < 1) {
			return $this->_wrongCredential();
		}

		$user = $users->first();

		if ($user->passwordVerified($password) === false) {
			return $this->_wrongCredential();
		}

		$user->__unset('password');
		session()->set('credential', $user->toArray());
		return redirect()->route('homePage');
	}

	private function _wrongCredential()
	{
		return redirect()->back()
			->with('alert', [
				'type' => 'danger',
				'message' => 'Wrong Username or Password'
			])
			->withInput();
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
