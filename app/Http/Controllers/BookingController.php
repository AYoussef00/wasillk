<?php

namespace App\Http\Controllers;
use App\Models\PendingRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Car; 


use Illuminate\Http\Request;
class BookingController extends Controller
{
    public function pendingBooking(){
        return view("profile.pending-booking");
    }


    public function submitRequest(){
        return view("submit_request");
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date|after:pickup_date',
            'delivery_method' => 'required',
            'driving_licence' => 'required|file|image|max:2048', // max 2MB
            'national_id' => 'required|file|image|max:2048', // max 2MB
            'car_id' => 'required|exists:cars,id',
        ]);
    
        // حساب عدد الأيام
        $start = Carbon::parse($request->pickup_date);
        $end = Carbon::parse($request->return_date);
        $total_days = $start->diffInDays($end);
    
        // استدعاء السيارة
        $car = Car::findOrFail($request->car_id);
    
        // تحديد السعر اليومي
        if ($total_days <= 7) {
            $daily_price = $car->regular_price;
        } elseif ($total_days < 28) {
            $daily_price = $car->weekly_price;
        } else {
            $daily_price = $car->monthly_price;
        }
    
        $total_amount = $daily_price * $total_days;
    
        // رفع الصور
        $licensePath = null;
        $idPath = null;
        
        if ($request->hasFile('driving_licence')) {
            $licensePath = $request->file('driving_licence')->store('licenses', 'public');
        }
        
        if ($request->hasFile('national_id')) {
            $idPath = $request->file('national_id')->store('ids', 'public');
        }
    
        // حفظ الحجز
        PendingRequest::create([
            'car_id' => $car->id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'pickup_date' => $request->pickup_date,
            'return_date' => $request->return_date,
            'delivery_method' => $request->delivery_method,
            'total_days' => $total_days,
            'total_amount' => $total_amount,
            'driving_licence' => $licensePath,
            'national_id' => $idPath,
        ]);
    
        return response()->json(['message' => 'تم الإرسال بنجاح']);
    }

    public function showPendingRequests()
    {
        // استرجاع جميع البيانات من جدول pending_requests مع استعلام لجلب معلومات السيارة
        $pendingRequests = PendingRequest::all()->map(function ($request) {
            // جلب السيارة من جدول cars باستخدام car_id
            $car = DB::table('cars')->where('id', $request->car_id)->first();
            
            // إضافة بيانات السيارة إلى الكائن
            $request->car = $car;
            
            return $request;
        });
    
        // تمرير المتغيرات إلى الـ view
        return view('profile.pending-booking', compact('pendingRequests'));
    }



    public function approve($id)
    {
        $pending = PendingRequest::findOrFail($id);
    
        // إدخال البيانات في جدول confirm_requests
        DB::table('confirm_requests')->insert([
            'full_name' => $pending->full_name,
            'pickup_date' => $pending->pickup_date,
            'return_date' => $pending->return_date,
            'car_id' => $pending->car_id,
            'total_days' => $pending->total_days,
            'total_amount' => $pending->total_amount,
            'driving_licence' => $pending->driving_licence,
            'national_id' => $pending->national_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // حذف الريكوست من جدول pending_requests
        $pending->delete();
    
        return redirect()->back()->with('success', 'تم قبول الطلب بنجاح.');
    }

    public function confirmed()
    {
        $confirmedRequests = DB::table('confirm_requests')->get()->map(function ($request) {
            $car = DB::table('cars')->where('id', $request->car_id)->first();
            $request->car = $car;
            return $request;
        });
    
        return view('profile.confirm-booking', compact('confirmedRequests'));
    }


    public function destroy($id)
    {
        DB::table('pending_requests')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully.');
    }

    



}
