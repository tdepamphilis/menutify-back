<?php 

namespace App\Actions\Contacto;

use App\Models\Contacto\Contacto;
use App\Models\User;
use App\Models\Restaurant\Restaurant;

class ContactoActions {


    public static function create(string $domicilio, string $localidad, int $provinciaId, string $telefono, string $email):Contacto{

        $contacto = new Contacto();

        $contacto->domicilio = $domicilio;
        $contacto->localidad = $localidad;
        $contacto->provincia_id = $provinciaId;
        $contacto->telefono = $telefono;
        $contacto->email = $email;

        $contacto->save();
        return $contacto;
    }

    public static function update(int $id, string $domicilio, string $localidad, int $provinciaId, string $telefono, string $email):Contacto{
        
        $contacto = Contacto::where('id', $id)->first();

        $contacto->domicilio = $domicilio;
        $contacto->localidad = $localidad;
        $contacto->provincia_id = $provinciaId;
        $contacto->telefono = $telefono;
        $contacto->email = $email;

        $contacto->save();
        return $contacto;

    }

    


}