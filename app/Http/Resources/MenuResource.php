<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            'name' => $this->name,
            'category' => $this->category,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'image' => !empty($this->image) ? asset('storage/menus/' . $this->image) : "",
            'description' => $this->description,
            'ingredient' => $this->ingredient,
            'status' => $this->status,
        ];
    }
}
