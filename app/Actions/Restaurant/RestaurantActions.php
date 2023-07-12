<?php

namespace App\Actions\Restaurant;

use App\Models\Restaurant\Restaurant;
use Illuminate\Database\Eloquent\Collection;


class RestaurantActions {

    public static function get(array $params = [], $eagerLoad = []):Collection|Restaurant|null{

        $getCollection = isset($params['collection']) ? $params['collection'] : false;

        $query = Restaurant::query();

        if(isset($params['id'])){
            $query->where('id', $params['id']);
        }

        if(isset($params['userId'])){
            $query->where('user_id', $params['userId']);
        }

        foreach ($eagerLoad as $key => $e) {
            $query->with($e);
        }

        return $getCollection ? $query->get() : $query->first();
    }

    public static function create(int $userId, string $nombre):Restaurant{

        $restaurant = new Restaurant();

        $restaurant->user_id = $userId;
        $restaurant->nombre = $nombre;

        $restaurant->save();
        return $restaurant;
    }

    public static function update(int $restaurantId, string $nombre):Restaurant{

        $restaurant = Restaurant::where('id', $restaurantId)->first();

        $restaurant->nombre = $nombre;

        $restaurant->save();
        return $restaurant;
    }

    public static function destroy(int $restaurantId){

        $restaurant = Restaurant::where('id', $restaurantId)->first();

        $restaurant->delete();
    }


    // Contacto

    public function setContacto(int $id, int $contactoId):Restaurant{
        $restaurant = Restaurant::where('id', $id)->first();
        $restaurant->contacto_id = $contactoId;
        $restaurant->save();
        return $restaurant;
    }





}