<?php

namespace App\Http\Resources;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $latestReservation = Reservation::where('student_id', $this->id)->latest()->first();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'reservation_date' => !empty($latestReservation) ? date('d/m/Y', strtotime($latestReservation->date)) : null,
            'reservation_food' => !empty($latestReservation) ? $latestReservation->menu->name : null,
        ];
    }
}
