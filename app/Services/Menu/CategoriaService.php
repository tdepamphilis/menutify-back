<?php

namespace App\Services\Menu;

use App\Actions\Menu\CategoriaActions;
use Illuminate\Http\JsonResponse;
use App\Handlers\ResponseHandler;


class CategoriaService {


    public static function index(array $params = []){
        return ResponseHandler::response200(['categorias' => CategoriaActions::get($params)]);
    }

    public static function store(string $nombre, int|null $place = null, string $descripcion = null):JsonResponse{

        $newCategoria = CategoriaActions::store($nombre, $place, $descripcion);
        return ResponseHandler::response200(['categoria' => $newCategoria]);   

    }

    public static function update(int $id, string $nombre, int|null $place = null, string $descripcion = null):JsonResponse{
        
        $editedCategoria = CategoriaActions::update($id, $nombre, $place, $descripcion);
        return ResponseHandler::response200(['categoria' => $editedCategoria]);   
    }

    public static function destroy(int $id){
        
        CategoriaActions::destoy($id);
        return ResponseHandler::response200([]);
    }


}