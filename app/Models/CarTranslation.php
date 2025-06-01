<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarTranslation extends Model
{
    protected $fillable = [
        'car_id',
        'title',
        'seo_description',
        // زوّد أي أعمدة إضافية لو موجودة
    ];

    public function car()
    {
        return $this->belongsTo(\App\Models\API\CarModel::class, 'car_id');
    }
}