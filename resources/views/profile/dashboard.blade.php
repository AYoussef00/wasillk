@extends('layout')
@section('title')
    <title>{{ __('لوحة التحكم') }}</title>
@endsection
@section('body-content')

<main>
    <!-- banner-part-start  -->

    <section class="inner-banner">
    <div class="inner-banner-img" style=" background-image: url({{ getImageOrPlaceholder($breadcrumb, '1920x150') }}) ;"></div>
        <div class="container">
        <div class="col-lg-12">
            <div class="inner-banner-df">
                <h1 class="inner-banner-taitel">{{ __('لوحة التحكم') }}</h1>
            </div>
            </div>
        </div>
    </section>
    <!-- banner-part-end -->

    <!-- dashboard-part-start -->
    <section class="dashboard">
        <div class="container">
            <div class="row">
                @include('profile.sidebar')


                <div class="col-lg-9">

                    <!-- Dashboard  -->
                    <div class="row gy-5">
                        <div class=" col-lg-4 col-md-6">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="dashboard-inner-text">
                                        <h5>{{ __('إجمالي السيارات') }}</h5>
                                        <h3 class="counter">{{ $total_car }}</h3>

                                        <a href="{{ route('user.car.index') }}">{{ __('translate.View All') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="  col-lg-4 col-md-6">
                            <div class="dashboard-item two">
                                <div class="dashboard-inner">
                                    <div class="dashboard-inner-text">
                                        <h5>{{ __('الحجوزات المعلقة') }}</h5>
                                        <h3 class="counter">{{ $total_pending_requests }}</h3>

                                        <a href="{{ route('user.car.index') }}">{{ __('translate.View All') }}</a>
                                    </div>



                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-4 col-md-6">
                            <div class="dashboard-item three">
                                <div class="dashboard-inner">
                                    <div class="dashboard-inner-text">
                                        <h5>{{ __('الحجوزات المؤكدة') }}</h5>
                                        <h3 class="counter">{{ $total_confirmed_requests }}</h3>

                                        <a href="{{ route('user.wishlists') }}">{{ __('translate.View All') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">


                            <div class="dashbord-tabel">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('السيارة') }}</th>
                                            <th>{{ __('ماركة') }}</th>
                                            <th>{{ __('السعر') }}</th>
                                            <th>{{ __('الحالة') }}</th>
                                            <th>{{ __('أجراء') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($cars as $index => $car)
                                                <tr>

                                                    <td>
                                                        {{ html_decode($car->title) }}
                                                    </td>

                                                    <td>{{ $car?->brand?->name }}</td>
                                                    <td>
                                                        @if ($car->offer_price)
                                                            {{ currency($car->offer_price) }}
                                                        @else
                                                            {{ currency($car->regular_price) }}
                                                        @endif

                                                    </td>

                                                    <td>

                                                        @if ($car->approved_by_admin == 'approved')
                                                            <button class="no yes">
                                                                {{ __('translate.Active') }}
                                                            </button>
                                                        @else
                                                            <button class="no">
                                                                {{ __('translate.Awaiting') }}
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="actions-btn-item">
                                                            <a href="{{ route('listing', $car->slug) }}" class="actions-btn">
                                                                <span>
                                                                    <svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M7.79633 0.679688C5.12346 0.679688 2.69957 2.14204 0.910975 4.51729C0.765026 4.71188 0.765026 4.98375 0.910975 5.17835C2.69957 7.55646 5.12346 9.01881 7.79633 9.01881C10.4692 9.01881 12.8931 7.55646 14.6817 5.18121C14.8276 4.98661 14.8276 4.71475 14.6817 4.52015C12.8931 2.14204 10.4692 0.679688 7.79633 0.679688ZM7.98807 7.7854C6.21379 7.897 4.74857 6.43465 4.86018 4.65751C4.95176 3.1923 6.13938 2.00467 7.60459 1.9131C9.37887 1.80149 10.8441 3.26384 10.7325 5.04098C10.638 6.50334 9.45042 7.69096 7.98807 7.7854ZM7.89935 6.42893C6.94353 6.48903 6.15369 5.70205 6.21665 4.74623C6.2653 3.95638 6.90633 3.31822 7.69617 3.2667C8.65199 3.20661 9.44183 3.99359 9.37887 4.94941C9.32736 5.74211 8.68633 6.38028 7.89935 6.42893Z"></path>
                                                                    </svg>
                                                                </span>
                                                            </a>

                                                            <a href="{{ route('user.car.edit', ['car' => $car->id, 'lang_code' => admin_lang()] ) }}" class="actions-btn edit ">
                                                                <span>
                                                                    <i class="fa-solid fa-pen-to-square"></i>

                                                                </span>
                                                            </a>

                                                            <a href="{{ route('user.car-gallery', $car->id) }}" class="actions-btn edit gallery ">
                                                                <span>
                                                                <i class="fa-solid fa-image"></i>

                                                                </span>
                                                            </a>




                                                            <button type="button" class="actions-btn delet" onclick="deleteCar({{ $car->id }})">
                                                                <span>
                                                                    <i class="fa-solid fa-trash-can"></i>

                                                                </span>
                                                            </button>

                                                            <form action="{{ route('user.car.destroy', $car->id) }}" id="remove_car_{{ $car->id }}" class="d-none" method="POST">
                                                                @csrf
                                                                @method('DELETE')

                                                            </form>
                                                        </div>
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
    </section>

    <!-- dashboard-part-end -->

    @include('profile.logout')

</main>

@endsection



@push('js_section')
<script src="{{ asset('global/sweetalert/sweetalert2@11.js') }}"></script>


<script>
    "use strict";
        function deleteCar(id){
            Swal.fire({
                title: "{{__('Are you realy want to delete this item ?')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{__('Yes, Delete It')}}",
                cancelButtonText: "{{__('Cancel')}}",
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#remove_car_"+id).submit();
                }

            })
        }
    </script>


@endpush
