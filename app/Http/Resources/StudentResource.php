<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class StudentResource extends JsonResource
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
            'user_id' => $this->user_id,
            'parent_name' => $this->user->name,
            'name' => $this->name,
            'age' => $this->age,
            'allergies' => $this->allergies,
            'year_level' => $this->year_level,
            'class_name' => $this->class_name,
            'qr_code' => 'https://api.qrserver.com/v1/create-qr-code/?size=512x512&data=' . Crypt::encryptString($this->id),
        ];
    }
}
