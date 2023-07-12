<?php

namespace App\Actions\User;

use App\Models\Contacto\Contacto;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use Laravel\Passport\TokenRepository;

class UserActions {

    // Crud..
    
    public static function create(string $name, string $email, string $password):User{

        $user = new User();

        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);

        $user->save();

        return $user;

    }

    public static function update(int $id, string $name, string $email, string $password):User{

        $user = User::where('id', $id)->first();

        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);

        return $user;
    }

    public static function destroy(int $id){
        $user = User::where('id', $id)->first();
        $user->delete();
    }

    // Contacto..

    public function setContacto(int $id, int $contactoId):User{
        $user = User::where('id', $id)->first();
        $user->contacto_id = $contactoId;
        $user->save();
        return $user;
    }

    // Auth..

    public static function login($email, $password):bool{

        Auth::logout();

        $user = User::where('email', $email)->first();

        if($user == null) {return false;}

        Log::debug('trajo al user');

        if(Hash::check($password, $user->password)){
            Auth::login($user);
            return true;
        }

        return false;
    }


    public static function generateToken(string $name, array $scopes){

        $user = Auth::user();

        if($user == null ){
            Throw new Exception('generateToken() called on null user');
        }
        
        $token = auth()->user()->createToken($name, ['payment', 'menu_crud', 'menu_view'])->accessToken;

        return $token;
    }

    public static function revokeTokens(array|null $names = null){

        $user = Auth::user();

        if($user == null ){
            Throw new Exception('revokeTokens() called on null user');
        }

        foreach ($user->tokens as $key => $token) {
            
            if(is_array($names)){
                if(in_array($token->name, $names)){
                    $token->revoke();
                }
            } else {
                $token->revoke();
            }

        }

    }


}