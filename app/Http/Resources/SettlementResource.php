<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettlementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "user_name" => $this->user->name,
            "amount" => $this->amount,
            "status" => $this->status,
            "created_at" => date('d/m/Y h:i A', strtotime($this->created_at)),
            "created_at_date" => date('d/m/Y', strtotime($this->created_at)),
            "updated_at" => date('d/m/Y h:i A', strtotime($this->updated_at)),
        ];
    }
}
