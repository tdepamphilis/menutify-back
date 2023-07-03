<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\Crud\Categoria\DestroyCategoriaRequest;
use App\Http\Requests\Crud\Categoria\IndexCategoriaRequest;
use App\Http\Requests\Crud\Categoria\StoreCategoriaRequest;
use App\Http\Requests\Crud\Categoria\UpdateCategoriaRequest;
use App\Services\CategoriaService;

use Illuminate\Support\Facades\Log;

class CategoriaController extends Controller
{
    
    public function index(IndexCategoriaRequest $req){
        
        $params = [
            'id' => $req->id,
            'collection' => true
        ];

        return CategoriaService::index($params);
    }
    
    public function store(StoreCategoriaRequest $req){
        return CategoriaService::store($req->nombre, $req->place, $req->descripcion);
    }

    public function destroy(DestroyCategoriaRequest $req){
        return CategoriaService::destroy($req->id);
    }

    public function update(UpdateCategoriaRequest $req){
        return CategoriaService::update($req->id, $req->nombre, $req->place, $req->descripcion);
    }


}
