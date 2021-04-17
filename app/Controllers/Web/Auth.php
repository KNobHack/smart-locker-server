<?php

namespace App\Controllers\Web;

class Auth extends BaseController
{
    use App\Controllers\Auth;

    public function login()
    {
        $result = $this->doLogin();
    }

    public function register()
    {
        $result = $this->doRegister();
    }
}
