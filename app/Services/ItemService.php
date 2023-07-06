<?php
namespace App\Services;
use Illuminate\Http\JsonResponse;
use App\Handlers\ResponseHandler;
use App\Actions\ItemActions;

class ItemService {

    public static function index(array $params = []){
        return ResponseHandler::response200(['items' => ItemActions::get($params, ['caracteristicas'])]);
    }

    public static function store(int $categoriaId, string $nombre, string $descripcion = null, float $precio, $image, array $caracteristicasIds ):JsonResponse{

        $newItem = ItemActions::store($nombre, $descripcion, $precio, $image, $categoriaId, $caracteristicasIds);
        return ResponseHandler::response200(['item' => $newItem]);   

    }

    public static function update(int $id, int $categoriaId, string $nombre, string $descripcion = null, float $precio, $image, int|null $place, array $caracteristicasIds):JsonResponse{
        
        $editedItem = ItemActions::update($id, $nombre, $descripcion, $precio, $image, $categoriaId, $place, $caracteristicasIds);
        return ResponseHandler::response200(['item' => $editedItem]);   
    }

    public static function destroy(int $id):JsonResponse{
        ItemActions::destroy($id);
        return ResponseHandler::response200([]);
    }


}