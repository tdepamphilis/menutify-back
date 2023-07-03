<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Ordenable;

class Categoria extends Model
{
    use HasFactory, Ordenable;

    public function items(){
        return $this->hasMany(Item::class);
    }

    // static methods 
    
}
