<?php

namespace App\Services;

use App\Actions\CategoriaActions;
use Illuminate\Http\JsonResponse;
use App\Handlers\ResponseHandler;

class CategoriaService {


    public static function store(string $nombre, int $place = 0, string $descripcion = null):JsonResponse{

        $newCategoria = CategoriaActions::store($nombre, $place, $descripcion);
        return ResponseHandler::response200(['categoria' => $newCategoria]);   

    }

    public static function update(int $id, string $nombre, int $place = 0, string $descripcion = null):JsonResponse{
        
        $editedCategoria = CategoriaActions::update($id, $nombre, $place, $descripcion);
        return ResponseHandler::response200(['categoria' => $editedCategoria]);   
    }

    public static function destroy(int $id){
        
        CategoriaActions::destoy($id);
        return ResponseHandler::response200([]);
        
    }


}