<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pending_requests', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
            $table->unsignedBigInteger('car_id'); // مجرد رقم مش علاقة
            $table->date('pickup_date');
            $table->date('return_date');
            $table->string('delivery_method'); // مثال: مطار، مكتب، ... الخ
            $table->integer('total_days');
            $table->decimal('total_amount', 10, 2);
            $table->string('driving_licence');
            $table->string('national_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_requests');
    }
};
