<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
            "student_id" => $this->student_id,
            "student_name" => $this->student->name,
            "menu_id" => $this->menu_id,
            "menu_name" => $this->menu->name,
            "quantity" => $this->quantity,
            "date" => date("d/m/Y", strtotime($this->date)),
            "amount_paid" => $this->amount_paid,
            "description" => $this->description,
            "status" => $this->status,
            "created_at" => date("d/m/Y h:i A", strtotime($this->created_at)),
            "updated_at" => date("d/m/Y h:i A", strtotime($this->updated_at)),
        ];
    }
}
