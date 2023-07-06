<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\Crud\Item\DestroyItemRequest;
use App\Http\Requests\Crud\Item\IndexItemRequest;
use App\Http\Requests\Crud\Item\StoreItemRequest;
use App\Http\Requests\Crud\Item\UpdateItemRequest;
use App\Services\Menu\ItemService;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    public function index(IndexItemRequest $req){
        
        $params = [
            'id' => $req->id,
            'categoriaId' => $req->categoriaId,
            'collection' => true
        ];

        return ItemService::index($params);
    }
    
    public function store(StoreItemRequest $req){   
        return ItemService::store($req->categoriaId, $req->nombre, $req->descripcion, $req->precio, $req->image, $req->getCaracteristicasId());
    }
    public function update(UpdateItemRequest $req){
        return ItemService::update($req->id, $req->categoriaId, $req->nombre, $req->descripcion, $req->precio, $req->image, $req->place, $req->getCaracteristicasId()); 
    }   

    public function destroy(DestroyItemRequest $req){
        return ItemService::destroy($req->id);   
    }

}
