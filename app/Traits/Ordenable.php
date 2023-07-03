<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;


trait Ordenable {

    public function reorder(int $place){

        $class = $this::class;

        $models = $class::where('id', '!=' , $this->id)->where('place', '>=', $place)->where('place', '<', $this->place)->get();

        foreach ($models as $key => $model) {
            Log::debug('entra al foreach con id ' . $model->id);
            $model->place = $model->place + 1;
            $model->save();
        }

        $this->place = $place;
        $this->save();
    }

    public static function getLastPlace(){
        return Self::orderBy('place', 'desc')->value('place');
    }

}