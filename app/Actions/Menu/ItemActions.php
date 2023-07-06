<?php

namespace App\Actions\Menu;

use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Actions\Menu\CaracteristicaActions;

class ItemActions {
    
    static function get(array $params = [], $eagerLoad = []):Collection|Item|null{

        $getCollection = isset($params['collection']) ? $params['collection'] : false;

        $query = Item::query();

        if(isset($params['id'])){
            $query->where('id', $params['id']);
        }

        if(isset($params['categoriaId'])){
            $query->where('categoria_id', $params['categoriaId']);
        }

        foreach ($eagerLoad as $key => $e) {
            $query->with($e);
        }

        return $getCollection ? $query->get() : $query->first();
    }

    static function store(string $nombre, string $descripcion, float $precio, $image, int $categoriaId, array $caracteristicasIds = []):Item{

        $item = new Item();
        $item->categoria_id = $categoriaId;

        $lastPlace = $item->getLastPlace();

        $item->nombre = $nombre;
        $item->descripcion = $descripcion;
        $item->precio = round($precio, 2);
        $item->place = $lastPlace != null ? $lastPlace + 1 : 1;

        $item->save();

        CaracteristicaActions::addToItem($item, $caracteristicasIds);
        
        $imageName = $item->id . '.' . $image->getClientOriginalExtension();
        Storage::disk('public')->put('images/' . $imageName, file_get_contents($image));

        return $item;
    }

    static function update(int $id, string $nombre, string $descripcion, float $precio, $image, int $categoriaId, int|null $place, array $caracteristicasIds = []):Item|null{

        $item = Item::where('id', $id)->with('caracteristicas')->first();
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

        // Check for changes in caracteristicas and set accordingly.. 
        CaracteristicaActions::updateOnItem($item, $caracteristicasIds);
        
        // $item->caracteristicas()->attach([1]);

        // if image != null then replace..
        if($image != null){
            $imageName = $item->id . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put('images/' . $imageName, file_get_contents($image));
        }

        
        // the instance of $item wont update its relationships until retrieved again..
        $item = Self::get(['id' => $item->id], ['caracteristicas']);

        return $item;
    }

    public static function destroy(int $id){
        $item = Item::where('id', $id)->first();
        
        // call freeUpSpace outside deleting event habdler to avoid updating unnesesary table rows.
        $item->freeUpPlace();

        $item->delete();

        return null;
    }

}