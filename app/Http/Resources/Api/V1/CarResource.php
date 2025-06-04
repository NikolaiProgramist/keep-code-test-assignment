<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_price' => $this->full_price,
            'rental_price' => $this->rental_price,
            'name' => $this->name,
            'brand' => $this->brand,
            'color' => $this->color,
            'transmission' => $this->transmission,
            'fuel' => $this->fuel,
            'power' => $this->power,
            'PIN' => $this->when(Auth::user()->id === optional($this->purchase)->user_id, $this->PIN)
        ];
    }
}
