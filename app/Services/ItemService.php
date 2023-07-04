<?php
namespace App\Services;
use Illuminate\Http\JsonResponse;
use App\Handlers\ResponseHandler;
use App\Actions\ItemActions;

class ItemService {

    public static function index(array $params = []){
        return ResponseHandler::response200(['items' => ItemActions::get($params)]);
    }

    public static function store(int $categoriaId, string $nombre, string $descripcion = null, float $precio, $image):JsonResponse{

        $newItem = ItemActions::store($nombre, $descripcion, $precio, $image, $categoriaId);
        return ResponseHandler::response200(['item' => $newItem]);   

    }

    public static function update(int $id, int $categoriaId, string $nombre, string $descripcion = null, float $precio, $image, int|null $place):JsonResponse{
        
        $editedItem = ItemActions::update($id, $nombre, $descripcion, $precio, $image, $categoriaId, $place);
        return ResponseHandler::response200(['item' => $editedItem]);   
    }

    public static function destroy(int $id):JsonResponse{
        ItemActions::destroy($id);
        return ResponseHandler::response200([]);
    }


}