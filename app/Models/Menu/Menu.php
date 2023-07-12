<?php

namespace App\Models\Menu;

use App\Events\MenuDeleted;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'deleting' => MenuDeleted::class,
    ];

    public function categorias(){
        return $this->hasMany(Categoria::class);
    }

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
}
