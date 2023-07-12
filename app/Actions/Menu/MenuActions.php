<?php

namespace App\Actions\Menu;

use App\Models\Menu\Menu;
use Illuminate\Database\Eloquent\Collection;

class MenuActions{

    public static function get(array $params = [], $eagerLoad = []):Collection|Menu|null{

        $getCollection = isset($params['collection']) ? $params['collection'] : false;

        $query = Menu::query();

        if(isset($params['id'])){
            $query->where('id', $params['id']);
        }

        if(isset($params['restaurantId'])){
            $query->where('restaurant_id', $params['restaurantId']);
        }

        foreach ($eagerLoad as $key => $e) {
            $query->with($e);
        }

        return $getCollection ? $query->get() : $query->first();

    }
    
    public static function create(int $restaurantId, string $nombre):Menu{

        $menu = new Menu();

        $menu->nombre = $nombre;
        $menu->restaurant_id = $restaurantId;

        $menu->save();

        return $menu;
    }

    public static function update(int $id, string $nombre):Menu{

        $menu = Menu::where('id', $id)->first();

        $menu->nombre = $nombre;

        $menu->save();

        return $menu;
    }

    public static function destroy(int $id){
        
        $menu = Menu::where('id', $id)->first();

        $menu->delete();

    }


}