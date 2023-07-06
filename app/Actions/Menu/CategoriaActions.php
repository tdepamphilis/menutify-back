<?php

namespace App\Actions\Menu;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Support\Facades\Log;

class CategoriaActions {


    static function get(array $params = []):Collection|Categoria|null{

        $getCollection = isset($params['collection']) ? $params['collection'] : false;

        $query = Categoria::query();

        if(isset($params['id'])){
            $query->where('id', $params['id']);
        }

        

        return $getCollection ? $query->get() : $query->first();

    }

    static function store(string $nombre, int|null $place = 0, string|null $descripcion = null):Categoria{
        
        $categoria = new Categoria();

        $lastPlace = $categoria->getLastPlace();

        $categoria->nombre = $nombre;
        $categoria->place = $lastPlace != null ? $lastPlace + 1 : 1;
        $categoria->descripcion = $descripcion;

        $categoria->save();
        return $categoria;
    }

    static function update(int $id, string $nombre, int|null $place = null, string|null $descripcion = null):Categoria|null{
        $categoria = Categoria::where('id', $id)->first();
        if($categoria == null) { return null;}

        $categoria->nombre = $nombre;
        $categoria->descripcion = $descripcion;

        $categoria->save();

        // if place is modified then reorder..
        if($place != null && $place != $categoria->place){ 
            $categoria->reorder($place);
         }

        return $categoria;
    }

    static function destoy(int $id){
        $categoria = Categoria::where('id', $id)->first();
        if($categoria == null) { return null;}

        $categoria->delete();
        return null;
    }

}

