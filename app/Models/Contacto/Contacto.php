<?php

namespace App\Models\Contacto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    public function provincia(){
        return $this->belongsTo(Provincia::class);
    }
}
