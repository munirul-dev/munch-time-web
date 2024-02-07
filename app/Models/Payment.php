<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reservation_id',
        'transaction_id',
        'order_id',
        'payment_method',
        'amount',
        'return_data',
        'callback_data',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function getStatusText()
    {
        switch ($this->status) {
            case 0:
                return 'Failed';
                break;

            case 1:
                return 'Successfull';
                break;

            case 2:
                return 'Pending';
                break;

            default:
                return 'Error';
                break;
        }
    }
}
