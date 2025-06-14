<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\PendingRequest;

use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function getUsedCars()
    {
        $cars = Car::select(
                    'cars.id',
                    'cars.thumb_image',
                    'cars.slug',
                    'cars.car_model',
                    'cars.regular_price',
                    'cars.weekly_price',
                    'cars.monthly_price',
                    'car_translations.title',
                    'car_translations.seo_description'
                )
                ->leftJoin('car_translations', 'cars.id', '=', 'car_translations.car_id')
                ->where('cars.condition', 'Used')
                ->get();

        return response()->json($cars);
    }


    public function storePendingRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'car_id' => 'required|integer|exists:cars,id',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:pickup_date',
            'delivery_method' => 'required|string|max:100',
            'total_days' => 'required|integer|min:1',
            'total_amount' => 'required|numeric|min:0',
    
            // ✅ التحقق من الصور
            'driving_licence' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'national_id' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // ✅ تجهيز البيانات بدون الصور
        $data = $request->except(['driving_licence', 'national_id']);
    
        // ✅ حفظ صورة رخصة القيادة
        if ($request->hasFile('driving_licence')) {
            $data['driving_licence'] = $request->file('driving_licence')->store('licenses', 'public');
        }
    
        // ✅ حفظ صورة الهوية
        if ($request->hasFile('national_id')) {
            $data['national_id'] = $request->file('national_id')->store('ids', 'public');
        }
    
        // ✅ إنشاء الطلب في قاعدة البيانات
        $pendingRequest = PendingRequest::create($data);
    
        return response()->json([
            'message' => 'Request submitted successfully',
            'data' => $pendingRequest,
        ], 201);
    }

    
}
    
    