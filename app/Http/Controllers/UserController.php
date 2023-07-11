<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public static function register(RegisterUserRequest $req){
        return UserService::register($req->name, $req->email, $req->password);
    }

    public static function login(LoginUserRequest $req){
        return UserService::login($req->email, $req->password);

    }
}
