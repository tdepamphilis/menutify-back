<?php

namespace App\Actions;

use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ItemActions {
    
    static function get(array $params = []):Collection|Item|null{

        $getCollection = isset($params['collection']) ? $params['collection'] : false;

        $query = Item::query();

        if(isset($params['id'])){
            $query->where('id', $params['id']);
        }

        if(isset($params['categoriaId'])){
            $query->where('categoria_id', $params['categoriaId']);
        }

        return $getCollection ? $query->get() : $query->first();
    }

    static function store(string $nombre, string $descripcion, float $precio, $image, int $categoriaId):Item{

        $item = new Item();
        $item->categoria_id = $categoriaId;

        $lastPlace = $item->getLastPlace();

        $item->nombre = $nombre;
        $item->descripcion = $descripcion;
        $item->precio = round($precio, 2);
        $item->place = $lastPlace != null ? $lastPlace + 1 : 1;

        $item->save();

        $imageName = $item->id . '.' . $image->getClientOriginalExtension();
        Storage::disk('public')->put('images/' . $imageName, file_get_contents($image));

        return $item;
    }

    static function update(int $id, string $nombre, string $descripcion, float $precio, $image, int $categoriaId, int|null $place):Item|null{

        $item = Item::where('id', $id)->first();
        if($item == null) { return null;}

        $item->nombre = $nombre;
        $item->descripcion = $descripcion;
        $item->precio = round($precio, 2);
        
        // if categoriaId changes then its placed on top and prev categoriaId items are resorted..
        if($item->categoria_id != $categoriaId){
            
            $item->freeUpPlace();

            $item->categoria_id = $categoriaId;
            $newPlace = $item->getLastPlace();
            $item->place = $newPlace != null ? $newPlace + 1 : 1;
        } 

        $item->save();        

        // if place is modified then reorder..
            if($place != null && $place != $item->place){ 
            $item->reorder($place);
        }

        // if image != null then replace..
        if($image != null){
            $imageName = $item->id . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put('images/' . $imageName, file_get_contents($image));
        }

        return $item;
    }

    public static function destroy(int $id){
        $item = Item::where('id', $id)->first();
        $item->delete();

        return null;
    }

}