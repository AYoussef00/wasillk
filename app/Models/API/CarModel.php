<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarTranslation;

class CarModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'thumb_image',
        'slug',
        'car_model',
        'regular_price',
        'weekly_price',
        'monthly_price',
        'condition',
        // باقي الأعمدة اللي عندك
    ];

    public function translation()
    {
        return $this->hasOne(CarTranslation::class, 'car_id');
    }
}
