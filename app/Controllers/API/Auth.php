<?php

namespace App\Controllers\API;

use App\Controllers\Auth as AuthTrait;

class Auth extends BaseController
{
    use AuthTrait;

    public function login()
    {
        $result = $this->doLogin();
        return $this->respond($result);
    }

    public function register()
    {
        $result = $this->doRegister();
        return $this->respond($result);
    }
}
