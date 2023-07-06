<?php

namespace App\Http\Requests\Menu\Item;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use App\Handlers\ArrayHandler;

class StoreItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre' => 'string|required',
            'descripcion' => 'string',
            'precio' => 'numeric|required',
            'image' => 'file|image',
            'categoriaId' => 'integer|required',
            'caracteristicasIds' => 'array',
            'caracteristicasIds.*' => 'integer|distinct'
        ];
    }

    public function getCaracteristicasId(){
        return isset($this->caracteristicasIds) ? $this->caracteristicasIds : [];
    }

    protected function prepareForValidation()
    {
        // parse the $payload key to validate as json.
        $decoded = json_decode($this->payload, true, 512, JSON_THROW_ON_ERROR);
        $this->merge($decoded);
    }
}
