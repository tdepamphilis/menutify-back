<?php

namespace App\Actions;

use App\Models\Caracteristica;
use App\Models\Item;

use Illuminate\Support\Facades\Log;

class CaracteristicaActions {

    public static function addToItem(Item $item, array $caracteristicasIds):Item{
        $item->caracteristicas()->attach($caracteristicasIds);
        return $item;
    }

    public static function removeFromItem(Item $item, array $caracteristicasIds):Item{
        $item->caracteristicas()->detach($caracteristicasIds);
        return $item;
    }

    public static function updateOnItem(Item $item, array $caracteristicasIds):Item{

        $removedCaracteristicas = [];
        $addedCaracteristicas = [];
        $matchedCaracteristicas = [];

        foreach ($item->caracteristicas as $key => $existingCaracteristica) {
            
            // Si no está en el array pasado por parametro lo agrego a removed, si está va a matched.
            if(!in_array($existingCaracteristica->id, $caracteristicasIds)){
                array_push($removedCaracteristicas, $existingCaracteristica->id);
            } else {
                array_push($matchedCaracteristicas, $existingCaracteristica->id);
            }

        }

        // y ahora recorro el pasado como parametro y las que no estén registradas para agregar a added..
        foreach ($caracteristicasIds as $key => $caracteristica) {
            if(!in_array($caracteristica, $matchedCaracteristicas)){
                array_push($addedCaracteristicas, $caracteristica);
            }
        }

        // Hago el attach/detach de las que corresponda..

        Log::debug($removedCaracteristicas);
        Log::debug($addedCaracteristicas);

        $item->caracteristicas()->attach($addedCaracteristicas);
        $item->caracteristicas()->detach($removedCaracteristicas);

        return $item;
    }


}