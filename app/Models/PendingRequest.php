<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'full_name',
        'email',
        'phone_number',
        'pickup_date',
        'return_date',
        'delivery_method',
        'total_days',
        'total_amount',
        'driving_licence',
        'national_id',
    ];
}
