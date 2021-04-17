<?php

namespace App\Controllers\Web;

use App\Controllers\Auth as AuthTrait;

class Auth extends BaseController
{
    use AuthTrait;

    public function login()
    {
        $result = $this->doLogin();

        if ($result['code'] != 200) {
            return redirect()->back()
                ->with('alert', [
                    'type' => 'danger',
                    'message' => 'Wrong Username or Password'
                ])
                ->withInput();
        }

        session()->set('credential', $result['data']);
        return redirect()->route('homePage');
    }

    public function loginPage()
    {
        return view('auth/login');
    }

    public function register()
    {
        $result = $this->doRegister();
        if ($result['code'] != 201) {
            return redirect()->back()
                ->with('alert', [
                    'type'    => 'danger',
                    'message' => ($result['data']['username'] ?? $result['data']['password'])
                ])->withInput();
        }

        session()->set('credential', $result['data']);

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
