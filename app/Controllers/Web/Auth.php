<?php

namespace App\Controllers\Web;

use App\Controllers\Auth as AuthTrait;

class Auth extends BaseController
{
    use AuthTrait;

    public function login()
    {
        $result = $this->doLogin();
    }

    public function loginPage()
    {
        return view('auth/login');
    }

    public function register()
    {
        $result = $this->doRegister();
        if ($result['code'] != 201) {
            return redirect()
                ->back()
                ->with('alert', [
                    'type'    => 'danger',
                    'message' => ($result['data']['username'] ?? $result['data']['password'])
                ])->withInput();
        }

        session('credential', $result);

        return redirect()->route('loginPage')
            ->with('alert', [
                'type' => 'success',
                'message' => 'Account created. Please login'
            ])
            ->withInput();
    }

    public function registerPage()
    {
        return view('auth/register');
    }
}
