@extends('layout')



@section('body-content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h2 class="text-center mb-4">Car Reservation Request</h2>
            <form action="#" method="POST">
                @csrf

                <div class="mb-2">
                    <label>Full Name</label>
                    <input type="text" name="full_name" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Car</label>
                    <select name="car_id" class="form-control" required>
                        <!-- خيارات السيارات -->
                    </select>
                </div>

                <div class="mb-2">
                    <label>Pickup Date</label>
                    <input type="date" name="pickup_date" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Return Date</label>
                    <input type="date" name="return_date" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Delivery Method</label>
                    <select name="delivery_method" class="form-control" required>
                        <option value="branch">From Branch</option>
                        <option value="destination">Delivery to Destination</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label>Total Days</label>
                    <input type="number" name="total_days" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Total Amount</label>
                    <input type="number" step="0.01" name="total_amount" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Driving License</label>
                    <input type="text" name="driving_license" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label>National ID</label>
                    <input type="text" name="national_id" class="form-control" required>
                </div>

                <div class="d-grid mb-5">
                    <button type="submit" class="btn btn-primary">Submit Request</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
