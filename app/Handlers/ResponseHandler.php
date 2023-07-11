<?php

namespace App\Handlers;

use Illuminate\Http\JsonResponse;

class ResponseHandler {


    public static function response200(array $data = []):JsonResponse{
        $responseData = ['status' => 'Ok'];

        return response()->json(array_merge($responseData, $data));
    }

    public static function response401(array $data = []):JsonResponse{
        $responseData = ['status' => 'Unauthorized'];

        return response()->json(array_merge($responseData, $data), 401);
    }

}