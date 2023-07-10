<?php

namespace App\Services\User;

use App\Handlers\ResponseHandler;
use Illuminate\Http\JsonResponse;

class UserService {

    public static function register(string $name, string $email, string $password):JsonResponse{

        


        return ResponseHandler::response200();

    }

    


}