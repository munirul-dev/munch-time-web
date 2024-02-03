<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'price',
        'quantity',
        'image',
        'description',
        'ingredient',
        'status',
    ];

    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }
}