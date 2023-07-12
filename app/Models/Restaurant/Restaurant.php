<?php

namespace App\Models\Restaurant;

use App\Events\RestaurantDeleted;
use App\Models\Contacto\Contacto;
use App\Models\Menu\Menu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'deleting' => RestaurantDeleted::class,
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function menus(){
        return $this->hasMany(Menu::class);
    }

    public function contacto(){
        return $this->belongsTo(Contacto::class);
    }
}
