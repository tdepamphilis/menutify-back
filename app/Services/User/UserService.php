<?php

namespace App\Services\User;

use App\Actions\User\UserActions;
use App\Handlers\ResponseHandler;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;

class UserService {

    public static function register(string $name, string $email, string $password):JsonResponse{

        
        $user = UserActions::create($name, $email, $password);

        UserActions::login($email, $password);

        $token = UserActions::generateToken('adminToken', ['admin']);

        return ResponseHandler::response200(['token' => $token]);

    }

    public static function login(string $email, string $password):JsonResponse{

        Log::debug($email);
        Log::debug($password);

        if(!UserActions::login($email, $password)){
            return ResponseHandler::response401();
        }

        UserActions::revokeTokens(['adminToken']);

        $token = UserActions::generateToken('adminToken', ['admin']);

        return ResponseHandler::response200(['token' => $token]);

    }



    


}