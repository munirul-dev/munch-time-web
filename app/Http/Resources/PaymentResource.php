<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'reservation_id' => $this->reservation_id,
            'transaction_id' => $this->transaction_id,
            'order_id' => $this->order_id,
            'payment_method' => $this->payment_method,
            'amount' => $this->amount,
            'return_data' => $this->return_data,
            'callback_data' => $this->callback_data,
            'status' => $this->status,
            'status_text' => $this->getStatusText(),
            'created_at' => date('d/m/Y, h:i A', strtotime($this->created_at)),
            'updated_at' => date('d/m/Y, h:i A', strtotime($this->updated_at)),
        ];
    }
}
