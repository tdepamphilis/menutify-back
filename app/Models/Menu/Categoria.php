<?php

namespace App\Models\Menu;

use App\Events\CategoriaDeleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Ordenable;

class Categoria extends Model
{
    use HasFactory, Ordenable;

    protected $dispatchesEvents = [
        'deleting' => CategoriaDeleted::class,
    ];

    public function items(){
        return $this->hasMany(Item::class);
    }

    // static methods 
    
}
