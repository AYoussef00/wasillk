@extends('layout')
@section('title')
    <title>قائمة الحجوزات المعلقة</title>
@endsection
@section('body-content')

<main>
    <section class="dashboard">
        <div class="container">
            <div class="row">
                @include('profile.sidebar')
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="review-main">
                                <h3 class="review-main-taitel">{{ __('الحجوزات المعلقة') }}</h3>
                                <div class="review-main-item">
                                    <div class="container">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover text-center">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th style="font-size: 12px;">رقم الحجز</th>
                                                        <th style="font-size: 12px;">اسم المستأجر</th>
                                                        <th style="font-size: 12px;">تاريخ الاستلام</th>
                                                        <th style="font-size: 12px;">تاريخ التسليم</th>
                                                        <th style="font-size: 12px;">السيارة</th>
                                                        <th style="font-size: 12px;">عدد الأيام</th>
                                                        <th style="font-size: 12px;">المبلغ الإجمالي</th>
                                                        <th style="font-size: 12px;">تاريخ إنشاء الطلب</th>
                                                        <th style="font-size: 12px;">الرخصة</th>
                                                        <th style="font-size: 12px;">الهوية</th>
                                                        <th style="font-size: 12px;">الإجراء</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($pendingRequests as $request)
                                                        <tr>
                                                            <td style="font-size: 12px;">{{ $request->id }}</td>
                                                            <td style="font-size: 12px;">{{ $request->full_name }}</td>
                                                            <td style="font-size: 12px;">{{ $request->pickup_date }}</td>
                                                            <td style="font-size: 12px;">{{ $request->return_date }}</td>
                                                            <td style="font-size: 12px;">
                                                                @if($request->car)
                                                                    {{ $request->car->slug }} {{ $request->car->year }}
                                                                @else
                                                                    لا توجد سيارة
                                                                @endif
                                                            </td>
                                                            <td style="font-size: 12px;">{{ $request->total_days }}</td>
                                                            <td style="font-size: 12px;">{{ number_format($request->total_amount, 2) }} ريال</td>
                                                            <td style="font-size: 12px;">{{ $request->created_at }}</td>
                                                            <td><a href="{{ Storage::url($request->driving_licence) }}" class="btn btn-sm btn-outline-primary" target="_blank" style="font-size: 12px;">عرض الملف</a></td>
                                                            <td><a href="{{ Storage::url($request->national_id) }}" class="btn btn-sm btn-outline-primary" target="_blank" style="font-size: 12px;">عرض الملف</a></td>
                                                            <td>
                                                                <form action="{{ route('requests.approve', $request->id) }}" method="POST" style="display:inline-block;">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit" class="btn btn-success btn-sm" style="font-size: 12px;">قبول</button>
                                                                </form>
                                                                <form action="#" method="POST" style="display:inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm" style="font-size: 12px;">رفض</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
