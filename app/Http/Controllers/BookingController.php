<?php

namespace App\Http\Controllers;
use App\Models\PendingRequest;
use Illuminate\Support\Facades\DB;


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
            'total_days' => 'required|integer',
            'total_amount' => 'required|numeric',
            'driving_licence' => 'required|file|image',
            'national_id' => 'required|file|image',
            'car_id' => 'required|exists:cars,id',
        ]);
    
        $licensePath = $request->file('driving_licence')->store('licenses', 'public');
        $idPath = $request->file('national_id')->store('ids', 'public');
    
        PendingRequest::create([
            'car_id' => $request->car_id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'pickup_date' => $request->pickup_date,
            'return_date' => $request->return_date,
            'delivery_method' => $request->delivery_method,
            'total_days' => $request->total_days,
            'total_amount' => $request->total_amount,
            'driving_licence' => $licensePath,
            'national_id' => $idPath,
        ]);
    
        return redirect()->back()->with('success', 'تم إرسال الطلب بنجاح، سيتم التواصل معك قريباً.');
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


}
