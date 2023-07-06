<?php

namespace App\Models;

use App\Events\ItemDeleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Ordenable;

class Item extends Model
{
    use HasFactory, Ordenable;

    protected $groupByColumn = 'categoria_id';
    
    protected $dispatchesEvents = [
        'deleting' => ItemDeleted::class,
    ];


    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function caracteristicas(){
        return $this->belongsToMany(Caracteristica::class);
    }
}
