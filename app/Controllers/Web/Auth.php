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

    public function register()
    {
        $result = $this->doRegister();
    }
}