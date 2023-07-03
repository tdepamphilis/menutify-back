<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public function items(){
        return $this->hasMany(Item::class);
    }

    // static methods 
    public static function getLastPlace(){
        return Self::orderBy('place', 'desc')->value('place');
    }
}
