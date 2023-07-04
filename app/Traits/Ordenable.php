<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;


trait Ordenable {

    private function getGroupBy(){
        return isset($this->groupByColumn) ? $this->groupByColumn : null;
    }

    public function reorder(int $place){

        $class = $this::class;

        if($this->getGroupBy() == null){
            $models = $class::where('id', '!=' , $this->id)->where('place', '>=', $place)->where('place', '<', $this->place)->get();
        } else {
            $models = $class::where('id', '!=' , $this->id)->where('place', '>=', $place)->where('place', '<', $this->place)->where($this->getGroupBy(), $this[$this->getGroupBy()])->get();
        }

        foreach ($models as $key => $model) {
            Log::debug('entra al foreach con id ' . $model->id);
            $model->place = $model->place + 1;
            $model->save();
        }

        $this->place = $place;
        $this->save();
    }

    public function getLastPlace(){
        
        if($this->getGroupBy() == null){
            return Self::orderBy('place', 'desc')->value('place');
        } else {
            return Self::where($this->getGroupBy(), $this[$this->getGroupBy()])->orderBy('place', 'desc')->value('place');
        }

    }

}