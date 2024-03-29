<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_id',
        'menu_id',
        'quantity',
        'date',
        'amount_paid',
        'description',
        'status',
        'redeemed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function getStatusText()
    {
        switch ($this->status) {
            case 0:
                return 'Unpaid';

            case 1:
                return 'Paid';

            case 2:
                return 'Cancelled';

            case 3:
                return 'Redeemed';

            default:
                return 'Unknown';
        }
    }
}
