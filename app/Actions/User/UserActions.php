<?php

namespace App\Actions\User;

use App\Models\User;

class UserActions {

    public static function create(string $name, string $email, string $password):User{

        $user = new User();

        $user->name = $name;
        $user->email = $email;
        $user->password = $password;

        return $user;

    }

    public static function update(int $id, string $name, string $email, string $password):User{

        $user = User::where('id', $id)->first();

        $user->name = $name;
        $user->email = $email;
        $user->password = $password;

        return $user;
    }

    public static function destroy(int $id){
        $user = User::where('id', $id)->first();
        $user->delete();
    }


}